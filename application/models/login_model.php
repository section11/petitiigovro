<?php
class login_model extends CI_Model {
	
	protected $conturi = 'conturi';
	protected $istoric = 'istoric_autentificari';
	
	function este_logat(){
		return ($this->session->userdata('logat') === TRUE);
	} 
	
	function este_admin(){
		return ($this->session->userdata('admin') === TRUE);
	}
	
	function logout(){
		$this->session->sess_destroy();
	}
	
	function get_nume_utilizator($id){
			$data = array('id' => $id);
			$this->db->where($data);
			$query = $this->db->get($this->conturi);
			$row = $query->row();
			return $row->nume;
	}
	function get_utilizator($id){
			$data = array('id' => $id);
			$this->db->where($data);
			$query = $this->db->get($this->conturi);
			$row = $query->row();
			return $row;
	}
	
	function autentifica($email, $parola, $remember = FALSE){
		$parola = md5($parola);
		$data = array(
				'EMAIL' => $email,
				'PAROLA' => $parola,
				'ACTIV' => 1
		);
		$this->db->where($data); 
		$query = $this->db->get($this->conturi);
		if($query->num_rows() == 0 ){
			return 0;
		}else{
			$row = $query->row(); 
			$date = Date('Y-m-d H:i:s');			
			if($row->DATASUSPENDARE > $date){
				return 5;			
			}else{				
				if($remember == 'true'){
					$timp = 0;
				}else{
					$timp = 86400;
				}
				if($row->ADMIN == '1'){					
					$admin = true;
				}else{
					$admin = false;
				}
				$newdata = array(
					   'id'   => $row->ID,
					   'nume'  => $row->NUME,
					   'prenume' => $row->PRENUME,
					   'email'     => $email,
					   'sex' => $row->SEX,
					   'logat' => TRUE,
					   'admin' => $admin,
					   'sess_expiration' => $timp
					   
				);				
				$ip_uri = array(
					'IP' => $_SERVER['REMOTE_ADDR'], 					
					'id_user' => $row->ID,
					'data' => $date,
				);
				$this->db->insert($this->istoric, $ip_uri);
				$this->session->set_userdata($newdata);
				return 1;
			}
		}
	}
	public function forgot_pass($email, $varsta){
		$this->db->where('EMAIL', $email);
		$this->db->where('DATA_N', $varsta);
		$query = $this->db->get($this->conturi);
		if($query->num_rows() == 0){
			return 0;
		}else{
			foreach ($query->result() as $row){   
				$row = $query->row();
				$this->trimite($email, $row->NUME, $row->PRENUME);
				return 1;
				break;
			}			
		}
	}
	public function new_pass($cod, $newpass){
		$data = array(
			'COD_FORGOT' => $cod
		);
		$this->db->where($data);
		$data2 = array(
			'PAROLA' => $newpass
		);
		$this->db->update($this->conturi, $data2);		
		if($this->db->affected_rows()){
			return 1;
		}else{
			return 0;
		}
	}
	function generateRandomString($length = 15) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	public function trimite($email, $nume, $prenume){
		$activation_code = $this->generateRandomString();
		$activation_code .= $nume; $activation_code .= $prenume;
		$data1 = array(
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email,
		);
		$data2 = array(
			'COD_FORGOT' => $activation_code
		);
		$this->db->where($data1);
		$this->db->update($this->conturi, $data2);

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
		$this->email->from('noreply@petitii.gov.ro', 'PETITII.GOV.RO');
		$this->email->to($email); 
		$this->email->subject('Informații pentru resetarea parolei');	
		$body = 'Pentru a reseta parola aferenta contului de utilizator înregistrat pe adresa de e-mail '.$email.' accesează trimiterea următoare direct sau copiind-o în bara de adresă a navigatorului:
		<a href="'.base_url().'login/new_pass/'.$activation_code.'">LINK AICI</a> 
		Urmărește apoi cu atenție instrucțiunile prezentate pentru a obține o nouă parolă. Trimiterea poate fi folosită o singură dată.<br>
		________________________________<br>
		Acest mesaj a fost transmis în mod automat de Petitii.Gov.Ro întrucât cineva a încercat să reseteze parola aferentă acestei adrese de e-mail.';	
		$this->email->message($body);	
		if($this->email->send()){		
			return 1;
		}else{		
			return 0;
		}
	}
	public function get_ip($id_user){
		$this->db->where('id_user', $id_user);
		$query = $this->db->get($this->istoric);
		$ip_uri = array();
		foreach($query->result() as $row){
			$ip = array(
				'ip' => $row->IP,
				'data' => $row->data
			);
			$ip_uri[] = $ip;
		}
		return $ip_uri;
	}	
}

?>