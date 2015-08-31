<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petitie_noua extends CI_Controller {
	 
	public function __construct(){	
            parent::__construct();  
			$this->load->model('login_model');				
			$this->load->model('RestServiceClient');
			$this->load->model('general');
			$this->load->model('petition_model');
	}
	/*
		Acest controller este apelat din views/petitie/petitie_noua, si are rolul de a insera in tabela de SQL petitii, petitia de abea trimisa,
		de a salva o petitie, sau sterge o petitie.
	*/
	
	public function index(){
		$logat = $this->login_model->este_logat();
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$admin = TRUE;
		}else{
			$admin = FALSE;
		}
		if($logat){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 2
			);			
			$this->load->view('prima_pagina/header_li', $data);
			$this->form_validation->set_rules('titlu', 'Titlul', 'required|min_length[6]|max_length[105]|trim');
			$this->form_validation->set_rules('petitie', 'Petitie', 'required|min_length[4]|max_length[1000]|trim');			
			$this->form_validation->set_rules('id_petitie', 'ID Petitie', 'required');			
			$this->form_validation->set_rules('categorii[]', 'Categorii', 'required');	
			
			if ($this->form_validation->run() == TRUE){
			
				$titlu = $this->general->xss_safe($this->input->post('titlu'));
				$petitie = $this->general->xss_safe($this->input->post('petitie'));
				$id_petitie = $this->general->xss_safe($this->input->post('id_petitie'));
				$categorii = $this->input->post('categorii');	
				$categorie1 = $this->general->xss_safe($categorii['0']);
				
				if(isset($categorii['1'])){
					$categorie2 = $this->general->xss_safe($categorii['1']);
				}else{
					$categorie2 = '';
				}
				
				if(isset($categorii['2'])){
					$categorie3 = $this->general->xss_safe($categorii['2']);
				}else{
					$categorie3 = '';
				}
				
				$id = $this->session->userdata('id');			
				$this->petition_model->insert($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id, 0, $id_petitie);		
				$this->load->view('petitie/petitie_succes');				
				
			}else{
				$data['author'] = $this->session->userdata('prenume').' '.$this->session->userdata('nume');
				$data['categorii'] = $this->general->get_categorii();
				$this->load->view('petitie/petitie_noua', $data);
				
			}
			
			$this->load->view('prima_pagina/footer');
		}else{		
		
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 2
			);
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
			$this->load->view('prima_pagina/login_reg');
			$this->load->view('prima_pagina/footer');
		}		
	}
	
	public function salvare(){
		$logat = $this->login_model->este_logat();			
		if($logat){						
			$titlu = $this->general->xss_safe($this->input->post('titlu'));		
			$petitie = $this->general->xss_safe($this->input->post('petitie'));
			$id_pet = $this->general->xss_safe($this->input->post('id_petitie'));
			$categorii = $this->input->post('categorii');	
			$id_petitie = ((int)$id_pet);	
			$cat = explode(",", $categorii);				
			
			$categorie1 = $categorie2 = $categorie3 = '';
			$categorie1 = $this->general->xss_safe($cat['1']);
					
			if(isset($cat['2'])){
				$categorie2 = $this->general->xss_safe($cat['2']);
			}else{
				$categorie2 = '';
			}
					
			if(isset($cat['3'])){
				$categorie3 = $this->general->xss_safe($cat['3']);
			}else{
				$categorie3 = '';
			}
					
			$id = $this->session->userdata('id');					
			if ($this->input->post('ajax') == '1') {
				$id_petitie = $this->petition_model->save($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id, 1, $id_petitie);			
				if($id){
					echo $id_petitie;
				}		
			}else{
				redirect('petitie_noua');			
			}
		}else{
			redirect('prima_pagina');
		}
	}
	
	/*
		Returneaza 1, daca petitia nu a fost postata in odata, deci poate fi stearsa
		Returneaza 0, in caz contrar, deci nu mai poate fii stearsa
	*/
	
	public function stergere(){
		$logat = $this->login_model->este_logat();			
		if($logat){	
			$id_petitie = $this->general->xss_safe($this->input->post('id_petitie'));
			$id = $this->session->userdata('id');					
			
			if ($this->input->post('ajax') == '1') {
				if($id_petitie == 0){
					echo '1';
				}else{					
					echo $this->petition_model->delete($id_petitie, $id);			
				}
			}else{
				redirect('petitie_noua');			
			}
		}else{
			redirect('prima_pagina');
		}
	}
	
	public function editare_petitie($id_petitie){		
		$logat = $this->login_model->este_logat();
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$admin = TRUE;
		}else{
			$admin = FALSE;
		}		
		if($logat == 1){
			$id_petitie = $this->general->xss_safe($this->uri->segment(3));				
			$id_user = $this->session->userdata('id');					
			$editabila = $this->petition_model->can_be_editable($id_petitie, $id_user);			
			if($editabila){
				$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
				$data2 = array(
					'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
					'nume' => $this->session->userdata('nume'),
					'prenume' => $this->session->userdata('prenume'),
					'email' => $this->session->userdata('email'),
					'admin' => $admin,
					'logat' => 1,
					'highlight' => 2
				);
				$this->load->view('prima_pagina/header_li', $data2);	
				$pet = $this->petition_model->get_petitie($id_petitie);				
				$data['petitie'] = $pet->row();
				$data['cat1'] = $data['petitie']->categorie1; 				
				$data['cat2'] = $data['petitie']->categorie2; 
				$data['cat3'] = $data['petitie']->categorie3; 
				$data['categorii'] = $this->general->get_categorii();
				$this->load->view('petitie/petitie_editare', $data);
				$this->load->view('prima_pagina/footer');
			}else{
				echo 'petitia nu poate fi editata';
			}
		}else{
			redirect('prima_pagina');
		}
	}
	
	public function asteptare($id_petitie){
		$logat = $this->login_model->este_logat();
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$admin = TRUE;
		}else{
			$admin = FALSE;
		}		
		if($logat == 1){
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data2 = array(
					'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
					'nume' => $this->session->userdata('nume'),
					'prenume' => $this->session->userdata('prenume'),
					'email' => $this->session->userdata('email'),
					'admin' => $admin,
					'logat' => 1,
					'highlight' => 2
				);
			$this->load->view('prima_pagina/header_li', $data2);	
			$id_petitie = $this->general->xss_safe($this->uri->segment(3));				
			$id_user = $this->session->userdata('id');					
			$pet = $this->petition_model->get_petitie($id_petitie);				
			$data['petitie'] = $pet->row();
			$data['cat1'] = $data['petitie']->categorie1; 				
			$data['cat2'] = $data['petitie']->categorie2; 
			$data['cat3'] = $data['petitie']->categorie3; 
			$data['categorii'] = $this->general->get_categorii();
			$this->load->view('petitie/pending_petition', $data);
			$this->load->view('prima_pagina/footer');
		}else{
			redirect('prima_pagina');
		}
	}
	
	public function trimite_editata(){
		$logat = $this->login_model->este_logat();
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$admin = TRUE;
		}else{
			$admin = FALSE;
		}
		if($logat){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 2,
				'mesaje' => $mesaj_nevaz
			);			
			$this->load->view('prima_pagina/header_li', $data);
			$this->form_validation->set_rules('titlu', 'Titlul', 'required|min_length[6]|max_length[75]|trim');
			$this->form_validation->set_rules('petitie', 'Petitie', 'required|min_length[4]|max_length[1000]|trim');			
			$this->form_validation->set_rules('id_petitie', 'ID Petitie', 'required');			
			$this->form_validation->set_rules('categorii[]', 'Categoriile', 'required');	
			$id_petitie = $this->general->xss_safe($this->input->post('id_petitie'));
			if ($this->form_validation->run() == TRUE){
			
				$titlu = $this->general->xss_safe($this->input->post('titlu'));
				$petitie = $this->general->xss_safe($this->input->post('petitie'));
				$id_petitie = $this->general->xss_safe($this->input->post('id_petitie'));
				$categorii = $this->input->post('categorii');	
				$categorie1 = $this->general->xss_safe($categorii['0']);
				
				if(isset($categorii['1'])){
					$categorie2 = $this->general->xss_safe($categorii['1']);
				}else{
					$categorie2 = '';
				}
				
				if(isset($categorii['2'])){
					$categorie3 = $this->general->xss_safe($categorii['2']);
				}else{
					$categorie3 = '';
				}
				
				$id = $this->session->userdata('id');			
				$this->petition_model->insert($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id, 0, $id_petitie);		
				$this->load->view('petitie/petitie_succes');				
				
			}else{
			
				$pet = $this->petition_model->get_petitie($id_petitie);				
				$data['petitie'] = $pet->row();
				$data['cat1'] = $data['petitie']->categorie1; 				
				$data['cat2'] = $data['petitie']->categorie2; 
				$data['cat3'] = $data['petitie']->categorie3; 
				$data['categorii'] = $this->general->get_categorii();
				$this->load->view('petitie/petitie_editare', $data);				
				
			}
			
			$this->load->view('prima_pagina/footer');
		}else{		
		
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiție nouă',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 2
			);
			
			$this->load->view('prima_pagina/header', $data);
			$this->load->view('prima_pagina/login_reg');
			$this->load->view('prima_pagina/footer');
		}				
	}
}
