<?php	
	for ($i = 0; $i < $to_skip; $i++) {
		if(isset($petitii[$i])){
			echo '<div class="petitionContainerSigned" id="'.$petitii[$i]['id_petitie'].'">
				<div class="petitionContainerSignedText">
					<h5>'.$petitii[$i]['titlu'].'</h5>
					<p>'.$petitii[$i]['textpetitie'].'</p>
					<ul><li>'.$petitii[$i]['categorie1'].'
						<li>'.$petitii[$i]['categorie2'].'
						<li>'.$petitii[$i]['categorie3'].'
					</ul>	
				</div>
			<div class="petitionContainerSignatures">
				<a href="'.base_url().'panou_admin/user/'.$petitii[$i]['iduser'].'">'.$petitii[$i]['user'].'</a>';
				if($petitii[$i]['stare'] == 0){
				echo '
				 |<button class="btn btn-success" id="approve'.$petitii[$i]['id_petitie'].'" onClick="approvePetition('.$petitii[$i]['id_petitie'].')">Aprobă</button> 
				<button class="btn btn-danger" id="reject'.$petitii[$i]['id_petitie'].'" onClick="showRespinge('.$petitii[$i]['id_petitie'].')">Respinge</button>
				<div id = "send_message_respinge'.$petitii[$i]['id_petitie'].'" style="display:none">
					<form>
					<textarea id="message_respinge'.$petitii[$i]['id_petitie'].'">
					</textarea>					
					<button class="btn btn-danger" id="reject2'.$petitii[$i]['id_petitie'].'" onClick="rejectPetition('.$petitii[$i]['id_petitie'].')">Respinge</button>
					</form>
				</div>
				';				
				}else{
				 echo ' |  Petitie respinsa';
				}
				echo '
			</div>
			</div>';
		}
    } 
	?>
