<?php
class General extends CI_Model {

	protected $maxim = 'maxim';
	protected $conturi = 'conturi';
	protected $raspunsuri = 'raspunsuri';
	protected $petitii_voturi = 'petitii_voturi';
	protected $mesaje = 'mesaje';
	protected $petitii = 'petitii';
	protected $petitii_aprobate = 'petitii_aprobate';
	protected $categorii = 'categorii';
	protected $cat = 'categorii';
	protected $voturi = 'voturi';
	protected $istoric_ip = 'istoric_autentificari';

	public function __construct(){	
            parent::__construct();  			
			$this->load->model('RestServiceClient');		
			$this->load->model('petition_model');		
	}

	
	public function get_author($id){
		$rezultate = $this->petition_model->get_title_petition_cloud($id);
		$ask = array(
					'ID' => $rezultate['initiator']
				);
		$this->db->where($ask);
		$query = $this->db->get('conturi');
		if($query->num_rows() != 0){
			$row = $query->row();
			$author = $row->PRENUME.' '.$row->NUME;
		}else{
			$author = 'Necunoscut';
		}
		if($author == " "){
			$author = 'Necunoscut';
		}		
		return $author;
	} 
	
	/*
		Asta ia autorul fara sa mai ceara din petitie
	*/
	public function get_author2($id_user){//v
		$ask = array(
			'ID' => $id_user
		);
		$this->db->where($ask);
		$query = $this->db->get('conturi');
		if($query->num_rows() != 0){
			$row = $query->row();
			$author = $row->PRENUME.' '.$row->NUME;
		}else{
			$author = 'Necunoscut';
		}
		if($author == " ")
			$author = 'Necunoscut';
		return $author;
	}
	public function get_top_petitions($cate){ //v	
		$this->db->order_by('nrvoturi', 'desc');		
		$this->db->where('datatinta >=', date('Y-m-d H:i:s'));
		$this->db->limit($cate);
		$query = $this->db->get($this->petitii_aprobate);
		$petitii = array();
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			$diff = abs(strtotime($res['datatinta']) - strtotime($date2));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$result = array(
					'titlu' => $res['titlu'],
					'descriere' => $res['textpetitie'],
					'initiator' => $res['iduser'],
					'data' => $res['data'],
					'voturi' => $res['nrvoturi'],
					'id' => $res['id'],
					'datatinta' => $res['datatinta'],
					'data_expirarii' => date("d.m.Y", strtotime($res['datatinta'])),
					'zile' => $days,
					'author' => $this->general->get_author2($res['iduser'])
			);		
			$petitii[] = $result;
		}
		return $petitii;
	}
	public function get_last_petitions(){ //v
		$this->db->order_by('id', 'desc');
		$this->db->where('datatinta >=', date('Y-m-d H:i:s'));
		$this->db->limit(3);
		
		$query = $this->db->get($this->petitii_aprobate);
		$petitii = array();
		
		foreach($query->result_array() as $res){
			$result = array(
					'titlu' => $res['titlu'],
					'descriere' => $res['textpetitie'],
					'initiator' => $res['iduser'],
					'data' => $res['data'],
					'voturi' => $res['nrvoturi'],
					'id' => $res['id'],
					'datatinta' => $res['datatinta'],
					'data_expirarii' => date("d.m.Y", strtotime($res['datatinta'])),
					'author' => $this->general->get_author2($res['iduser'])
			);		
			$petitii[] = $result;
		}
		return $petitii;
	}
	public function get_last_petitions_feed($cate){
		$this->db->order_by('id', 'desc');
		$this->db->where('datatinta >=', date('Y-m-d H:i:s'));
		$this->db->limit($cate);
		
		$query = $this->db->get($this->petitii_aprobate);
		$petitii = array();
		
		foreach($query->result_array() as $res){
			$result = array(
					'titlu' => $res['titlu'],
					'descriere' => $res['textpetitie'],
					'initiator' => $res['iduser'],
					'data' => $res['data'],
					'voturi' => $res['nrvoturi'],
					'id' => $res['id'],
					'datatinta' => $res['datatinta'],
					'data_expirarii' => date("d.m.Y", strtotime($res['datatinta'])),
					'author' => $this->general->get_author2($res['iduser'])
			);		
			$petitii[] = $result;
		}
		return $petitii;
	}
	public function categorie($cat){ //v
		$categorie = null;
		$data = array('CATEGORIE_N' => $cat);		
		$this->db->where($data);
		$query = $this->db->get($this->cat);
		$categorie = '';
		if($query->num_rows() != 0){
			foreach($query->result() as $row){
				$categorie = $row->CATEGORIE_M;
				break;
			}
		}
		if($categorie == null)
			return '';
		else 
			return $categorie;
	}
	
	public function get_categorie($categorie){ //v
		$categorie = explode(' ', $categorie);
		$categorie2 = '';
		$i = count($categorie); $j = 0;		
		$i--;
		$categorie2 = $categorie2 .'<a href="'.base_url().'petitii_deschise/categorie/'.$categorie[0].'">'.$this->categorie($categorie[0]).'</a>';
		for($k = 1; $k <= $i; $k++){
			if($this->categorie($categorie[$k]) != ''){
				$categorie2 = $categorie2 .', <a href="'.base_url().'petitii_deschise/categorie/'.$categorie[$k].'">'.$this->categorie($categorie[$k]).'</a>';
			}	
		}		
		return $categorie2;
	}
	public function xss_safe ($str) { //v
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
	
	public function get_mailtel($id){
		$rezultate = $this->petition_model->get_petitie_aprobate($id);
		$ask = array(
					'ID' => $rezultate['initiator']
				);
		$this->db->where($ask);
		$query = $this->db->get('conturi');
		$row = $query->row();
		if($query->num_rows() != 0){			
			$email = $row->EMAIL;
			$tel = $row->TELEFON;
		}else if($row->TELEFON == null){
			$tel = '-';
		}
		
		$detalii = array(
			'email' => $email,
			'telefon' => $tel
		);
		return $detalii;
	} 
	
	public function get_categorii(){ //v
		$data = array('ACTIV' => 1);
		$this->db->where($data);
		$query = $this->db->get($this->cat);
		$categorii = array();
		foreach($query->result() as $row){
			$categorie = array(
				'id' => $row->ID,
				'categorie_d' => $row->CATEGORIE_D,
				'categorie_n' => $row->CATEGORIE_N,
				'categorie_m' => $row->CATEGORIE_M,
			);
			$categorii[] = $categorie;
		}
		return $categorii;
	}
	
	public function get_last_signs($id_petitie){ //v
		$data = array('ID_PETITIE' => $id_petitie);
		$this->db->where($data);
		$this->db->order_by('ID_PETITIE', 'desc');	
		$query = $this->db->get($this->voturi);
		$semnaturi = array();
		foreach($query->result() as $row){
			$semnatura = array(
					'nume' => $row->NUME,
					'prenume' => $row->PRENUME,
					'data'	=> $row->DATA,
					'oras' => $this->get_oras($row->NUME, $row->PRENUME, $row->EMAIL)
				);
			$semnaturi[] = $semnatura;
		}
		return $semnaturi;
	}
	public function get_oras($nume, $prenume, $email){ //v
		$data = array(
			'EMAIL' => $email,
			'NUME' => $nume,
			'PRENUME' => $prenume
			
		);
		$this->db->where($data);
		$query = $this->db->get($this->conturi);
		$oras = '';
		if($query->num_rows() != 0){
			foreach($query->result() as $row){
				$oras = $row->JUDET;
				break;
			}
		}
		return $oras;
	}	
	public function truncateString($string, $limit, $break = ".", $pad = "..."){ //v
	  // return with no change if string is shorter than $limit
	  if(strlen($string) <= $limit) return $string;

	  // is $break present between $limit and the end of the string?
	  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
	    if($breakpoint < strlen($string) - 1) {
	      $string = substr($string, 0, $breakpoint) . $pad;
	    }
	  }

	  return $string;
	}
	
	public function get_users($start, $limit){	//v	
		$this->db->order_by('ID', 'desc');
		$this->db->limit($start, $limit);
		$query = $this->db->get($this->conturi);
		return $query->result();
	}
	public function get_user($id_user){ //v
		$this->db->where('ID', $id_user);
		return $this->db->get($this->conturi);		
	}
	public function suspend_user($id_user){ //v
		$data = array(
			'ID' => $id_user
		);
		$this->db->where($data);
		$date = date('Y-m-d H:i:s');
		$date = date('Y-m-d H:i:s', strtotime($date.' + 30 days'));
		$data2 = array(
			'DATASUSPENDARE' =>  $date
		);
		$this->db->update($this->conturi, $data2);
	}
	public function unsuspend_user($id_user){ //v
		$data = array(
			'ID' => $id_user
		);
		$this->db->where($data);
		$date = date('Y-m-d H:i:s');
		$data2 = array(
			'DATASUSPENDARE' =>  $date
		);
		$this->db->update($this->conturi, $data2);
	}
	public function stergere_user($id_user){ //v
		$data = array(
			'ID' => $id_user
		);
		$this->db->where($data);
		$this->db->delete($this->conturi);
		
		$data2 = array(
			'iduser' => $id_user
		);
		$this->db->where($data2);
		$this->db->delete($this->petitii);		
		
		$data3 = array(
			'id_user' => $id_user
		);
		$this->db->where($data3);
		$this->db->delete($this->mesaje);		
	}
	public function update_user($telefon, $adresa, $localitate, $judet, $mediu, $sex, $varsta, $ocupatie, $id_user){ //v
		$data = array(						
			'TELEFON' => $telefon,
			'ADRESA' => $adresa,
			'LOCALITATE' => $localitate,
			'JUDET' => $judet,
			'MEDIU' => $mediu,
			'SEX' => $sex,
			'DATA_N' => $varsta,			
			'OCUPATIE' => $ocupatie,			
		);
		$this->db->where('ID', $id_user);
		$this->db->update($this->conturi, $data);
	}
	public function insert_raspuns_sql($id_petitie, $titlu_raspuns, $mesaj_raspuns, $respondent){ //v		
		$this->db->where('id', $id_petitie);
		$query = $this->db->get($this->petitii_aprobate);
		$petitie = $query->row();		
		$categorie1 = $petitie->categorie1;
		if(isset($petitie->categorie2)){
			$categorie2 = $petitie->categorie2;
		}else{
			$categorie2 = '';
		}
			
		if(isset($petitie->categorie3)){
			$categorie3 = $petitie->categorie3;
		}else{
			$categorie3 = '';
		}
		$data = array(
			'id_petitie_cloud' => $id_petitie,
			'titlu' => $titlu_raspuns,
			'raspuns' => $mesaj_raspuns,
			'respondent' => $respondent,
			'categorie1' => $categorie1,
			'categorie2' => $categorie2,
			'categorie3' => $categorie3,
			'data' => date('Y-m-d H:i:s')
		);
		$this->db->insert($this->raspunsuri, $data);
		
		
		$data2 = array(
			'id' => $id_petitie
		);
		$data3 = array(
			'raspuns' => 1
		);
		$this->db->where($data2);
		$this->db->update($this->petitii_aprobate, $data3);
	}
	public function get_response($id){//v
		$this->db->where('id_petitie_cloud', $id);
		$query = $this->db->get($this->raspunsuri);
		foreach($query->result_array() as $raspuns){
			if(!array_key_exists('categorie2', $raspuns)){
				$categorie2 = '';
			}else{
				$categorie2 = ' '. $raspuns['categorie2'];
			}
			
			if(!array_key_exists('categorie3', $raspuns)){
				$categorie3 = '';
			}else{
				$categorie3 = ' '. $raspuns['categorie3'];
			}
			$result = array(
				'id' => $id,
				'titlu' => $raspuns['titlu'],
				'raspuns' => $raspuns['raspuns'],
				'data' => $raspuns['data'],				
				'respondent' => $raspuns['respondent'],		
				'categorie' => $this->get_categorie($raspuns['categorie1']. $categorie2. $categorie3),
				'titlu_petitie' => $this->petition_model->get_title_petition_cloud($id)
            );			
			return $result;
			break;
		}
	}
	public function Update_raspuns($titlu, $titular, $raspuns, $id_petitie){
		$this->db->where('id_petitie_cloud', $id_petitie);
		$data = array(
			'titlu' => $titlu,
			'raspuns' => $raspuns,
			'respondent' => $titular
		);
		$this->db->update($this->raspunsuri, $data);		
	}
	public function received_answer($id_petitie){ //v
		$this->db->where('id_petitie_cloud', $id_petitie);
		$query = $this->db->get($this->raspunsuri);
		if($query->num_rows() == 0){
			return 0;
		}else {
			return 1;
		}
	}
	public function get_raspunsuri($number){  // v
		$this->db->order_by('id', 'desc');
		$this->db->limit($number);
		$query = $this->db->get($this->raspunsuri);
		$raspunsuri = array();
		foreach($query->result_array() as $raspuns){
			$result = array(
				'id' => $raspuns['id_petitie_cloud'],
				'titlu' => $raspuns['titlu'],
				'raspuns' => $raspuns['raspuns'],
				'data' => $raspuns['data'],				
				'respondent' => $raspuns['respondent'],									
            );			
			$raspunsuri[] = $result;
		}		
		return $raspunsuri;
	}
	public function get_raspuns_by_category_number($categorie){		
		$this->db->where('categorie1', $categorie);
		$this->db->or_where('categorie2', $categorie);
		$this->db->or_where('categorie3', $categorie);		
		
		$query = $this->db->get($this->raspunsuri);
		return $query->num_rows();
	} 
	public function get_response_by_category($per_page, $number1, $total, $categorie){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('categorie1', $categorie);
		$this->db->or_where('categorie2', $categorie);
		$this->db->or_where('categorie3', $categorie);				
		$this->db->limit($number2);
		$query = $this->db->get($this->raspunsuri);
		$petitii = array(); $j = 0;	$i = 0;		
		foreach($query->result_array() as $raspuns){
			if($i >= $limit_start && $i <= $limit_end){				
				
				$result = array(
					'id_petitie' => $raspuns['id_petitie_cloud'],
					'titlu' => $raspuns['titlu'],
					'raspuns' => $raspuns['raspuns'],
					'data' => $raspuns['data'],				
					'respondent' => $raspuns['respondent'],
				);
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	public function ListResponse(){ //v
		return $this->db->count_all($this->raspunsuri);
	}
	public function get_result_limits_raspunsuri($per_page, $number1, $total){ //v
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;				
		$query = $this->db->get($this->raspunsuri);		
		$raspunsuri = array();
		$i = 0;
		foreach($query->result_array() as $raspuns){
			if($i >= $limit_start && $i < $limit_end){
				$result = array(
					'id' => $raspuns['id'],
					'titlu' => $raspuns['titlu'],
					'raspuns' => $raspuns['raspuns'],
					'data' => $raspuns['data'],				
					'respondent' => $raspuns['respondent'],	
					'id_petitie' => $raspuns['id_petitie_cloud']
				);			
				$raspunsuri[] = $result;
			}
			$i++;
		}		
		return $raspunsuri;
	}
	public function sterge_petitie_voturi($id_petitie){ //v
		$this->db->where('id_cloud', $id_petitie);
		$this->db->delete($this->petitii_voturi);
	}
	public function send_mesaj_raspunde($id_user2, $id_petitie, $mesaj, $titlu){//v		
		$this->db->where('ID_PETITIE', $id_petitie);		
		$query = $this->db->get($this->voturi);
		foreach($query->result() as $row){
			$id_user = $this->petition_model->get_user_by_name($row->NUME, $row->PRENUME, $row->EMAIL);
			if($id_user != $id_user2){
				$this->insert_mesaj($id_user, $mesaj, $titlu);
			}
		}
	}
	public function insert_mesaj($id_user, $mesaj, $titlu, $admin = ''){	//v
		$data = array(
			'id_user' => $id_user,
			'mesaj' => $mesaj,
			'data' => date('Y-m-d H:i:s'),
			'titlu_petitie' => $titlu,
			'nume_admin' => $admin
		);
		$this->db->insert($this->mesaje, $data);
	}
	public function get_mesaje_admin(){		
		$this->db->group_by('mesaj');
		$this->db->where('nume_admin != ', '');
		return $this->db->get($this->mesaje);			
	}
	public function get_mesaje($id_user){ //v
		$this->db->where('id_user', $id_user);
		$query = $this->db->get($this->mesaje);
		$mesaje = array();
		foreach($query->result() as $row){
			$mesaj = array(
				'id' => $row->id,
				'mesaj' => $row->mesaj, 
				'data' => $row->data,
				'titlu' => $row->titlu_petitie,
				'vazuta' => $row->vazut
			);
			$mesaje[] = $mesaj;
		}
		return $mesaje;
	}	
	public function get_mesaj($id){ //v\
		$update = array(
			'vazut' => 1
		);
		$this->db->where('id', $id);
		$this->db->update($this->mesaje, $update);
		$this->db->where('id', $id);
		$query = $this->db->get($this->mesaje);
		$mesaje = array();
		foreach($query->result() as $row){
			$mesaj = array(
				'id' => $row->id,
				'mesaj' => $row->mesaj, 
				'data' => $row->data,
				'titlu' => $row->titlu_petitie,
				'vazuta' => $row->vazut
			);
			return $mesaj;
		}		
	}
	public function mesaje_nevazute($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->where('vazut', 0);
		$query = $this->db->get($this->mesaje);
		return $query->num_rows();
	}
	public function get_user_by_id_petitie($id_petitie){ //v
		$data = array(
			'id' => $id_petitie
		);	
		$this->db->where($data);
		$query = $this->db->get($this->petitii);
		$row = $query->row();
		return $row->iduser;
	}
	public function send_mesaj_semnaturi($id_user2, $mesaj, $id_petitie, $titlu){ //v
		$data = array(
			'ID_PETITIE' => $id_petitie
		);
		$this->db->where($data);
		$query = $this->db->get($this->voturi);
		foreach($query->result() as $row){
			$id_user = $this->petition_model->get_user_by_name($row->NUME, $row->PRENUME, $row->EMAIL);
			if($id_user != $id_user2){
				$this->insert_mesaj($id_user, $mesaj, $titlu);
			}
		}
	}
	public function get_user_by_id_petitie_cloud($id_petitie){ //v
		$data = array(
			'id_cloud' => $id_petitie
		);	
		$this->db->where($data);
		$query = $this->db->get($this->petitii);
		$row = $query->row();
		return $row->iduser;
	}
	public function insert_all_mesaj($mesaj, $titlu, $admin = ''){ //v
		$this->db->select('ID');
		$query = $this->db->get($this->conturi);
		foreach($query->result() as $row){
			$this->insert_mesaj($row->ID, $mesaj, $titlu, $admin);
		}
	}
	public function multiexplode ($delimiters,$string) { 
		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return  $launch;
	}	
	private function GetNoSpaces($s){
		$s = str_replace(' ','',$s);
		return $s;
	}
	public function ListResponseSearch($search){
		$searches = $this->multiexplode(array(' ', ',', ';', '!', '?', ':', (string)34, (string)39, ']', '[', (string)92, '`', '@', '#', '$', '%', '^', '&', '*',
		'(', ')', '_', '-', '+', '=', '|', '/', '<', '>', '{', '}', '.'), $search);			
		$query = $this->db->get($this->raspunsuri);					
		$i = 0;					
		foreach($query->result_array() as $raspuns){		
			
			$titlu = strtolower($raspuns['titlu']);			
			$raspuns1 = strtolower($raspuns['raspuns']);
			$respondent = strtolower($raspuns['respondent']);				
			foreach($searches as $searchedText){				
				$searchedText = $this->GetNoSpaces($searchedText);				
				$searchedText = strtolower($searchedText);				
				if($searchedText == ''){
					continue;
				}else if(strpos($respondent,$searchedText) !== false 				
				|| strpos($titlu, $searchedText) !== false
				|| strpos($raspuns1, $searchedText) !== false
				){				
					$i++;	
					break;
				}else if($respondent == $searchedText){					
					$i++;	
					break;
				}				
			}       
		}
		return $i;		
	}
	public function Search_Raspunsuri($per_page, $number1, $total, $search){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;			
		
		$searches = $this->multiexplode(array(' ', ',', ';', '!', '?', ':', (string)34, (string)39, ']', '[', (string)92, '`', '@', '#', '$', '%', '^', '&', '*',
		'(', ')', '_', '-', '+', '=', '|', '/', '<', '>', '{', '}', '.'), $search);
				
		$raspunsuri = array();
		$i = 0; $j = 0;
        $query = $this->db->get($this->raspunsuri);							
		foreach($query->result_array() as $raspuns){
		
			$titlu = strtolower($raspuns['titlu']);			
			$raspuns1 = strtolower($raspuns['raspuns']);
			$respondent = strtolower($raspuns['respondent']);
			
			$ok = 0;			
			foreach($searches as $searchedText){
				$searchedText = $this->GetNoSpaces($searchedText);				
				$searchedText = strtolower($searchedText);													
				if($searchedText == ''){					
					continue;
				}else if(strpos($respondent,$searchedText) !== false 				
				|| strpos($titlu, $searchedText) !== false
				|| strpos($raspuns1, $searchedText) !== false
				){		
					$ok = 1;
					break;					 								
				}
				if($respondent == $searchedText){
					$ok = 1;
					break;					 								
				}
			}			
			if($ok == 1){					
				if($i >= $limit_start && $i < $limit_end){
						$result = array(
							'titlu' => $raspuns['titlu'],
							'raspuns' => $raspuns['raspuns'],
							'respondent' => $raspuns['respondent'],							
							'id_petitie' => $raspuns['id_petitie_cloud'],
							'data' => $raspuns['data']
						);
						$raspunsuri[] = $result;
				}		
				$i++;
			}			
		}
		return $raspunsuri;		
	}
	public function get_skip_result_limits($per_page, $number1, $total){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$this->db->limit($number2);
		$j = 0; $i = 0;
		$query = $this->db->get($this->raspunsuri);		
		$raspunsuri = array();
		foreach($query->result_array() as $res){	
			if($i >= $limit_start && $i < $limit_end){
				$result = array(
					'titlu' => $res['titlu'],
					'raspuns' => $res['raspuns'],
					'respondent' => $res['respondent'],                
					'id_petitie' => $res['id_petitie_cloud']
				);
				$raspunsuri[$j++] = $result; 			
			}
			$i++;
		}
        return $raspunsuri;		
	}
	public function sterge_conturi_7zile(){
		$date = date('Y-m-d H:i:s');
		$date = date('Y-m-d H:i:s', strtotime($date.' - 7 days'));
		$this->db->where('DATA < ', $date);
		$this->db->where('ACTIV', 0);
		$this->db->delete($this->conturi);
	}
	public function get_categorie_nice($categorie){
		$this->db->where('CATEGORIE_N', $categorie);
		$query = $this->db->get($this->categorii);
		$row = $query->row();
		return $row->CATEGORIE_M;
	}
	public function get_last_ip($id){			
		$this->db->where('id_user', $id);
		$this->db->limit(1);
		$this->db->order_by('data', 'desc');
		$query = $this->db->get($this->istoric_ip);
		if($query->num_rows()){
			$row = $query->row();
			return $row->IP;
		}else{
			return 'NO IP'; 
		}
		
	}
}
?>