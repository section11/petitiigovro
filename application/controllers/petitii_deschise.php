<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petitii_deschise extends CI_Controller {

	public function __construct(){
	
            parent::__construct();              
			$this->load->model('login_model');		
			$this->load->library('pagination');
			$this->load->helper('text');
			$this->load->model('general');			
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiții deschise',
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiții deschise',
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 3
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}
		
		$val = (int)$this->uri->segment(3);
		if($val == 0){
			$val = 3;
		}
		if($val < 0 || $val > 3){
			$val = 3;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/petitii_deschise/index/'.$val.'/';
		$config['total_rows'] = $this->petition_model->get_petitii_aprobate_total();		
		$config['per_page'] = 8;
		$config['num_links'] = 8;
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
		$result = $this->petition_model->get_all_result_limits($config['per_page'], $pag + 1, $config['total_rows'], $val);
				
		$data2['petitions'] = $result;		
		$data2['categories'] = $this->general->get_categorii();
		
		$this->load->view('petitie/lista_petitii', $data2);
	
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiții deschise',
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
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Petiții deschise &ndash;'. strtolower($categorie),
				'admin' => $admin,
				'logat' => 0,
				'highlight' => 3
			);			
			$data['suspendat'] = 1;
			$data['url_last'] = current_url();
			$this->load->view('prima_pagina/header', $data);
		}

		$categorie = $this->general->xss_safe($this->uri->segment(3));
		
		$val = (int)$this->uri->segment(4);
		if($val == 0){
			$val = 3;
		}
		if($val < 0 || $val > 3){
			$val = 3;
		}
		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/petitii_deschise/categorie/'.$categorie.'/'.$val.'/';
		$config['total_rows'] = $this->petition_model->get_petition_by_category_number($categorie);						
		$config['per_page'] = 8;
		$config['num_links'] = 8;
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
		$result = $this->petition_model->get_petition_by_category($config['per_page'], $pag + 1, $config['total_rows'], $categorie, $val);		
		$data2['petitions'] = $result;			
		$data2['categories'] = $this->general->get_categorii();
		$data2['categorie'] = $categorie;
		$data2['categorie2'] = $this->general->get_categorie_nice($categorie);
		
		$this->load->view('petitie/lista_petitii2', $data2);
		$this->load->view('prima_pagina/sidebar', $data2);
		$this->load->view('prima_pagina/footer');
	}
	
}
