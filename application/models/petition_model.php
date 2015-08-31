<?php

class petition_model extends CI_Model {
	
	protected $petitii = 'petitii';
	protected $conturi = 'conturi';
	protected $voturi = 'voturi';
	protected $petitii_voturi = 'petitii_voturi';
	protected $categorii = 'categorii';
	protected $petitii_aprobate = 'petitii_aprobate';
	
	public function __construct(){	
        parent::__construct();  
        $this->load->model('RestServiceClient');	
        $this->load->model('PetitiiRaspuns');	
		$this->load->model('semnare_model');
	}
	
	public function exist($id_petitie){
	
		$data = array(
			'id' => $id_petitie
		);
		$this->db->where($data);
		$query = $this->db->get($this->petitii);
		return $query->num_rows();		
		
	}
	
	public function insert($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id, $salvare, $id_petitie){
		
		$data = array(
			'iduser' => $id,
			'titlu' => $titlu,
			'categorie1' => $categorie1,
			'categorie2' => $categorie2,
			'categorie3' => $categorie3,
			'textpetitie' => $petitie,
			'data' => date('Y-m-d H:i:s'),
			'salvare' => $salvare,
			'starepetitie' => 0
		);	
		
		if($this->exist($id_petitie) == 0){
		
			$this->db->insert($this->petitii, $data);
			
		}else{
			$data3 = array(
				'id' => $id_petitie
			);
			$this->db->where($data3);
			$this->db->update($this->petitii, $data);
			
		}
	}
	
	public function save($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id, $salvare, $id_petitie){
	
		$data = array(			
			'iduser' => $id,
			'titlu' => $titlu,
			'categorie1' => $categorie1,
			'categorie2' => $categorie2,
			'categorie3' => $categorie3,
			'textpetitie' => $petitie,
			'data' => date('Y-m-d H:i:s'),
			'salvare' => $salvare,
			'starepetitie' => 0
		);
		
		if((int)$id_petitie != 0){						
			$data2 = array(
				'id' => $id_petitie
			);
			$this->db->where($data2);
			$query3 = $this->db->get($this->petitii);
			foreach ($query3->result() as $row) {									
				if($row->salvare == 1 && $row->starepetitie == 0){			
					$this->db->where('id', $id_petitie);
					$this->db->update($this->petitii, $data);
					return $id_petitie;				
				}else if($row->starepetitie != 0){
					return 'eroare';
				}
				break;
			}
			return $id_petitie;				
		}else{			
			$this->db->insert($this->petitii, $data);
			$this->db->where($data);
			$query = $this->db->get($this->petitii);		
			foreach($query->result() as $row){
				$row = $query->row();
				return $row->id;			
			}	
		}
	}
	
