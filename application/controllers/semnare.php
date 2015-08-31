<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Semnare extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){
	
            parent::__construct();  
			$this->load->model('RestServiceClient');	
			$this->load->model('PetitiiRaspuns');	
			$this->load->model('login_model');			
			$this->load->model('semnare_model');			
			$this->load->model('general');
			$this->load->library('pagination');
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
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$admin = TRUE;
		}else{
			$admin = FALSE;
		}
		if($logat){		
			$this->form_validation->set_rules('id_petitie', 'id petitie hackere', 'required|numeric');		
			$id = (int)$this->input->post('id_petitie');
						
			$rez = $this->petition_model->get_petitie_aprobate($id);			
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));					
			$data = array(
				'title' => 'petiții.gov.ro &ndash; '.$this->general->truncateString($rez['titlu'], 15),
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => $admin,
				'email' => $this->session->userdata('email'),
				'highlight' => 3,
				'mesaje' => $mesaj_nevaz
			);		
			$this->load->view('prima_pagina/header_li', $data);		
			
			if($this->form_validation->run() == TRUE){		
				$email = $this->session->userdata('email');
				$nume = $this->session->userdata('nume');
				$prenume = $this->session->userdata('prenume');
				$id_petitie = (int)$this->input->post('id_petitie');				
				if($this->semnare_model->semnare($email, $nume, $prenume, $id_petitie)){	
				
					$voturi = $this->petition_model->get_petitie_aprobate($id_petitie);
					$nrvoturi = $voturi['voturi'];			
					if($nrvoturi == 10000){
						$id_user = $this->general->get_user_by_id_petitie_cloud($id_petitie);
						$titlu = $this->petition_model->get_title_petition_cloud($id_petitie);
						$mesaj = 'Petiția ta a strâns 10.000 de semnături.';
						$this->general->insert_mesaj($id_user, $mesaj, $titlu);
						$mesaj = 'Petiția semnată de tine a strâns 10.000 de semnături.';
						$this->general->send_mesaj_semnaturi($id_user, $mesaj, $id_petitie, $titlu);
					}
					$this->semnare_model->semnare2($id_petitie, $nrvoturi);
					$data2['succes'] = 1;					
					$data2['semnare'] = $this->semnare_model->exists($this->session->userdata('nume'), $this->session->userdata('prenume'), $this->session->userdata('email'), $id);					
					
					$data2['rezultate'] = $this->petition_model->get_petitie_aprobate($id_petitie);
					$data2['raspuns'] = $this->general->received_answer($id_petitie);				
					$data2['id'] = $id_petitie;	
					$data2['semnaturi'] = $this->general->get_last_signs($id_petitie);
					$data2['autor'] = $this->general->get_author2($data2['rezultate']['initiator']);					
					$data2['categorie'] = $this->general->get_categorie($data2['rezultate']['categorie']);
					$data2['initiator'] = $data2['rezultate']['initiator'];
					
					$this->load->view('petitie/view_petitie', $data2);
					$this->load->view('prima_pagina/sidebar', $data2);
					$this->load->view('prima_pagina/footer');
					
				}else if(is_int($id_petitie)){
				
					$data2 = array('deja' => 'Ați votat deja la această petiție. Puteți vota o singură dată.');													
					$data2['semnare'] = $this->semnare_model->exists($this->session->userdata('nume'), $this->session->userdata('prenume'), $this->session->userdata('email'), $id);										
					
					$data2['rezultate'] = $this->petition_model->get_petitie_aprobate($id_petitie);
					$data2['raspuns'] = $this->general->received_answer($id_petitie);				
					$data2['semnaturi'] = $this->general->get_last_signs($id_petitie);
					$data2['autor'] = $this->general->get_author2($data2['rezultate']['initiator']);
					$data2['categorie'] = $this->general->get_categorie($data2['rezultate']['categorie']);
					$data2['id'] = $id_petitie;	
					$data2['initiator'] = $data2['rezultate']['initiator'];
					
					$this->load->view('petitie/view_petitie', $data2);
					$this->load->view('prima_pagina/sidebar', $data2);
					$this->load->view('prima_pagina/footer');			
					
				}else{
					redirect('prima_pagina/index');
				}
			}else{
			
				$id_petitie = (int)$this->input->post('id_petitie');
				if(is_int($id_petitie)){				
				
					$data2['rezultate'] = $this->petition_model->get_petitie_aprobate($id_petitie);
					$data2['raspuns'] = $this->general->received_answer($id_petitie);				
					$data2['semnaturi'] = $this->general->get_last_signs($id_petitie);
					$data2['autor'] = $this->general->get_author2($data2['rezultate']['initiator']);
					$data2['categorie'] = $this->general->get_categorie($data2['rezultate']['categorie']);	
					$data2['id'] = $id_petitie;	
					$data2['initiator'] = $data2['rezultate']['initiator'];
					
					$this->load->view('petitie/view_petitie', $data);
					$this->load->view('prima_pagina/footer');
				}else{
					redirect('prima_pagina/index');
				}
				
			}		
		}else{
			redirect('prima_pagina/index');
		}			
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
