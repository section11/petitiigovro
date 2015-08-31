<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inregistrare extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){
	
            parent::__construct();  
			$this->load->model('register_model');
			$this->load->model('login_model');
			$this->load->model('general');
			$this->load->model('PetitiiRaspuns');
			$this->load->model('RestServiceClient');
			$this->load->helper('text');
	}
	
	public function index(){			
		$cate = 3;
		$top_pet = $this->general->get_top_petitions($cate);		//v		
		$authors_top = array();			
		$rasp = $this->general->get_raspunsuri($cate);		
		$top_raspunsuri = array();
		$top_petitii = array();													
		$data2['top_petitions'] = $top_pet; // v		
		$data2['top_raspunsuri'] = $rasp; //v				
		$data2['recent_petitions'] = $this->general->get_last_petitions(); //v					
		
		$logat = $this->login_model->este_logat();
		if ($logat) {									
			redirect('prima_pagina');
		} else {						
			$this->form_validation->set_rules('parola', '„Parolă”', 'required|min_length[6]|alpha_numeric|trim');
			$this->form_validation->set_rules('confparola', '„Confirmare parolă”', 'required|min_length[6]|alpha_numeric|trim|matches[parola]');
			$this->form_validation->set_rules('nume', '„Nume”', 'required|min_length[2]|trim|callback_letters_check');
			$this->form_validation->set_rules('prenume', '„Prenume”', 'required|min_length[2]|trim|callback_letters_check');
			$this->form_validation->set_rules('email', '„E-mail”', 'required|min_length[6]|valid_email|trim');			
			$this->form_validation->set_rules('confemail', '„Confirmare e-mail”', 'required|min_length[6]|valid_email|trim|matches[email]');			
			if ($this->form_validation->run() == FALSE){
				$data = array(
					'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare',
					'suspendat' => 1
				);				
				$data['url_last'] = 'prima_pagina';
				$this->load->view('prima_pagina/header', $data);
				$this->load->view('register/formular');
			}else{
				$email = $this->general->xss_safe($this->input->post('email'));							
				if($this->register_model->exista($email) == TRUE){
					$data = array(
						'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare',
						'suspendat' => 1
					);			
					$data['url_last'] = current_url();
					$this->load->view('prima_pagina/header', $data);
					$data = array(
						'exista' => 'Adresa de e-mail introdusă este deja înregistrată. Accesează <a href="'.base_url().'login/recuperare_parola">această legătură</a> dacă ai uitat parola.'
					);					
					$this->load->view('register/formular', $data);				
				}else{
					$nume = $this->general->xss_safe($this->input->post('nume'));					
					$prenume = $this->general->xss_safe($this->input->post('prenume'));					
					$parola = $this->general->xss_safe($this->input->post('parola'));
					$email = $this->general->xss_safe($this->input->post('email'));																	
					$this->register_model->insereaza($parola, $nume, $prenume, $email);
					if($this->register_model->trimite($nume, $prenume, $email)){
						$data = array(
							'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare'
						);
						$data['suspendat'] = 1;
						$data['url_last'] = 'prima_pagina';
						$this->load->view('prima_pagina/header', $data);
						$this->load->view('gol');
						$this->load->view('register/success_email');
					}
				}
			}
			$this->load->view('prima_pagina/sidebar', $data2);
			$this->load->view('prima_pagina/footer');
		}
		
	}
	
	public function letters_check($str){
		if (preg_match('#[0-9]#',$str) || preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $str))
		{
			$this->form_validation->set_message('letters_check', 'Campul %s nu poate conţine cifre ori alte caractere speciale.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function activare(){		
		$cate = 3;
		$top_pet = $this->general->get_top_petitions($cate);		//v		
		$authors_top = array();			
		$rasp = $this->general->get_raspunsuri($cate);		
		$top_raspunsuri = array();
		$top_petitii = array();													
		$data2['top_petitions'] = $top_pet; // v		
		$data2['top_raspunsuri'] = $rasp; //v				
		$data2['recent_petitions'] = $this->general->get_last_petitions(); //v						
		
		$logat = $this->login_model->este_logat();
		if ($logat) {									
			redirect('prima_pagina');
		} else {						
			$this->form_validation->set_rules('judet', '„Judeţ”', 'trim|required');
			$this->form_validation->set_rules('varsta', '„Data naşterii”', 'required|min_length[3]|trim');	
			$this->form_validation->set_rules('cod', '„Cod”', 'required|min_length[3]|trim');				
			if ($this->form_validation->run() == FALSE){
				$data = array(
                    'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare',
					'suspendat' => 1
                );				
				$data['url_last'] = 'prima_pagina';
                $this->load->view('prima_pagina/header', $data);
				$data['cod'] = $this->general->xss_safe($this->uri->segment(3));
				if($data['cod'] == ''){
					$data['cod'] = $this->general->xss_safe($this->input->post('cod'));
				}							
                $this->load->view('register/activare', $data);
				$this->load->view('prima_pagina/sidebar', $data2);
				$this->load->view('prima_pagina/footer');
			}else{
				$cod = $this->general->xss_safe($this->input->post('cod'));
				$varsta = $this->general->xss_safe($this->input->post('varsta'));
				if($this->register_model->varsta_minima($varsta)){
                    $data = array(
                        'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare',
						'suspendat' => 1
                    );					
					$data['url_last'] = 'prima_pagina';
                    $this->load->view('prima_pagina/header', $data);
                    $data = array(
						'varsta' => 'Vârsta minimă necesară pentru crearea unui cont este de 14 ani.'
                    );
					$data['cod'] = $this->general->xss_safe($this->uri->segment(3));
					if($data['cod'] == ''){
						$data['cod'] = $this->general->xss_safe($this->input->post('cod'));
					}					
					$this->load->view('register/activare', $data);
					$this->load->view('prima_pagina/sidebar', $data2);
					$this->load->view('prima_pagina/footer');
				}else if($this->register_model->activare($cod)){
					$data_n = $this->general->xss_safe($this->input->post('varsta'));
					$judet = $this->general->xss_safe($this->input->post('judet'));
					$cod = $this->general->xss_safe($this->input->post('cod'));
					$this->register_model->insert_second_step($cod, $data_n, $judet);
					$data = array(
						'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Activare reușită',
						'suspendat' => 1
					);					
					$data['url_last'] = 'prima_pagina';
					$this->load->view('prima_pagina/header', $data);
					$this->load->view('gol');
					$this->load->view('register/success');
					$this->load->view('prima_pagina/sidebar', $data2);
					$this->load->view('prima_pagina/footer');
				}else{
					$data = array(
						'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Activare nereușită', 
						'suspendat' => 1
					);					
					$data['url_last'] = 'prima_pagina';
					$this->load->view('prima_pagina/header', $data);
					$this->load->view('gol');
					$this->load->view('register/unsuccess');
					$this->load->view('prima_pagina/sidebar', $data2);
					$this->load->view('prima_pagina/footer');
				}
			}
		}
	}
}

/* End of file index.php */
/* Location: ./application/controllers/register.php */
