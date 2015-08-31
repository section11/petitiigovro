<?php

class register_model extends CI_Model {
	
	protected $conturi = 'conturi';
	
	function exista($email){
		$data = array('EMAIL' => $email);
		$this->db->where($data); 
		$query = $this->db->get($this->conturi);
		if($query->num_rows() == 0 ){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	function insereaza($parola, $nume, $prenume, $email){
		$parola = md5($parola);
		$data = array(
			'PAROLA' => $parola,
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email,							
			'DATA' => date('Y-m-d H:i:s'),			
			'ACTIV' => 0,
			'COD' => '0'
		);
		$this->db->insert($this->conturi, $data);
	}
	function generateRandomString($length = 15) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
 
	function trimite($nume, $prenume, $email){
		$activation_code = $this->generateRandomString();
		$activation_code .= $nume; $activation_code .= $prenume;
		$data1 = array(
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email,
		);
		$data2 = array(
			'COD' => $activation_code
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
		$this->email->from('petitii@gov.ro', 'PETITII.GOV.RO');
		$this->email->to($email); 
		$this->email->subject('Informații pentru validarea contului');
		$body = 
		'
		Pentru validarea contului tău în cadrul petiții.gov.ro este necesar să accesezi <a href="'.base_url().'inregistrare/activare/'.$activation_code .'">această legătură (click)</a>.
		Sistemului i se va confirma în acest fel faptul că adresa curentă de e-mail este activă și titularul acesteia este cel care a completat recent formularul de înregistrare. 
		<br><br>
		În pasul următor ţi se va solicita să introduci data naşterii şi judeţul de reşedinţă. După completarea acestor informaţii, contul va deveni funcţional.
		<br><br>
		În situaţia în care te-ai înregistrat în timp ce încercai să semnezi o petiţie, reţine faptul că va trebui să revii la iniţiativa respectivă pentru a o semna odată ce eşti autentificat în cadrul sistemului.
		<br><br>
		După validare, poți completa <a href="'.base_url().'profil_utilizator">profilul tău aici</a>, introducând informații despre adresa de domiciliu, ocupația, numărul de telefon etc.
		<br><br>
		Îţi mulţumim!
		<br><br><br>
		________________________________<br>
		Acest mesaj a fost transmis în mod automat de Petitii.Gov.Ro întrucât cineva a încercat să înregistreze un cont folosind această adresă de e-mail. În situația în care înregistrarea nu vă aparține, ignorați acest mesaj. Conturile neactivate sunt șterse automat din baza de date la 7 zile de la transmiterea prezentului mesaj.
		';
		$this->email->message($body);	
		if($this->email->send()){		
			return 1;
		}else{		
			return 0;
		}
	}
	function activare($cod){
		$data = array('COD' => $cod);
		$this->db->where($data); 
		$query = $this->db->get($this->conturi);
		if($query->num_rows() == 0 ){
			return 0;
		}else{
			$data2 = array('ACTIV' => 1);
			$this->db->where($data);
			$this->db->update($this->conturi, $data2);
			return 1;
		}
	}
	public function varsta_minima($varsta){
		$birthday = strtotime($varsta);
		$today = strtotime("now");
		
		$valid_date = strtotime("+ 14 years", $birthday);
		
		if($today < $valid_date){
			return 1;
		}else{
			return 0;
		}
	}
	public function insert_second_step($cod, $varsta, $judet){
		$data = array(
			'DATA_N' => $varsta,
			'JUDET' => $judet
		);
		$this->db->where('COD', $cod);
		$this->db->update($this->conturi, $data);
	}
}

?>