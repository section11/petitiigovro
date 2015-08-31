<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class print_petitie extends CI_Controller {

	/**
		
	*/
	 
	public function __construct(){	
            parent::__construct();  
            $this->load->model('RestServiceClient');			
            $this->load->model('general');		
			$this->load->model('printmail_model');				
			$this->load->model('login_model');				
	}
	
	public function index(){
		$admin = $this->login_model->este_admin();
		if($admin == 1){
			$this->form_validation->set_rules('id_petitie', 'id petitie hackere', 'required|numeric');
			if($this->form_validation->run() == TRUE){
				$id = (int)$this->input->post('id_petitie');
				$data['rezultate'] = $this->RestServiceClient->get_petitie($id);
				$data['autor'] = $this->general->get_author($id);
				$data['mailtel'] = $this->general->get_mailtel($id);
				$data['semnaturi'] = $this->general->get_last_signs($id);
				$this->load->library('mpdf');
				$this->load->view('print_petitie/content', $data);
			}else{
				redirect('prima_pagina');
			}
		}else{
			redirect('prima_pagina');
		}		
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */