<?php

class semnare_model extends CI_Model {
	
	public function __construct(){
            parent::__construct();  
			$this->load->model('RestServiceClient');
			$this->load->model('login_model');
	}
	
	protected $voturi = 'voturi';
	protected $max = 'maxim';
	protected $petitii_voturi = 'petitii_voturi';
	protected $petitii_aprobate = 'petitii_aprobate';
	
	function exista($email, $id_petitie){
		$data = array(
			'EMAIL' => $email,
			'ID_PETITIE' => $id_petitie,			
		);
		$this->db->where($data);
		$query = $this->db->get($this->voturi);		
		if($query->num_rows() == 0){			
			return 0;
		}else{
			return 1;
		}
	}
	
	function semnare($email, $nume, $prenume, $id_petitie){
		$currentDate = new DateTime();
		if ($this->exista($email, $id_petitie) == 0){
			$data = array(
				'NUME' => $nume,
				'PRENUME' => $prenume,
				'EMAIL' => $email,
				'ID_PETITIE' => $id_petitie,
				'ACTIV' => 1,
				'COD' => '0',
				'DATA' => $currentDate->format('Y-m-d H:i:s')
			);
			$this->db->insert($this->voturi, $data);			
			$this->insert_vote_petitii_aprobate($id_petitie);						
			return 1;
		}else{
			return 0;
		}
	}
	public function insert_vote_petitii_aprobate($id_petitie){
		$this->db->where('id', $id_petitie);
		$query = $this->db->get($this->petitii_aprobate);
		$row = $query->row();
		$nrvoturi = $row->nrvoturi;
		$nrvoturi +=1;
		$data = array(
			'nrvoturi' => $nrvoturi
		);
		$this->db->where('id', $id_petitie);
		$this->db->update($this->petitii_aprobate, $data);
	}
	public function semnare2($id_petitie, $nrvoturi){
		$data = array(
			'voturi' => $nrvoturi
		);
		$this->db->where('id_cloud', $id_petitie);
		$this->db->update($this->petitii_voturi, $data);
	}
	function generateRandomString($length = 15) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	} 		
	function get_id($cod){
		$data = array('COD' => $cod);
		$this->db->where($data);
		$query = $this->db->get($this->voturi);
		$row = $query->row();
		$id = $row->ID_PETITIE;
		return $id;
	}
	
	function maxim($nr_voturi, $id_petitie){
		$data = array('ID_PETITIE' => $id_petitie);
		$this->db->where($data); 
		$query = $this->db->get($this->max);
		if($query->num_rows() == 1 ){	
			$data = array('ID_PETITIE' => $id_petitie);
			$this->db->where($data);
			$data = array('VOTURI' => $nr_voturi);
			$this->db->update($this->max, $data);
			return 0;
		}else{
			$query2 = $this->db->get($this->max);			
			$i = $poz = 0; $petitii = array();
			foreach ($query2->result() as $row){
				$i++;
				$petitii[$i]['voturi'] = $row->VOTURI;
				$petitii[$i]['id'] = $row->ID;		
				$petitii[$i]['id_petitie'] = $row->ID_PETITIE;
			}
			$cate = $i;
			$sortat = 0;
			do{
				$sortat = 1;
				for($j = 1; $j < $i; $j++){
					if($petitii[$j]['voturi'] > $petitii[$j + 1]['voturi']){
						$aux = $petitii[$j]['voturi'];
						$petitii[$j]['voturi'] = $petitii[$j + 1]['voturi'];
						$petitii[$j + 1]['voturi'] = $aux;
						
						$aux = $petitii[$j]['id'];
						$petitii[$j]['id'] = $petitii[$j + 1]['id'];
						$petitii[$j + 1]['id'] = $aux;
						
						$aux = $petitii[$j]['id_petitie'];
						$petitii[$j]['id_petitie'] = $petitii[$j + 1]['id_petitie'];
						$petitii[$j + 1]['id_petitie'] = $aux;
						
						$sortat = 0;
					}
				}
			}while($sortat == 0);
			
			$poz = 0;
			
			for($j = $cate; $j >= 1; $j--){
				if($nr_voturi > $petitii[$j]['voturi']){
					$poz = $j;
					break;
				}
			}				
			if($poz != 0){
				if($poz == 1){
					$data = array('ID' => $petitii[$poz]['id']);
					$this->db->where($data);
					$data2 = array(
						'VOTURI' => $nr_voturi,
						'ID_PETITIE' => $id_petitie
					);
					$this->db->update($this->max, $data2);					
				}else{					
					$aux = $petitii[$poz]['voturi'];
					$auxid = $petitii[$poz]['id'];
					$auxid_pet = $petitii[$poz]['id_petitie'];
					
					$petitii[$poz]['voturi'] = $nr_voturi;
					$petitii[$poz]['id_petitie'] = $id_petitie;
					$petitii[$poz]['id'] = $poz;
					
					for($j = $poz - 1; $j >= 1; $j--){
						$aux2 = $petitii[$j]['voturi'];
						$petitii[$j]['voturi'] = $aux;
						$aux = $aux2;
						
						
						$petitii[$j]['id'] = $j;						
						
						$aux2 = $petitii[$j]['id_petitie'];
						$petitii[$j]['id_petitie'] = $auxid_pet;
						$auxid_pet = $aux2;
					}					
					for($j = $poz + 1; $j <= $cate; $j++){
						$petitii[$j]['id'] = $j;
					}
					for($j = 1; $j <= $i; $j++){					
						$rez = array(
							'VOTURI' => $petitii[$j]['voturi'],							
							'ID_PETITIE' =>$petitii[$j]['id_petitie']
						);
						$data = array('ID'	=>	$petitii[$j]['id']);
						$this->db->where($data);
						$this->db->update($this->max, $rez);												
					}					
				}					
			}
		}
	}
	
	public function exists($nume, $prenume, $email, $id){
		$data3 = array(
			'NUME' => $nume,
			'PRENUME' => $prenume,
			'EMAIL' => $email,
			'ID_PETITIE' => $id
		);
		$this->db->where($data3);
		$query = $this->db->get($this->voturi);
		return $query->num_rows();		
	}
}

?>