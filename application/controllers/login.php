<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){
	
            parent::__construct();  
			$this->load->model('login_model');
			$this->load->model('general');
			$this->load->model('RestServiceClient');	
			$this->load->helper('text');
	}
	
	public function index(){
		$logat = $this->login_model->este_logat();
		if($logat){
			redirect('prima_pagina');
		}else{			
			$this->form_validation->set_rules('password', 'Parola', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('url_last','URL', 'required');
			if ($this->form_validation->run() == FALSE){				
				$data = array('title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Autentificare');
				$data['suspendat'] = 0;
				$data['url_last'] = $this->input->post('url_last');
				$this->load->view('prima_pagina/header', $data);
				$this->load->view('login/login_failure', $data);
			}else{
				$email = $this->input->post('email');	
				$parola = $this->input->post('password');
				$remember = $this->input->post('keep-session');
				$login = $this->login_model->autentifica($email, $parola, $remember);				
				if($login == 1){
					$url = $this->input->post('url_last');
					if($url == 'prima_pagina'){
						redirect('prima_pagina'); 
					}else{
						redirect($url);
					}
				}else{					
					$data = array('title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Autentificare');				
					if($login == 5){						
						$data['suspendat'] = 5;
					}else{
						$data['suspendat'] = 0;
					}
					$data['url_last'] = $this->input->post('url_last');
					$this->load->view('prima_pagina/header', $data);
					$this->load->view('login/login_failure', $data);
				}				
			}
			$this->load->view('prima_pagina/footer');
		}
	}
	public function local_redirect($id_petitie){
		$logat = $this->login_model->este_logat();
		if($logat){
			redirect('prima_pagina');
		}else{
			$data = array('title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Autentificare');
			$this->load->view('prima_pagina/header', $data);
			$this->form_validation->set_rules('password', 'Parola', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('login/login_failure');
			}else{
				$email = $this->input->post('email');	
				$parola = $this->input->post('password');
				$remember = $this->input->post('keep-session');				
				if($this->login_model->autentifica($email, $parola, $remember) == TRUE){
					redirect('search/view_petitie/'. $id); 
				}else{
					$this->load->view('login/login_failure');
				}				
			}
			$this->load->view('prima_pagina/footer');
		}
	}
	public function logout(){
		$this->login_model->logout();
		redirect('prima_pagina');
		exit;
	}

	public function recuperare_parola(){
		$logat = $this->login_model->este_logat();
		if($logat){
			redirect('prima_pagina');
		}else{
			$data = array('title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Recuperare parolă');
			$data['url_last'] = $this->input->post('url_last');
			$this->load->view('prima_pagina/header', $data);			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('varsta', 'Varsta', 'required|min_length[3]|trim');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('login/forgot_pass');
			}else{
				$email = $this->input->post('email');	
				$varsta = $this->input->post('varsta');				
				if($this->login_model->forgot_pass($email, $varsta)){					
					$this->load->view('login/recuperare_succes');
				}else{					
					$this->load->view('login/recuperare_insucces');
				}				
            }            
			$this->load->view('prima_pagina/footer');
		}	
	}
	public function new_pass(){
		
		$logat = $this->login_model->este_logat();
		if ($logat) {									
			redirect('prima_pagina');
		} else {						
			$this->form_validation->set_rules('parola', 'Parola', 'required|min_length[6]|trim');			
			$this->form_validation->set_rules('cod', 'Cod', 'required|min_length[6]|trim');			
			if ($this->form_validation->run() == FALSE){
				$data = array(
                    'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare'
                );
				$data['url_last'] = $this->input->post('url_last');
                $this->load->view('prima_pagina/header', $data);
				$data['cod'] = $this->general->xss_safe($this->uri->segment(3));				
				if($data['cod'] == ''){
					$data['cod'] = $this->general->xss_safe($this->input->post('cod'));
				}			
                $this->load->view('login/new_pass', $data);
			}else{
				$data = array(
                    'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Înregistrare'
                );
				$data['url_last'] = $this->input->post('url_last');
                $this->load->view('prima_pagina/header', $data);
				$cod = $this->general->xss_safe($this->input->post('cod'));
				$parola = $this->general->xss_safe($this->input->post('parola'));
				$parola = md5($parola);
				$data['cod'] = $this->general->xss_safe($this->uri->segment(3));				
				if($data['cod'] == ''){
					$data['cod'] = $this->general->xss_safe($this->input->post('cod'));
				}		
				if($this->login_model->new_pass($data['cod'], $parola)){					
					$this->load->view('login/setata_succes');
				}else{					
					$this->load->view('login/setata_insucces');
				}
            }
            
            $this->load->view('prima_pagina/footer');
		}
	}
}
/* End of file index.php */
/* Location: ./application/controllers/register.php */
