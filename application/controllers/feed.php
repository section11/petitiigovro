<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

	public function __construct(){	
        parent::__construct();             
		$this->load->helper('xml');
		$this->load->helper('url');
		$this->load->helper('text');
        $this->load->model('petition_model');
		$this->load->model('general');
	}
	
	function index(){
		$this->load->view('feed/feed');
	}
	public function petitii_recente(){
		$cate = 10;
		$data['feed_name'] = 'petitii.gov.ro';
		$data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://hackrogov.cloudapp.net/petitii/feed';
        $data['page_description'] = 'Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României avansând o petiție nouă sau semnând o petiție deja deschisă.';        
        $data['creator_email'] = 'drp@gov.ro';
        $data['last_petitions'] = $this->general->get_last_petitions_feed($cate);            
        header("Content-Type: application/rss+xml");		
		$this->load->view('feed/rss1', $data);
	}
	public function top_petitii(){
		$cate = 10;
		$data['feed_name'] = 'petitii.gov.ro';
		$data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://hackrogov.cloudapp.net/petitii/feed';
        $data['page_description'] = 'Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României avansând o petiție nouă sau semnând o petiție deja deschisă.';        
        $data['creator_email'] = 'drp@gov.ro';         
		$data['top_petitions'] = $this->general->get_top_petitions($cate); 
        header("Content-Type: application/rss+xml");		
		$this->load->view('feed/rss2', $data);
	}
	public function raspunsuri_recente(){
		$cate = 10;
		$data['feed_name'] = 'petitii.gov.ro';
		$data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://hackrogov.cloudapp.net/petitii/feed';
        $data['page_description'] = 'Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României avansând o petiție nouă sau semnând o petiție deja deschisă.';        
        $data['creator_email'] = 'drp@gov.ro';        
        $data['last_respons'] = $this->general->get_raspunsuri($cate);	   		
        header("Content-Type: application/rss+xml");		
		$this->load->view('feed/rss3', $data);
	}
}