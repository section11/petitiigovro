<?php

class printmail_model extends CI_Model {

	function trimitepdf($email){
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = 'seomailway@gmail.com';
		$config['smtp_pass'] = 'televizor123';
		$config['smtp_port'] = 465;
		$config['priority'] = 1;		
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('no-reply@petitii.gov.ro', 'Petitii gov.ro');
		$this->email->to($email); 
		$this->email->subject('Petitie petitii.gov.ro');
		$body    = 'Test PDF'; 	
		$this->email->message($body);
		$this->email->attach('petitie_'.date("d.m.Y").'.pdf');		
		if($this->email->send()){		
			return 1;
		}else{		
			return 0;
		}
	}
}

?>