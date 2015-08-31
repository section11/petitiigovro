<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sterge_conturi_cron extends CI_Controller {

	public function __construct(){	
        parent::__construct();              
        $this->load->model('general');            
	}
	
	public function index(){
		$this->general->sterge_conturi_7zile();		
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
