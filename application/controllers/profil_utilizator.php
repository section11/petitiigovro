<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profil_utilizator extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){	
            parent::__construct();  
            $this->load->model('RestServiceClient');
			$this->load->model('login_model');		
			$this->load->model('petition_model');		
			$this->load->helper('text');
			$this->load->model('general');
			$this->load->model('PetitiiRaspuns');	
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
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Profil utilizator',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 7,
				'mesaje' => $mesaj_nevaz
			);			
			
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			redirect('prima_pagina');
		}					
		$id_user = $this->session->userdata('id');
		$user = $this->general->get_user($id_user);
		$data['user'] = $user->row();						
		$data['update'] = 0;
		$petitii_asteptare = array();
		$petitii_neaprobate = array();
		$petitii_salvate = array();
		$petitii_initiate = $this->petition_model->get_petition_of_user_in($id_user, 1);					
		foreach ($petitii_initiate as $row){			
			if ($row->starepetitie == 0 && $row->salvare == 0)				
				array_push($petitii_asteptare, $row);
			else if ($row->starepetitie == 1)
				array_push($petitii_neaprobate, $row);
			if ($row->salvare == 1)
				array_push($petitii_salvate, $row);
		}		
		$data['petitii_asteptare'] = $petitii_asteptare;
		$data['petitii_neaprobate'] = $petitii_neaprobate;
		$data['petitii_salvate'] = $petitii_salvate;
		$data['petitii_aprobate'] = $this->petition_model->get_petition_of_user_aproved($id_user);		
		$this->form_validation->set_rules('telefon', 'Telefon', 'min_length[7]|numeric|trim');
		$this->form_validation->set_rules('adresa', 'Adresa', 'min_length[5]|trim');
		$this->form_validation->set_rules('localitate', 'Localitate', 'min_length[3]|trim');
		$this->form_validation->set_rules('judet', 'Judet', 'trim');
		$this->form_validation->set_rules('mediu', 'Mediu', 'trim');
		$this->form_validation->set_rules('sex', 'Sex', 'trim');		
		$this->form_validation->set_rules('ocupatie', 'Ocupatie', 'min_length[2]|trim');		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('profil_utilizator/panou', $data);
		}else{			
			$telefon = $this->general->xss_safe($this->input->post('telefon'));
			$adresa = $this->general->xss_safe($this->input->post('adresa'));
			$localitate = $this->general->xss_safe($this->input->post('localitate'));
			$judet = $this->general->xss_safe($this->input->post('judet'));
			$mediu = $this->general->xss_safe($this->input->post('mediu'));
			$sex = $this->general->xss_safe($this->input->post('sex'));
			$varsta = $data['user']->DATA_N;
			$ocupatie = $this->general->xss_safe($this->input->post('ocupatie'));
			$this->general->update_user($telefon, $adresa, $localitate, $judet, $mediu, $sex, $varsta, $ocupatie, $id_user);
			$data['update'] = 1;
			$user = $this->general->get_user($id_user);
			$data['user'] = $user->row();	
			$this->load->view('profil_utilizator/panou', $data);			
		}			
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
	
	public function mesaje(){
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
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Profil utilizator',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 7,
				'mesaje' => $mesaj_nevaz
			);			
			
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			redirect('prima_pagina');
		}	
		$id_user = $this->session->userdata('id');
		$data['mesaje'] = $this->general->get_mesaje($id_user);
		$this->load->view('profil_utilizator/mesaje', $data);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
	public function mesaj(){
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
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Profil utilizator',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 7,
				'mesaje' => $mesaj_nevaz
			);			
			
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			redirect('prima_pagina');
		}	
		$id_mesaj = $this->uri->segment(3);
		$data['mesaj'] = $this->general->get_mesaj($id_mesaj);
		$this->load->view('profil_utilizator/mesaj', $data);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
