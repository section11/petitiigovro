<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prima_pagina extends CI_Controller {

	public function __construct(){
	
            parent::__construct();  
            $this->load->model('RestServiceClient');
			$this->load->model('login_model');
			$this->load->helper('text');
			$this->load->model('general');
			$this->load->model('PetitiiRaspuns');
			
	}
	/*
		Controllerul prima_pagina, este destinat primei pagini in care se incarca text static, si sidebar
		Pentru utilizatorii logati se afiseaza alt meniu. Este dat de variabila $logat, care face cerere catre login_model, care returneaza sesiunea.
	*/
	public function index(){			
		/*--------------------------------------------------------*/
		//Topul petitiilor din sidebar	
		/*
		
		*/
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Pagina principală',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 1,
				'mesaje' => $mesaj_nevaz				
			);		
			
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Pagina principală',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 1
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}	
		
		$data3['top_petitions'] = $top_pet; // v	
		$this->load->view('prima_pagina/content', $data3);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
		
	}
}

/* End of file prima_pagina.php */
/* Location: ./application/controllers/prima_pagina.php */
