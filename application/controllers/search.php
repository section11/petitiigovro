<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Căutare petiții',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 3,
				'mesaje' => $mesaj_nevaz
			);						
			$this->load->view('prima_pagina/header_li', $data);
		}else{	
			$data = array(
				'title' => 'petiţii.gov.ro &ndash; Vocea ta în Guvernul României | Căutare petiții',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 3
			);	
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}
		$search = $this->general->xss_safe($this->input->post('termen'));
		
		if($search == false){
			$search = $this->general->xss_safe((string)$this->uri->segment(4));
		}
		$val = (int)$this->uri->segment(3);
		if($val == 0){
			$val = 3;
		}
		if($val < 0 || $val > 3){
			$val = 3;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/search/index/'.$val.'/'.$search.'/';
		$config['total_rows'] = $this->petition_model->ListPetitionsSearch($search);								
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['uri_segment'] = 5;
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
		$config['full_tag_close'] = '</ul></div>';

		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li><a>';
		$config['last_tag_close'] = '</a></li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li><a>';
		$config['first_tag_close'] = '</a></li>';
				
		$this->pagination->initialize($config);		
		$pag = (int)$this->uri->segment(5);	$pag /= $config['per_page'];
		
		if($search){					
			$result = $this->petition_model->Search($config['per_page'], $pag + 1, $config['total_rows'], $search, $val);			
			$data2['petitions'] = $result;			
			$data2['categories'] = $this->general->get_categorii();
			$data2['search'] = $search;
			$this->load->view('search/Search', $data2);
			$this->load->view('prima_pagina/sidebar', $data2);
			$this->load->view('prima_pagina/footer');
		}else{
			redirect('prima_pagina');
		}
	}
	
	public function view_petitie($id){
		
		$cate = 3;
		$top_pet = $this->general->get_top_petitions($cate);		//v		
		$authors_top = array();			
		$rasp = $this->general->get_raspunsuri($cate);		
		$top_raspunsuri = array();
		$top_petitii = array();													
		$data2['top_petitions'] = $top_pet; // v		
		$data2['top_raspunsuri'] = $rasp; //v				
		$data2['recent_petitions'] = $this->general->get_last_petitions(); //v						
		
		$data = array();
		
		$data['rezultate'] = $this->petition_model->get_petitie_aprobate($id);
		$data['autor'] = $this->general->get_author2($data['rezultate']['initiator']);
		$data['categorie'] = $this->general->get_categorie($data['rezultate']['categorie']);
		$data['id'] = $id;		
		$data['raspuns'] = $this->general->received_answer($id);	
		if($data['raspuns'] == 1){
			$data['date_raspuns'] = $this->general->get_response($id); 
		}
		$data['semnaturi'] = $this->general->get_last_signs($id);	
		$data['title'] = 'petiţii.gov.ro - '.$this->general->truncateString($data['rezultate']['titlu'], 15);	
		$logat = $this->login_model->este_logat();
		if($logat){
			$admin = $this->login_model->este_admin();
			if($admin == 1){				
				$admin = TRUE;
			}else{
				$admin = FALSE;
			}
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data['nume'] = $this->session->userdata('nume');
			$data['prenume'] = $this->session->userdata('prenume');
			$data['logat'] = true;
			$data['admin'] = $admin;				
			$data['email'] = $this->session->userdata('email');
			$data['highlight'] = 3;
			$data['mesaje'] = $mesaj_nevaz;
			$this->load->view('prima_pagina/header_li', $data);
			$data['semnare'] = $this->semnare_model->exists($this->session->userdata('nume'), $this->session->userdata('prenume'), $this->session->userdata('email'), $id);
		}else{
			$admin = $this->login_model->este_admin();		
			$admin = FALSE;
			$data['logat'] = false;
			$data['admin'] = $admin;
			$data['highlight'] = 3;
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
			$data['semnare'] = 0;
		}
		$data['initiator'] = $data['rezultate']['initiator'];
		
		$this->load->view('petitie/view_petitie', $data);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
