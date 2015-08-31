<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raspunsuri extends CI_Controller {

	public function __construct(){
	
            parent::__construct();  
            $this->load->model('login_model');
			$this->load->model('PetitiiRaspuns');					
			$this->load->model('general');
			$this->load->helper('text');
			$this->load->library('pagination');
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspunsuri',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 4,
				'mesaje' => $mesaj_nevaz
			);
						
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspunsuri',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 4
			);	
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}
		
		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/raspunsuri/index';
		$config['total_rows'] = $this->general->ListResponse();
		$config['per_page'] = 8;
		$config['num_links'] = 8;
		
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
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$data2['raspunsuri'] = $this->general->get_result_limits_raspunsuri($config['per_page'], $pag + 1, $config['total_rows']);
		$data2['categories'] = $this->general->get_categorii();		
		$this->load->view('raspunsuri/lista_raspunsuri', $data2);
		
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
	
	public function search(){		
								
		
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Căutare răspunsuri' ,
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 4,
				'mesaje' => $mesaj_nevaz
			);			
			$this->load->view('prima_pagina/header_li', $data);
		}else{	
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Căutare răspunsuri',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 4
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}
		
		$search = $this->general->xss_safe($this->input->post('termen'));
		
		if($search == false){
			$search = $this->general->xss_safe((string)$this->uri->segment(3));
		}
		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/raspunsuri/search/'.$search.'/';
		$config['total_rows'] = $this->general->ListResponseSearch($search);			
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
				
		$this->pagination->initialize($config);		
		$pag = (int)$this->uri->segment(4);	$pag /= $config['per_page'];
		
		if($search){					
			$data['raspunsuri'] = $this->general->Search_Raspunsuri($config['per_page'], $pag + 1, $config['total_rows'], $search);									
			$data['categories'] = $this->general->get_categorii();
			$this->load->view('raspunsuri/Search', $data);
			$cate = 3;
			$top_pet = $this->general->get_top_petitions($cate);		//v		
			$authors_top = array();			
			$rasp = $this->general->get_raspunsuri($cate);		
			$top_raspunsuri = array();
			$top_petitii = array();													
			$data2['top_petitions'] = $top_pet; // v		
			$data2['top_raspunsuri'] = $rasp; //v				
			$data2['recent_petitions'] = $this->general->get_last_petitions(); //v	
			$this->load->view('prima_pagina/sidebar', $data2);
			$this->load->view('prima_pagina/footer');
		}else{
			redirect('prima_pagina');
		}
		
	}
	
	public function afisare_raspuns($id){		
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspunsuri',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 4,
				'mesaje' => $mesaj_nevaz
			);					
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspuns',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 4
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}
		$data['raspuns'] = $this->general->get_response($id);  			
		$data['petitie'] = $this->petition_model->get_petitie_aprobate($id);
		$this->load->view('raspunsuri/raspunsuri_oficiale', $data);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}	
	public function categorie($categorie){		
	
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspunsuri oficiale',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'email' => $this->session->userdata('email'),
				'admin' => $admin,
				'logat' => 1,
				'highlight' => 4,
				'mesaje' => $mesaj_nevaz
			);
					
			$this->load->view('prima_pagina/header_li', $data);
		}else{
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Răspunsuri oficiale &ndash;'. strtolower($categorie),
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 4
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}		

		$categorie = $this->general->xss_safe($this->uri->segment(3));			
		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/raspunsuri/categorie/'.$categorie.'/';
		$config['total_rows'] = $this->general->get_raspuns_by_category_number($categorie);		
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['uri_segment'] = 4;
		
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

		$pag = (int)$this->uri->segment(4);	$pag /= $config['per_page'];	
		$result = $this->general->get_response_by_category($config['per_page'], $pag + 1, $config['total_rows'], $categorie);		
		$data2['raspunsuri'] = $result;			
		$data2['categories'] = $this->general->get_categorii();
		$data2['categorie'] = $categorie;
		$data2['categorie2'] = $this->general->get_categorie_nice($categorie);
		$this->load->view('raspunsuri/categorii', $data2);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
