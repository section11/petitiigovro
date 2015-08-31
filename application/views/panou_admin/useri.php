<?php
	foreach($useri as $user){
		echo '<tr id="'.$user->ID.'">';
		echo '<td>';
		echo '<input type="checkbox" name="utilizatori[]" id="utilizatori" value="'.$user->ID.'" />';
		echo '<td>';
		echo $number1++;
		echo '<td>';
		echo $user->NUME;
		echo '<td>';
		echo $user->PRENUME;
		echo '<td>';
		echo '<a href="'.base_url().'panou_admin/user/'.$user->ID.'" target="_blank">'.$user->EMAIL.'</a>';
		echo '<td>';
		echo $this->general->get_last_ip($user->ID);
		echo '<td id="stare'.$user->ID.'">';
		if($user->ACTIV == 0){
			echo 'neactivat';
		}else if($user->DATASUSPENDARE < $data){
			echo 'activat';
		}else{
			echo 'suspendat';
		}
		echo '<td>';
		echo '<a onclick="suspendare('.$user->ID.')"><i title="Suspendare" class="icon-ban-circle"></i></a>';
		echo '<a onclick="unsuspendare('.$user->ID.')"><i title="Eliminare suspendare" class="icon-ok-sign"></i></a>';
		echo '<a onclick="stergere('.$user->ID.')"><i title="Ștergere" class="icon-remove-sign"></i></a>';
		echo '<a href="'.base_url().'panou_admin/user/'.$user->ID.'" target="_blank"><i title="Informații" class="icon-info-sign"></i></a>';
	}
?>