	public function delete($id_petitie, $id){
		if($this->exist($id_petitie) != 0){
			$data = array(
				'id' => $id_petitie,
				'iduser' => $id
			);
			$this->db->where($data);
			$query = $this->db->get($this->petitii);
			$row = $query->row();
			if($row->salvare < 2 && $row->starepetitie == 0){
				$this->db->where($data);
				$this->db->delete($this->petitii);
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	public function record_count(){
		$this->db->where('salvare', 0);
		$this->db->where('starepetitie', 0);
		return $this->db->get($this->petitii)->num_rows();
	}
	public function record_count_respinse(){
		$this->db->where('salvare', 0);
		$this->db->where('starepetitie', 1);
		return $this->db->get($this->petitii)->num_rows();
	}
	
	/*	starepetitie
	
		0 - in asteptare
		1 - respinsa
		2 - aprobata
		
		salvare
		0 - trimisa (nu pot efectua modificari)
		1 - salvata (pot efectua modificari)
		2 - aprobata (nu listez in cele normale) 
	*/
	
	public function get_no_activated($per_page, $number1, $total){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$data = array(
			'salvare' => 0,
			'starepetitie !=' => 2
		);
		$this->db->where($data);
		$this->db->order_by("id", "desc"); 		
		$query = $this->db->get($this->petitii);
		$j = 0;
		if ($query->num_rows() > 0) {
			$data = array();
            foreach ($query->result() as $row) {
				if($j >= $limit_start && $j < $limit_end){
					$result = array(
						'user' => $this->get_user($row->iduser),
						'iduser' => $row->iduser,
						'id_petitie' => $row->id,
						'titlu' => $row->titlu,
						'categorie1' => $row->categorie1,
						'cateogire2' => $row->categorie2,
						'categorie3' => $row->categorie3,
						'textpetitie' => $row->textpetitie,
						'stare' => $row->starepetitie,
						'data' => $row->data,				
					);
					$data[] = $result;
				}else if($j > $limit_end){
					break;
				}
				$j++;
				
            }
            return $data;
        }
        return false;
	}

	public function get_all_no_activated($per_page, $number1, $total){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$data = array(
			'salvare' => 0,
			'starepetitie' => 0
		);
		$this->db->where($data);
		$this->db->order_by("id", "desc"); 		
		$this->db->limit($limit_end);
		$query = $this->db->get($this->petitii);
		$i = 0;
		if ($query->num_rows() > 0) {
			$data = array();
            foreach ($query->result() as $row) {
				if($i >= $limit_start && $i < $limit_end){
					if(isset($row->categorie2)){
						$categorie2 = $row->categorie2;
					}else{
						$categorie2 = '';
					}
					
					if(isset($row->categorie3)){
						$categorie3 = $row->categorie3;
					}else{
						$categorie3 = '';
					}
					$result = array(
						'user' => $this->get_user($row->iduser),
						'iduser' => $row->iduser,
						'id_petitie' => $row->id,
						'titlu' => $row->titlu,
						'categorie1' => $this->get_categorie_by_nume($row->categorie1),
						'categorie2' => $this->get_categorie_by_nume($categorie2),
						'categorie3' => $this->get_categorie_by_nume($categorie3),
						'textpetitie' => $row->textpetitie,
						'stare' => $row->starepetitie,
						'data' => $row->data,				
					);
					$data[] = $result;
				}
				$i++;
			}
            return $data;
        }
        return false;
	}
	public function get_all_respinse($per_page, $number1, $total){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$data = array(
			'salvare' => 0,
			'starepetitie' => 1
		);
		$this->db->where($data);
		$this->db->order_by("id", "desc"); 		
		$this->db->limit($limit_end);
		$query = $this->db->get($this->petitii);
		$i = 0;
		if ($query->num_rows() > 0) {
			$data = array();
            foreach ($query->result() as $row) {
				if($i >= $limit_start && $i < $limit_end){
					if(isset($row->categorie2)){
						$categorie2 = $row->categorie2;
					}else{
						$categorie2 = '';
					}
					
					if(isset($row->categorie3)){
						$categorie3 = $row->categorie3;
					}else{
						$categorie3 = '';
					}
					$result = array(
						'user' => $this->get_user($row->iduser),
						'iduser' => $row->iduser,
						'id_petitie' => $row->id,
						'titlu' => $row->titlu,
						'categorie1' => $this->get_categorie_by_nume($row->categorie1),
						'categorie2' => $this->get_categorie_by_nume($categorie2),
						'categorie3' => $this->get_categorie_by_nume($categorie3),
						'textpetitie' => $row->textpetitie,
						'stare' => $row->starepetitie,
						'data' => $row->data,				
					);
					$data[] = $result;
				}
				$i++;
			}
            return $data;
        }
        return false;
	}
	
	public function get_categorie_by_nume($cat){
		if($cat != ''){
			$this->db->where('CATEGORIE_N', $cat);
			$query = $this->db->get($this->categorii);
			$row = $query->row();
			return $row->CATEGORIE_M;
		}else{
			return '';
		}
	}
	
	public function get_user($id_user){
		$data = array(
			'ID' => $id_user
		);
		$this->db->where($data);
		$query = $this->db->get($this->conturi);
		$nume = '';
		if($query->num_rows() != 0){
			$row = $query->row();
			$nume = $row->NUME .' '. $row->PRENUME;
		}
		return $nume;
	}	
	
	public function reject($id_petitie){		
		$data = array(
			'id' => $id_petitie
		);		
		$this->db->where($data);					
		$data2 = array(
			'starepetitie' => '1',
			'salvare' => '0'
		);
		$this->db->update($this->petitii, $data2);
	}
	
	public function aprove($id_petitie){		
		$data4 = array(
			'id' => $id_petitie,
			'starepetitie !=' => 2
		);
		$this->db->where($data4);
		$query = $this->db->get($this->petitii);		
		if($query->num_rows() != 0){
			$row = $query->row();
			$titlu = $row->titlu; $petitie = $row->textpetitie;
			$categorie1 = $row->categorie1; $categorie2 = $row->categorie2; $categorie3 = $row->categorie3;
			$id_user = $row->iduser; 		
			$id_petitie2 = $this->Insert_petitie_aprobata($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id_user);				
			$data3 = array(
				'ID' => $id_user
			);			
			$this->db->where($data3);
			$query2 = $this->db->get($this->conturi);
			$row2 = $query2->row();
			$nume = $row2->NUME;
			$prenume = $row2->PRENUME;
			$email = $row2->EMAIL;
			$this->semnare_model->semnare($email, $nume, $prenume, $id_petitie2);
			$data = array(
				'id' => $id_petitie,
				'starepetitie !=' => 2
			);
			$this->db->where($data);					
			$data2 = array(
				'starepetitie' => '2',
				'salvare' => '2',
				'id_cloud' => $id_petitie2
			);
			$this->db->update($this->petitii, $data2);
			
			$data4 = array(
				'id_cloud' => $id_petitie2,
				'voturi' => 1
			);
			$this->db->insert($this->petitii_voturi, $data4);
			return 1;
		}else{
			return 0;
		}		
	}	
	public function Insert_petitie_aprobata($titlu, $petitie, $categorie1, $categorie2, $categorie3, $id_user){
		$data = array(
			'iduser' => $id_user,
			'titlu' => $titlu,			
			'categorie1' => $categorie1,
			'categorie2' => $categorie2,
			'categorie3' => $categorie3,
			'textpetitie' => $petitie,
			'nrvoturi' => 0,			
			'semnaturitinta' => 10000,
			'data' => date('Y-m-d H:i:s'),
			'datatinta' => Date('Y-m-d H:i:s', strtotime("+30 days"))			
		);
		$this->db->insert($this->petitii_aprobate, $data);
		$this->db->where($data);
		$query = $this->db->get($this->petitii_aprobate);
		$row = $query->row();
		return $row->id;
	}
	public function get_petitii_admin_aprobate_total(){
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	public function get_petitii_admin_cu_raspuns_total(){
		$this->db->where('raspuns', 1);
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	public function get_petitii_admin_fara_raspuns_total(){
		$this->db->where('raspuns', 0);
		$this->db->where('nrvoturi >= ', 10000);
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	public function get_petitii_admin_expirate_total(){
		$this->db->where('raspuns', 0);
		$this->db->where('nrvoturi <', 10000);
		$this->db->where('datatinta < ', date('Y-m-d H:i:s'));	
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	public function get_petitii_admin_active_total(){
		$this->db->where('raspuns', 0);
		$this->db->where('nrvoturi <', 10000);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));	
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	public function get_petitii_aprobate_total(){	
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));	
		$this->db->or_where('nrvoturi >= ', 10000);
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}	
	public function get_all_result_limits($per_page, $number1, $total, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));	
		$this->db->or_where('nrvoturi >= ', 10000);
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($limit_end);		
		$query = $this->db->get($this->petitii_aprobate);
		
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}				
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
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	public function get_all_cu_raspuns_limits($per_page, $number1, $total, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('raspuns', 1);		
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($limit_end);		
		$query = $this->db->get($this->petitii_aprobate);
		
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}				
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
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	public function get_all_fara_raspuns_limits($per_page, $number1, $total, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('raspuns', 0);		
		$this->db->where('nrvoturi >= ', 10000);
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($limit_end);		
		$query = $this->db->get($this->petitii_aprobate);
		
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}				
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
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	public function get_all_active_limits($per_page, $number1, $total, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));	
		$this->db->where('nrvoturi < ', 10000);
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($limit_end);		
		$query = $this->db->get($this->petitii_aprobate);
		
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}				
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
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	public function get_all_expirate_limits($per_page, $number1, $total, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;		
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta < ', date('Y-m-d H:i:s'));	
		$this->db->where('nrvoturi < ', 10000);
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($limit_end);		
		$query = $this->db->get($this->petitii_aprobate);
		
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}				
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
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
	}
	
	public function get_petition_by_category_number($categorie){
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));		
		$this->db->where('categorie1', $categorie);
		$this->db->or_where('categorie2', $categorie);
		$this->db->or_where('categorie3', $categorie);		
		
		$query = $this->db->get($this->petitii_aprobate);
		return $query->num_rows();
	}
	
	public function get_petition_by_category($per_page, $number1, $total, $categorie, $val){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >= ', date('Y-m-d H:i:s'));			
		$this->db->where('categorie1', $categorie);
		$this->db->or_where('categorie2', $categorie);
		$this->db->or_where('categorie3', $categorie);		
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->limit($number2);
		$query = $this->db->get($this->petitii_aprobate);
		$petitii = array(); $j = 0;	$i = 0;
		$date2 = date('Y-m-d H:i:s');
		foreach($query->result_array() as $res){
			if($i >= $limit_start && $i <= $limit_end){
				$diff = strtotime($res['datatinta']) - strtotime($date2);
				if($diff > 0){
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
				}else{					
					$days = '0 zile';
				}
				$result = array(
					'titlu' => $res['titlu'],
					'descriere' => $res['textpetitie'],
					'initiator' => $res['iduser'],
					'data' => $res['data'],
					'voturi' => $res['nrvoturi'],
					'id' => $res['id'],
					'zile' => $days,
					'datatinta' => $res['datatinta'],
					'data_expirarii' => date("d.m.Y", strtotime($res['datatinta'])),
					'author' => $this->general->get_author2($res['iduser'])
				);
				$petitii[$j++] = $result; 
			}
			$i++;
		}
		return $petitii;
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
	
	public function ListPetitionsSearch($search){
		$searches = $this->multiexplode(array(' ', ',', ';', '!', '?', ':', (string)34, (string)39, ']', '[', (string)92, '`', '@', '#', '$', '%', '^', '&', '*',
		'(', ')', '_', '-', '+', '=', '|', '/', '<', '>', '{', '}', '.'), $search);	
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >=', date('Y-m-d H:i:s'));
		$this->db->or_where('nrvoturi >= ', 10000);
		$query = $this->db->get($this->petitii_aprobate);
		$i = 0;					
        foreach($query->result_array() as $petitie){
			$categorie1 = strtolower($petitie['categorie1']);
			if(isset($petitie['categorie2'])){
				$categorie2 = strtolower($petitie['categorie2']);
			}else{
				$categorie2 = '';
			}
			
			if(isset($petitie['categorie3'])){
				$categorie3 = strtolower($petitie['categorie3']);
			}else{
				$categorie3 = '';
			}
			
			$titlu = strtolower($petitie['titlu']);			
			$text = strtolower($petitie['textpetitie']);
											
			foreach($searches as $searchedText){				
				$searchedText = $this->GetNoSpaces($searchedText);				
				$searchedText = strtolower($searchedText);			
				if($searchedText == ''){
					continue;
				}else if(strpos($categorie1,$searchedText) !== false 
				|| strpos($categorie2, $searchedText) !== false 
				|| strpos($categorie3, $searchedText) !== false 
				|| strpos($titlu, $searchedText) !== false
				|| strpos($text, $searchedText) !== false
				){											
					$i++;	
					break;
				}
			}       
		}
		return $i;		
	}
	
	public function Search($per_page, $number1, $total, $search, $val){    
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
		if($val == 1){
			$this->db->order_by('nrvoturi', 'desc');
		}else if($val == 2){
			$this->db->order_by('data');
		}else if($val == 3){
			$this->db->order_by('datatinta', 'desc');
		}
		$this->db->where('raspuns', 0);
		$this->db->where('datatinta >=', date('Y-m-d H:i:s'));
		$this->db->or_where('nrvoturi >= ', 10000);
		$query = $this->db->get($this->petitii_aprobate);
		$petitii = array();
		$i = 0; $j = 0; $date2 = date('Y-m-d H:i:s');
        foreach ($query->result_array() as $petitie){
			$categorie1 = strtolower($petitie['categorie1']);
			if(isset($petitie['categorie2'])){
				$categorie2 = strtolower($petitie['categorie2']);
			}else{
				$categorie2 = '';
			}
			
			if(isset($petitie['categorie3'])){
				$categorie3 = strtolower($petitie['categorie3']);
			}else{
				$categorie3 = '';
			}
			
			$titlu = strtolower($petitie['titlu']);
			$text = strtolower($petitie['textpetitie']);
			
			$ok = 0;								
			
			foreach($searches as $searchedText){
				$searchedText = $this->GetNoSpaces($searchedText);				
				$searchedText = strtolower($searchedText);			
				if($searchedText == ''){
					continue;
				}else if(strpos($categorie1,$searchedText) !== false 
				|| strpos($categorie2, $searchedText) !== false 
				|| strpos($categorie3, $searchedText) !== false 
				|| strpos($titlu, $searchedText) !== false
				|| strpos($text, $searchedText) !== false
				){
					$ok = 1;
					break;							
				}
			}	

			if($ok == 1){			
				if($i >= $limit_start && $i < $limit_end){
					$diff = strtotime($petitie['datatinta']) - strtotime($date2);
					if($diff > 0){
						$years = floor($diff / (365*60*60*24));
						$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
						$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));			
					}else{					
						$days = '0 zile';
					}
					$result = array(
							'titlu' => $petitie['titlu'],
							'descriere' => $petitie['textpetitie'],
							'initiator' => $petitie['iduser'],
							'data' => $petitie['data'],
							'voturi' => $petitie['nrvoturi'],
							'id' => $petitie['id'],
							'zile' => $days,
							'author' => $this->general->get_author2($petitie['iduser'])
						);
						$petitii[] = $result;
				}		
				$i++;
			}			
		}
		return $petitii;		
	}
	
	public function delete_admin($id_petitie){
		$data = array(
			'id' => $id_petitie
		);
		$this->db->where($data);
		$this->db->delete($this->petitii);
	}
	
	public function get_total_voters($id_petitie){
		$data = array(
			'ID_PETITIE' => $id_petitie
		);
		$this->db->where($data);
		$query = $this->db->get($this->voturi);
		return $query->num_rows();
	}
	
	public function get_voters($id_petitie, $per_page, $number1, $total){
		$number2 = $per_page; 
		for($i = 1; $i < $number1; $i++){
			$number2 += $per_page;
		}		
		
		$limit_start = $number2 - $per_page;
		if($number2 > $total){
			$number2 = $total;			
		}
		$limit_end = $number2;
		$data = array(
			'ID_PETITIE' => $id_petitie
		);
		$this->db->where($data);
		$this->db->order_by('DATA', 'desc');
		$query = $this->db->get($this->voturi);
		$data2 = array();
		$j = 0;
		if($query->num_rows() != 0){
			foreach($query->result() as $row){
				if($j >= $limit_start && $j < $limit_end){
					$result = array(
						'nume' => $row->NUME,
						'prenume' => $row->PRENUME,
						'email' => $row->EMAIL,
						'data' => $row->DATA,
						'id_user' => $this->get_user_by_name($row->NUME, $row->PRENUME, $row->EMAIL)
					);
					$data2[] = $result;
				}
				$j++;
			}
		}
		return $data2;
	}
	public function get_user_by_name($nume, $prenume, $email){
		$data = array(
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email			
		);
		$this->db->where($data);
		$query = $this->db->get($this->conturi);
		if($query->num_rows() != 0){
			$row = $query->row();
			return $row->ID;
		}else{
			return 0;
		}
	}
	/*
		activ - fara raspuns 1
			  - cu raspuns 2
		expirata - fara raspuns 3
				 - cu raspuns 4
		solutionate - active cu raspuns 5
					- expirate cu raspuns 6
	*/
	public function get_stare($id_petitie, $datatinta, $nrsemnaturi){
		$raspuns = $this->general->received_answer($id_petitie);
		/*
			raspuns - 1
			fara raspuns - 0
		*/
		$data = Date('Y-m-d H:i:s');	
		if($datatinta > $data && $raspuns == 0){
			return 1;
		}
		if($datatinta > $data && $raspuns == 1){
			return 2;
		}
		if($datatinta < $data && $raspuns == 0){
			return 3;
		}
		if($datatinta < $data && $raspuns == 1){
			return 4;
		}
	}
	
	public function get_signs_of_user($nume, $prenume, $email){
		$data = array(
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email
		);	
		$this->db->where($data);
		$query = $this->db->get($this->voturi);
		$semnaturi = array();		
		foreach($query->result() as $row){						
			$semnatura = array(
				'titlu' => $this->get_title_petition_cloud($row->ID_PETITIE),
				'data' => $row->DATA
			);
			$semnaturi[] = $semnatura;			
		}
		
		return $semnaturi;
	}
	public function get_petition_of_user_in($id_user, $profil = 0){ 
		$this->db->where('iduser', $id_user);		
		if($profil == 1){
			$this->db->where('salvare <=', 1);			
		}else{
			$this->db->where('salvare', 0);
		}
		$this->db->where('starepetitie !=', 2);
		$query = $this->db->get($this->petitii);
		return $query->result();
	}
	public function get_petition_of_user_aproved($id_user){
		$this->db->where('iduser', $id_user);				
		$query = $this->db->get($this->petitii_aprobate);
		$petitii_aprobate = array();
		foreach($query->result() as $row){			
			$petitii_aprobate[] = array(
				'titlu' => $row->titlu,
				'id' => $row->id,				
				'descriere' => $row->textpetitie,
				'datatinta' => $row->datatinta,
				'voturi' => $row->nrvoturi
			);
		}
		return $petitii_aprobate;
	}
	public function can_be_editable($id_petitie, $id_user){
		$this->db->where('id', $id_petitie);
		$query = $this->db->get($this->petitii);	
		$row = $query->row();
		if($row->salvare == 1 && $row->iduser == $id_user){
			return 1;
		}else{
			return 0;
		}
	}
	public function get_petitie($id_petitie){//v
		$this->db->where('id', $id_petitie);
		return $this->db->get($this->petitii);		
	}
	public function get_title_petition_sql($id_petitie){//v
		$this->db->where('id', $id_petitie);
		$query =  $this->db->get($this->petitii);		
		$r = $query->row();
		return $r->titlu;
	}
	public function get_title_petition_cloud($id_petitie){
		$this->db->where('id', $id_petitie);
		$query =  $this->db->get($this->petitii_aprobate);		
		$r = $query->row();		
		return $r->titlu;
	}
	
	public function get_petitie_aprobate($id_petitie){ //v
		$this->db->where('id', $id_petitie);
		$query = $this->db->get($this->petitii_aprobate);
		foreach($query->result_array() as $petitie){
			if(!array_key_exists('categorie2', $petitie)){
				$categorie2 = '';
			}else{
				$categorie2 = ' '. $petitie['categorie2'];
			}
			
			if(!array_key_exists('categorie3', $petitie)){
				$categorie3 = '';
			}else{
				$categorie3 = ' '. $petitie['categorie3'];
			}
			$result = array(
				'id' => $petitie['id'],
				'titlu' => $petitie['titlu'],
				'descriere' => $petitie['textpetitie'],
				'data' => $petitie['data'],
				'voturi' => $petitie['nrvoturi'],
				'initiator' => $petitie['iduser'],
				'categorie' => $petitie['categorie1']. $categorie2. $categorie3,               
                'data_expirarii' => date("d.m.Y", strtotime($petitie['datatinta'])),
				'datatinta' => $petitie['datatinta']
            );
			return $result;
			break;
		}
	}
}
?>