<?php

class raspundere_model extends CI_Model
{
	public function __construct()
	{
            parent::__construct();  
			$this->load->model('RestServiceClient');
			$this->load->model('login_model');
	}

	function raspunde($id_petitie, $titlu_raspuns, $mesaj_raspuns, $autor_raspuns)
	{
		$this->RestServiceClient->Insert_response($id_petitie, $titlu_raspuns, $mesaj_raspuns, $autor_raspuns);
	}
}

?>