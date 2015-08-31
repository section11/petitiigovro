<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panou_admin extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){	
            parent::__construct();  
            $this->load->model('PetitiiRaspuns');
			$this->load->model('RestServiceClient');
			$this->load->model('login_model');				
			$this->load->model('petition_model');				
			$this->load->model('general');				
			$this->load->library('pagination');
			$this->load->helper('url');				
	}
	
	public function index(){
		$admin = $this->login_model->este_admin();	
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'petitii_asteptare' => $this->petition_model->record_count(),
				'mesaje' => $mesaj_nevaz
				);
			$this->load->view('prima_pagina/header_li', $data);	
			$this->load->view('panou_admin/panou'); 
			$this->load->view('prima_pagina/footer');
		}else{
			redirect('prima_pagina');
		}		
	}	
	
	public function useri($number2){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);			
		}else{
			redirect('prima_pagina');
			exit;
		}		
		$number2 = $this->general->xss_safe($this->uri->segment(3)) ? $this->general->xss_safe($this->uri->segment(3)) : 20;
		if($number2 == 20){
			$number1 = 0;
		}else{
			$number1 = $number2 - 20;
		}		
		$data['useri'] = $this->general->get_users($number2, $number1);
		$data['data'] = Date('Y-m-d H:i:s');
		$data['number1'] = $number1 + 1;
		$data['number2'] = $number2;
		$this->load->view('panou_admin/useri', $data);
	}
	
	public function raspunsuri($to_skip){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);			
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/raspunsuri/';
		$config['total_rows'] = $this->general->ListResponse();
		$config['per_page'] = 5;
		$config['num_links'] = 10;
				
		$this->pagination->initialize($config);
				
		$pag = (int)$this->uri->segment(3);		
		$pag /= $config['per_page'];
		$data2['raspunsuri'] = $this->general->get_skip_result_limits($config['per_page'], $pag, $config['total_rows']);
		$petitie = array();
		foreach ($data2['raspunsuri'] as $raspuns) {			
			array_push($petitie, $this->petition_model->get_petitie_aprobate($raspuns['id_petitie']));		
		}
		$data2['petitie'] = $petitie;
		$data2['to_skip'] = $to_skip;		
		$this->load->view('panou_admin/lista_raspunsuri', $data2);
	}
	
	public function petitii_oficiale($to_skip){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);							
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_oficiale';
		$config['total_rows'] = $this->petition_model->get_petitii_admin_aprobate_total();		
		$config['per_page'] = 3;
		$config['num_links'] = 10;			
		
		$this->pagination->initialize($config);
		$val = 0;
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$result = $this->petition_model->get_all_result_limits($config['per_page'], $pag, $config['total_rows'], $val);
		
		$authors = array(); $stare = array();
		foreach ($result as $petitie) {			
			array_push($authors, $this->general->get_author2($petitie['initiator']));
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));
		}
		$data2['authors'] = $authors;
		$data2['petitions'] = $result;	
		$data2['stare'] = $stare;
		$data2['to_skip'] = $config['per_page'];
		
		$this->load->view('panou_admin/petitii_oficiale', $data2);		
	}
	public function petitii_expirate($to_skip){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);							
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_oficiale';
		$config['total_rows'] = $this->petition_model->get_petitii_admin_expirate_total();		
		$config['per_page'] = 3;
		$config['num_links'] = 10;			
		
		$this->pagination->initialize($config);
		$val = 0;
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$result = $this->petition_model->get_all_expirate_limits($config['per_page'], $pag, $config['total_rows'], $val);
		
		$authors = array(); $stare = array();
		foreach ($result as $petitie) {			
			array_push($authors, $this->general->get_author2($petitie['initiator']));
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));
		}
		$data2['authors'] = $authors;
		$data2['petitions'] = $result;	
		$data2['stare'] = $stare;
		$data2['to_skip'] = $config['per_page'];
		
		$this->load->view('panou_admin/petitii_oficiale', $data2);		
	}
	public function petitii_active($to_skip){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);							
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_oficiale';
		$config['total_rows'] = $this->petition_model->get_petitii_admin_active_total();		
		$config['per_page'] = 3;
		$config['num_links'] = 10;			
		
		$this->pagination->initialize($config);
		$val = 0;
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$result = $this->petition_model->get_all_active_limits($config['per_page'], $pag, $config['total_rows'], $val);
		
		$authors = array(); $stare = array();
		foreach ($result as $petitie) {			
			array_push($authors, $this->general->get_author2($petitie['initiator']));
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));
		}
		$data2['authors'] = $authors;
		$data2['petitions'] = $result;	
		$data2['stare'] = $stare;
		$data2['to_skip'] = $config['per_page'];
		
		$this->load->view('panou_admin/petitii_oficiale', $data2);		
	}
	public function petitii_fara_raspuns($to_skip){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);							
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_oficiale';
		$config['total_rows'] = $this->petition_model->get_petitii_admin_fara_raspuns_total();		
		$config['per_page'] = 3;
		$config['num_links'] = 10;			
		
		$this->pagination->initialize($config);
		$val = 0;
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$result = $this->petition_model->get_all_fara_raspuns_limits($config['per_page'], $pag, $config['total_rows'], $val);
		
		$authors = array(); $stare = array();
		foreach ($result as $petitie) {			
			array_push($authors, $this->general->get_author2($petitie['initiator']));
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));
		}
		$data2['authors'] = $authors;
		$data2['petitions'] = $result;	
		$data2['stare'] = $stare;
		$data2['to_skip'] = $config['per_page'];
		
		$this->load->view('panou_admin/petitii_oficiale', $data2);		
	}
	public function petitii_cu_raspuns($to_skip){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);							
		}else{
			redirect('prima_pagina');
			exit;
		}
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_oficiale';
		$config['total_rows'] = $this->petition_model->get_petitii_admin_cu_raspuns_total();		
		$config['per_page'] = 3;
		$config['num_links'] = 10;			
		
		$this->pagination->initialize($config);
		$val = 0;
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];		
		$result = $this->petition_model->get_all_cu_raspuns_limits($config['per_page'], $pag, $config['total_rows'], $val);
		
		$authors = array(); $stare = array();
		foreach ($result as $petitie) {			
			array_push($authors, $this->general->get_author2($petitie['initiator']));
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));
		}
		$data2['authors'] = $authors;
		$data2['petitions'] = $result;	
		$data2['stare'] = $stare;
		$data2['to_skip'] = $config['per_page'];
		
		$this->load->view('panou_admin/petitii_oficiale', $data2);		
	}
	public function petitii_locale($to_skip){	 //v
		$admin = $this->login_model->este_admin();
		if($admin == 1){			
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);			
		}else{
			redirect('prima_pagina');
			exit;
		}		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_locale/';
		$config['total_rows'] = $this->petition_model->record_count();				
		$config['uri_segment'] = 3;
		$config['per_page'] = 5;
		$config['num_links'] = 10;
				
		$this->pagination->initialize($config);		
		
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];
		
		$data['petitii'] = $this->petition_model->get_all_no_activated($config['per_page'], $pag, $config['total_rows']);				
		$data['to_skip'] = $config['per_page'];
		$this->load->view('panou_admin/petitii_locale', $data);		
	}
	
	public function petitii_respinse($to_skip){	 //v
		$admin = $this->login_model->este_admin();
		if($admin == 1){			
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
				);			
		}else{
			redirect('prima_pagina');
			exit;
		}		
		$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/petitii_respinse/';
		$config['total_rows'] = $this->petition_model->record_count_respinse();				
		$config['uri_segment'] = 3;
		$config['per_page'] = 5;
		$config['num_links'] = 10;
				
		$this->pagination->initialize($config);		
		
		$pag = (int)$this->uri->segment(3);	$pag /= $config['per_page'];
		
		$data['petitii'] = $this->petition_model->get_all_respinse($config['per_page'], $pag, $config['total_rows']);				
		$data['to_skip'] = $config['per_page'];
		$this->load->view('panou_admin/petitii_locale', $data);		
	}
	
	public function respinge($id_petitie, $mesaj){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_petitie = $this->general->xss_safe($id_petitie);
			$mesaj = $this->general->xss_safe($mesaj);
			
			$this->petition_model->reject($id_petitie);
			$id_user = $this->general->get_user_by_id_petitie($id_petitie);
			$titlu = $this->petition_model->get_title_petition_sql($id_petitie);	
			if($mesaj == ''){
				$mesaj = 'Petiția ta a fost respinsă';
			}
			$this->general->insert_mesaj($id_user, $mesaj, $titlu);
			$this->load->view('panou_admin/respingere');
		}else{
			redirect('prima_pagina');
		}
	}
	public function aproba($id_petitie){ // v
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_petitie = $this->general->xss_safe($id_petitie);
			if($this->petition_model->aprove($id_petitie)){
				$id_user = $this->general->get_user_by_id_petitie($id_petitie);
				$titlu = $this->petition_model->get_title_petition_sql($id_petitie);
				$mesaj = 'Petiția ta a fost aprobată';
				$this->general->insert_mesaj($id_user, $mesaj, $titlu);
				$this->load->view('panou_admin/aprobare');
			}else{
				$data['mesaj'] = 'A fost o eroare pe parcurs';
				$this->load->view('panou_admin/mesaje', $data);
				$this->load->view('prima_pagina/footer');
			}
		}else{
			redirect('prima_pagina');
		}		
	}
	public function sterge($id_petitie){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_petitie = $this->general->xss_safe($id_petitie);
			$this->petition_model->delete_admin($id_petitie);
			$id_user = $this->general->get_user_by_id_petitie($id_petitie);
			$titlu = $this->petition_model->get_title_petition_sql($id_petitie);
			$mesaj = 'Petiția ta a fost stearsă';
			$this->general->insert_mesaj($id_user, $mesaj, $titlu);
			$data['mesaj'] = 'Petitia a fost stearsa'; 
			$this->load->view('panou_admin/mesaje', $data);
			$this->load->view('prima_pagina/footer');
		}else{
			redirect('prima_pagina');
		}		
	}
	
	public function raspunde($id_petitie){
		$admin = $this->login_model->este_admin();
		if($admin == 1){			
			$id_petitie = $this->general->xss_safe($id_petitie);
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);							
			$data['id'] = $id_petitie;
			$this->load->view('raspunsuri/petitie_raspunde', $data);
			$this->load->view('prima_pagina/footer');		
		}else{
			redirect('prima_pagina');
		}
	}
	public function raspuns(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_petitie = (int)$this->input->post('id_petitie');
			$titlu = $this->input->post('titlu');
			$titular = $this->input->post('titular');
			$raspuns = $this->input->post('raspuns');						
			$this->general->insert_raspuns_sql($id_petitie, $titlu, $raspuns, $titular);
			//$this->general->sterge_petitie_voturi($id_petitie);
			$id_user = $this->general->get_user_by_id_petitie_cloud($id_petitie);
			$titlu = $this->petition_model->get_title_petition_cloud($id_petitie);
			$mesaj = 'Petiția ta a primit un răspuns oficial';
			$this->general->insert_mesaj($id_user, $mesaj, $titlu);
			$mesaj2 =  'Petiția semnată de tine a primit un răspuns oficial.';
			$this->general->send_mesaj_raspunde($id_user, $id_petitie, $mesaj2, $titlu);
			redirect('raspunsuri/afisare_raspuns/'.$id_petitie);
			exit;
		}else{
			redirect('prima_pagina');
		}					
	}		
	public function editare_raspuns($id_petitie){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_petitie = $this->general->xss_safe($id_petitie);
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$data['raspuns'] = $this->general->get_response($id_petitie);
		$data['id'] = $id_petitie;
		$this->form_validation->set_rules('titlu', 'Titlul Raspunsului', 'min_length[5]|trim');
		$this->form_validation->set_rules('titular', 'Titlularul Raspunsului', 'min_length[5]|trim');
		$this->form_validation->set_rules('raspuns', 'Raspunsul', 'min_length[5]|trim');		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('panou_admin/editare_raspuns', $data);
		}else{
			$id_petitie = (int)$this->input->post('id_petitie');
			$titlu = $this->input->post('titlu');
			$titular = $this->input->post('titular');
			$raspuns = $this->input->post('raspuns');	
			$this->general->Update_raspuns($titlu, $titular, $raspuns, $id_petitie);
			redirect('raspunsuri/afisare_raspuns/'.$id_petitie);
			exit;
		}
	
	}
	public function lista_votanti($id_petitie){
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$config['base_url'] = 'http://hackrogov.cloudapp.net/petitii/panou_admin/lista_votanti/'.$id_petitie.'/';
			$config['total_rows'] = $this->petition_model->get_total_voters($id_petitie);				
			$config['uri_segment'] = 4;
			$config['per_page'] = 3;
			$config['num_links'] = 10;
		
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
			
			$data['votanti'] = $this->petition_model->get_voters($id_petitie, $config['per_page'], $pag + 1, $config['total_rows']);
			$this->load->view('panou_admin/lista_votanti', $data);
		}else{
			redirect('prima_pagina');
		}
	}
	public function suspendare_user($id_user){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_user = $this->general->xss_safe($id_user);
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$this->general->suspend_user($id_user);
		$data['mesaj'] =  'Cont susependat cu succes';
		$this->load->view('panou_admin/mesaje', $data);
		$this->load->view('prima_pagina/footer');
	}
	
	public function unsuspendare_user($id_user){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_user = $this->general->xss_safe($id_user);
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$this->general->unsuspend_user($id_user);
		$data['mesaj'] =  'Cont activat cu succes';
		$this->load->view('panou_admin/mesaje', $data);
		$this->load->view('prima_pagina/footer');
	}
	
	public function suspendare_multiple(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$iduri = $this->input->post('useri');
			$id_useri = explode(",", $iduri);	
			$limit = count($id_useri);
			for($i = 0; $i < $limit; $i++){
				$this->general->suspend_user($id_useri[$i]);
			}
		}else{
			redirect('prima_pagina');
		}
	}
	public function unsuspendare_multiple(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$iduri = $this->input->post('useri');
			$id_useri = explode(",", $iduri);	
			$limit = count($id_useri);
			for($i = 0; $i < $limit; $i++){
				$this->general->unsuspend_user($id_useri[$i]);
			}
		}else{
			redirect('prima_pagina');
		}
	}
	public function stergere_multiple(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$iduri = $this->input->post('useri');
			$id_useri = explode(",", $iduri);	
			$limit = count($id_useri);
			for($i = 0; $i < $limit; $i++){
				$this->general->stergere_user($id_useri[$i]);
			}
		}else{
			redirect('prima_pagina');
		}
	}
	
	public function stergere_user($id_user){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_user = $this->general->xss_safe($this->uri->segment(3));
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$this->general->stergere_user($id_user);
		$data['mesaj'] =  'Cont sters cu succes';
		$this->load->view('panou_admin/mesaje', $data);
		$this->load->view('prima_pagina/footer');
	}
	public function editare_user($id_user){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$id_user = $this->general->xss_safe($id_user);
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$user = $this->general->get_user($id_user);
		$data['user'] = $user->row();						
		$this->form_validation->set_rules('telefon', 'Telefon', 'min_length[7]|numeric|trim');
		$this->form_validation->set_rules('adresa', 'Adresa', 'min_length[5]|trim');
		$this->form_validation->set_rules('localitate', 'Localitate', 'min_length[3]|trim');
		$this->form_validation->set_rules('judet', 'Judet', 'trim');
		$this->form_validation->set_rules('mediu', 'Mediu', 'trim');
		$this->form_validation->set_rules('sex', 'Sex', 'trim');
		$this->form_validation->set_rules('varsta', 'Varsta', 'min_length[3]|trim');
		$this->form_validation->set_rules('ocupatie', 'Ocupatie', 'min_length[2]|trim');		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('panou_admin/editare_user', $data);
		}else{						
			$telefon = $this->general->xss_safe($this->input->post('telefon'));
			$adresa = $this->general->xss_safe($this->input->post('adresa'));
			$localitate = $this->general->xss_safe($this->input->post('localitate'));
			$judet = $this->general->xss_safe($this->input->post('judet'));
			$mediu = $this->general->xss_safe($this->input->post('mediu'));
			$sex = $this->general->xss_safe($this->input->post('sex'));
			$varsta = $this->general->xss_safe($this->input->post('varsta'));
			$ocupatie = $this->general->xss_safe($this->input->post('ocupatie'));
			$this->general->update_user($telefon, $adresa, $localitate, $judet, $mediu, $sex, $varsta, $ocupatie, $id_user);
			redirect('panou_admin/user/'.$id_user);
			exit;
		}	
	}
	public function user($id_user){
		
		$admin = $this->login_model->este_admin();
		if($admin == 1){				
			$id_user = $this->general->xss_safe($id_user);
			if($id_user == 0){
				redirect('panou_admin');
			}
			$mesaj_nevaz = $this->general->mesaje_nevazute($this->session->userdata('id'));
			$data = array(
				'title' => 'petiții.gov.ro &ndash; Vocea ta în Guvernul României | Panou de administrare',
				'nume' => $this->session->userdata('nume'),
				'prenume' => $this->session->userdata('prenume'),
				'logat' => true,
				'admin' => TRUE,
				'email' => $this->session->userdata('email'),
				'mesaje' => $mesaj_nevaz
			);
			$this->load->view('prima_pagina/header_li', $data);		
		}else{
			redirect('prima_pagina');
		}
		$user = $this->general->get_user($id_user);
		$data2['user'] = $user->row();		
		$data2['data'] = Date('Y-m-d H:i:s');
		$data2['petitii_semnate'] = $this->petition_model->get_signs_of_user($data2['user']->NUME, $data2['user']->PRENUME, $data2['user']->EMAIL);		
		$data2['petitii_inititiate'] = $this->petition_model->get_petition_of_user_in($id_user);		
		$data2['petitii_aprobate'] = $this->petition_model->get_petition_of_user_aproved($id_user);	
		$data2['istoric_ipuri'] = $this->login_model->get_ip($id_user);
		$stare = array();
		foreach ($data2['petitii_aprobate'] as $petitie) {			
			array_push($stare, $this->petition_model->get_stare($petitie['id'], $petitie['datatinta'], $petitie['voturi']));			
		}				
		$data2['stare'] = $stare;
		$this->form_validation->set_rules('telefon', 'Telefon', 'required|min_length[7]|numeric|trim');
		$this->form_validation->set_rules('adresa', 'Adresa', 'required|min_length[5]|trim');
		$this->form_validation->set_rules('localitate', 'Localitate', 'required|min_length[3]|trim');
		$this->form_validation->set_rules('judet', 'Judet', 'trim');
		$this->form_validation->set_rules('mediu', 'Mediu', 'required|trim');
		$this->form_validation->set_rules('sex', 'Sex', 'required|trim');
		$this->form_validation->set_rules('varsta', 'Varsta', 'required|min_length[3]|trim');
		$this->form_validation->set_rules('ocupatie', 'Ocupatie', 'required|min_length[2]|trim');		
		if ($this->form_validation->run() == TRUE){						
			$telefon = $this->general->xss_safe($this->input->post('telefon'));
			$adresa = $this->general->xss_safe($this->input->post('adresa'));
			$localitate = $this->general->xss_safe($this->input->post('localitate'));
			$judet = $this->general->xss_safe($this->input->post('judet'));
			$mediu = $this->general->xss_safe($this->input->post('mediu'));
			$sex = $this->general->xss_safe($this->input->post('sex'));
			$varsta = $this->general->xss_safe($this->input->post('varsta'));
			$ocupatie = $this->general->xss_safe($this->input->post('ocupatie'));
			$this->general->update_user($telefon, $adresa, $localitate, $judet, $mediu, $sex, $varsta, $ocupatie, $id_user);
		}	
		$this->load->view('panou_admin/user', $data2);
		$this->load->view('prima_pagina/footer');		
	}
	
	public function mesaj_allusers(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){	
			$mesaj = $this->input->post('mesaj');
			$titlu = 'Mesaj de la administrator';
			$admin = $this->session->userdata('nume') . ' '. $this->session->userdata('prenume');
			$this->general->insert_all_mesaj($mesaj, $titlu, $admin);			
		}else{
			redirect('prima_pagina');
		}
	}
	public function istoric_mesaje(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){							
			$data['mesaje'] = $this->general->get_mesaje_admin();					
			$this->load->view('panou_admin/istoric_mesaje', $data);
		}else{
			redirect('prima_pagina');
		}
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
