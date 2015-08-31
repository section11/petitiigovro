<?php

function myTruncate($string, $limit, $break=".", $pad="...")
{
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
	
	for ($i = 0; $i < $to_skip; $i++) {
		if(isset($petitions[$i])){
			echo '<div class="petitionContainerSigned" id="aprob'.$petitions[$i]['id'].'">
				<div class="petitionContainerSignedText">
					<a href="'.base_url().'search/view_petitie/'.$petitions[$i]['id'].'"><h5>'.$petitions[$i]['titlu'].'</h5></a><br>
					'.myTruncate($petitions[$i]['descriere'], 100).'
				</div>
			<div class="petitionContainerSignatures">
				Semnături: <b style="color: #679a01">'.$petitions[$i]['voturi'].'</b> <a class="btn btn-primary" href = "'.base_url().'panou_admin/lista_votanti/'.$petitions[$i]['id'].'">Lista votanți</a> | 
				Autor: <a href="'.base_url().'panou_admin/user/'.$petitions[$i]['initiator'].'">'.$authors[$i].'</a> | 
				Status: ';
				switch($stare[$i]){
						case 1:
							echo 'Activă - fără răspuns <a class="btn btn-primary" href="'.base_url().'panou_admin/raspunde/'.$petitions[$i]['id'].'">Răspunde</a>';
							break;
						case 2:
							echo 'Activă - cu răspuns ';
							break;
						case 3:
							echo 'Expirată - fără răspuns <a class="btn btn-primary" href="'.base_url().'panou_admin/raspunde/'.$petitions[$i]['id'].'">Răspunde</a>';
							break;
						case 4:
							echo 'Expirată - cu răspuns ';
							break;
					}
			echo '
			</div>
		</div>';
		}
    } 
	?>