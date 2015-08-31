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
	$to_skip = 0;	
	$stop = 5;
	for ($i = $to_skip; $i<count($raspunsuri) && $i<$stop; $i++) {
			echo '<div class="petitionContainerSigned" id="rasp'.$raspunsuri[$i]['id_petitie'].'">
        <div class="petitionContainerSignedText">
            <a href="'.base_url().'raspunsuri/afisare_raspuns/'.$raspunsuri[$i]['id_petitie'].'"><h5>'.$raspunsuri[$i]['titlu'].'</h5></a><br>
            '.myTruncate($raspunsuri[$i]['raspuns'], 100).'
        </div>
        <div class="petitionContainerSignatures">
        	Autor: '.$raspunsuri[$i]['respondent'].' <a class="btn btn-primary" href = "'.base_url().'panou_admin/editare_raspuns/'.$raspunsuri[$i]['id_petitie'].'">Editare</a> | 
        	În răspuns la: <a href="'.base_url().'search/view_petitie/'.$petitie[$i]['id'].'">'.$petitie[$i]['titlu'].'</a>';
        echo '
        </div>
    </div>';
    } 
	?>