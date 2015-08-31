<div id="content-wrapper" class="drop-shadow">
    <div id="content">
		<?php
		echo '<h2 style="display:inline-table;">'.$user->NUME.' '.$user->PRENUME; 
		if($user->ACTIV == 0){
			echo ' (Nevalidat)';
		}else if($user->DATASUSPENDARE < $data){
			echo ' (Activ)';
		}else{
			echo ' (Suspendat)';
		}
		echo ' | </h2>';
		echo '<a class="btn btn-warning" href="'.base_url().'panou_admin/suspendare_user/'.$user->ID.'">Suspendare</a> ';
		echo '<a class="btn btn-danger" href="'.base_url().'panou_admin/stergere_user/'.$user->ID.'">Stergere</a> ';		
		echo '<BR>';
		echo '<ul class="nav nav-tabs" id="nav_profil">
		<li class="active"><a href="#date" data-toggle="tab">Date utilizator</a></li>
        <li><a href="#semnaturi" data-toggle="tab">Semnături</a></li>
        <li><a href="#initiate" data-toggle="tab">Petiții inițiate</a></li>
        <li><a href="#aprobate" data-toggle="tab">Petiții aprobate</a></li>
        <li><a href="#istoric" data-toggle="tab">Istoric IP-uri</a></li>
    </ul>';
		echo '<div class="tab-content"><div class="tab-pane active" id="date">';
		$erori = 0;
					$ec = form_error('nume'); if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('prenume');  if ($ec != ""){$erori=1; echo $ec;}					
					$ec = form_error('varsta');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('email');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('telefon');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('adresa');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('localitate');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('ocupatie');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('judet');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('mediu');  if ($ec != ""){$erori=1; echo $ec;}
					$ec = form_error('sex');  if ($ec != ""){$erori=1; echo $ec;}
	?>
	<form  method="post" action="<?php echo base_url()?>panou_admin/editare_user/<?php echo $user->ID?>">
        <table style="background-color: white;">
            <tr>
            <td><label for="inputNume" class="control-label" style="padding-right:5px;">Nume</label></td>
            <td><input type="text" data-placement="right" title="Nume" id="inputNume" value="<?php echo $user->NUME;?>" name="nume" disabled></td>
            </tr>

            <tr>
            <td><label for="inputPrenume" class="control-label" style="padding-right:5px;">Prenume</label>
            <td><input type="text" data-placement="right" title="Prenume" id="inputPrenume" value="<?php echo $user->PRENUME;?>" name="prenume" disabled></td>
            </tr>

            <tr>
            <td><label for="inputEmail" class="control-label" style="padding-right:5px;">Email</label></td>
            <td><input type="email" data-placement="right" title="Email" id="inputEmail" value="<?php echo $user->EMAIL;?>" name="email" disabled></td>
            </tr>
			<tr>
			<div class="controls input-append date" data-date-format="dd-mm-yyyy">
						<td><label style="padding-right:5px;" class="control-label" for="inputAge">Data nasterii</label></td>
						<td><input type="text" name="varsta" value="<?php echo $user->DATA_N?>" id="inputAge" data-placement="right" readonly="readonly"></td>
			    	</div>
			</tr>		
            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputTelefon">Telefon</label></td>
            <td><input type="text" name="telefon" value="<?php echo $user->TELEFON;?>" id="inputTelefon" title="Numar de telefon" data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputAddress">Adresa</label></td>
            <td><textarea type="text" name="adresa" rows="3" id="inputAddress" title="Adresa" data-placement="right"><?php echo $user->ADRESA;?></textarea></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputCity">Localitate</label></td>
            <td><input type="text" name="localitate" value="<?php echo $user->LOCALITATE;?>" id="inputCity" title="Introduce?i localitatea în care locui?i." data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputOccupation">Ocupatie</label></td>
            <td><input type="text" name="ocupatie" value="<?php echo $user->OCUPATIE;?>" id="inputOccupation" title="Introduce?i ocupa?ia dvs. curenta." data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputJudet">Judet</label></td>
            <td><select name="judet" id="inputJudet">
                <option value="Alba" <?php if($user->JUDET == 'Alba') {echo 'selected="selected"';}?>>Alba</option>
                <option value="Arad" <?php if($user->JUDET == 'Arad') {echo 'selected="selected"';}?>>Arad</option>
                <option value="Argeș" <?php if($user->JUDET == 'Argeș') {echo 'selected="selected"';}?>>Argeș</option>
                <option value="Bacau" <?php if($user->JUDET == 'Bacau') {echo 'selected="selected"';}?>>Bacau</option>
                <option value="Bihor" <?php if($user->JUDET == 'Bihor') {echo 'selected="selected"';}?>>Bihor</option>
                <option value="Bistrița-Nasaud"  <?php if($user->JUDET == 'Bistrița-Nasaud') {echo 'selected="selected"';}?>>Bistrița-Nasaud</option>
                <option value="Botoșani" <?php if($user->JUDET == 'Botoșani') {echo 'selected="selected"';}?>>Botoșani</option>
                <option value="Braila" <?php if($user->JUDET == 'Braila') {echo 'selected="selected"';}?>>Braila</option>
                <option value="Brașov" <?php if($user->JUDET == 'Brașov') {echo 'selected="selected"';}?>>Brașov</option>
                <option value="București" <?php if($user->JUDET == 'București') {echo 'selected="selected"';}?>>București</option>
                <option value="Buzau" <?php if($user->JUDET == 'Buzau') {echo 'selected="selected"';}?>>Buzau</option>
                <option value="Calarași"  <?php if($user->JUDET == 'Calarași') {echo 'selected="selected"';}?>>Calarași</option>
                <option value="Caraș-Severin"  <?php if($user->JUDET == 'Caraș-Severin') {echo 'selected="selected"';}?>>Caraș-Severin</option>
                <option value="Cluj" <?php if($user->JUDET == 'Cluj') {echo 'selected="selected"';}?>>Cluj</option>
                <option value="Constanța" <?php if($user->JUDET == 'Constanța') {echo 'selected="selected"';}?>>Constanța</option>
                <option value="Covasna"  <?php if($user->JUDET == 'Covasna') {echo 'selected="selected"';}?>>Covasna</option>
                <option value="Dâmbovița"  <?php if($user->JUDET == 'Dâmbovița') {echo 'selected="selected"';}?>>Dâmbovița</option>
                <option value="Dolj" <?php if($user->JUDET == 'Dolj') {echo 'selected="selected"';}?>>Dolj</option>
                <option value="Galați" <?php if($user->JUDET == 'Galați') {echo 'selected="selected"';}?>>Galați</option>
                <option value="Giurgiu" <?php if($user->JUDET == 'Giurgiu') {echo 'selected="selected"';}?>>Giurgiu</option>
                <option value="Gorj"  <?php if($user->JUDET == 'Gorj') {echo 'selected="selected"';}?>>Gorj</option>
                <option value="Harghita"  <?php if($user->JUDET == 'Harghita') {echo 'selected="selected"';}?>>Harghita</option>
                <option value="Hunedoara" <?php if($user->JUDET == 'Hunedoara') {echo 'selected="selected"';}?>>Hunedoara</option>
                <option value="Ialomița" <?php if($user->JUDET == 'Ialomița') {echo 'selected="selected"';}?>>Ialomița</option>
                <option value="Iași" <?php if($user->JUDET == 'Iași') {echo 'selected="selected"';}?>>Iași</option>
                <option value="Ilfov" <?php if($user->JUDET == 'Ilfov') {echo 'selected="selected"';}?>>Ilfov</option>
                <option value="Maramureș"  <?php if($user->JUDET == 'Maramureș') {echo 'selected="selected"';}?>>Maramureș</option>
                <option value="Mehedinți"  <?php if($user->JUDET == 'Mehedinți') {echo 'selected="selected"';}?>>Mehedinți</option>
                <option value="Mureș"  <?php if($user->JUDET == 'Mureș') {echo 'selected="selected"';}?>>Mureș</option>
                <option value="Neamț"  <?php if($user->JUDET == 'Neamț') {echo 'selected="selected"';}?>>Neamț</option>
                <option value="Olt"  <?php if($user->JUDET == 'Olt') {echo 'selected="selected"';}?>>Olt</option>
                <option value="Satu-Mare"  <?php if($user->JUDET == 'Satu-Mare') {echo 'selected="selected"';}?>>Satu-Mare</option>
                <option value="Sibiu" <?php if($user->JUDET == 'Sibiu') {echo 'selected="selected"';}?>>Sibiu</option>
                <option value="Suceava" <?php if($user->JUDET == 'Suceava') {echo 'selected="selected"';}?>>Suceava</option>
                <option value="Teleorman"  <?php if($user->JUDET == 'Teleorman') {echo 'selected="selected"';}?>>Teleorman</option>
                <option value="Timiș" <?php if($user->JUDET == 'Timiș') {echo 'selected="selected"';}?>>Timiș</option>
                <option value="Tulcea"  <?php if($user->JUDET == 'Tulcea') {echo 'selected="selected"';}?>>Tulcea</option>
                <option value="Vâlcea" <?php if($user->JUDET == 'Vâlcea') {echo 'selected="selected"';}?>>Vâlcea</option>
                <option value="Vaslui"  <?php if($user->JUDET == 'Vaslui') {echo 'selected="selected"';}?>>Vaslui</option>
                <option value="Vrancea"  <?php if($user->JUDET == 'Vrancea') {echo 'selected="selected"';}?>>Vrancea</option>
            </select></td>
            </tr>
            
            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputMediu">Mediu</label></td>
            <td><select name="mediu" id="inputMediu">
                <option value="RURAL" <?php if($user->MEDIU == "RURAL"){echo 'selected="selected"';}?>>Rural</option>
                <option value="URBAN" <?php if($user->MEDIU == "URBAN"){echo 'selected="selected"';}?>>Urban</option>
            </select></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputSex">Sex</label></td>
            <td><select name="sex" id="inputSex">
            <option value="MASCULIN" <?php if($user->SEX == "MASCULIN"){echo 'selected="selected"';}?>>Masculin</option>
                <option value="FEMININ" <?php if($user->SEX == "FEMININ"){echo 'selected="selected"';}?>>Feminin</option>
            </select></td>
            </tr>
			<tr>
			<td>
			<input type="submit" value= "Editeaza"/>
        </table>
	</form>
		</div>
    	<div class="tab-pane" id="semnaturi">
			<h2>Semnături</h2>
			<?php
				echo '<table class="table table-bordered">';
				foreach($petitii_semnate as $petitie){
					echo '<tr><td>'.$petitie['titlu'].'</td><td>'. $petitie['data'].'</td></tr>';
				}
				echo '</table>';
			?>
		</div>
		<div class="tab-pane" id="initiate">
			<h2>Petiții inițiate</h2>
			<?php				
				echo '<table class="table table-bordered">';
				echo '<tr><td>Titlu</td><td>Text petiție</td><td>Stare petiție</td></tr>';
				foreach($petitii_inititiate as $pet){
					echo '<tr>';
						echo '<td>';
						echo $pet->titlu;
						echo '</td><td>';
						echo $pet->textpetitie;			
						echo '</td><td>';
						if($pet->starepetitie == 0){
							echo 'În așteptare ';
							echo '<a class="btn btn-success" href = "'.base_url().'panou_admin/aproba/'.$pet->id.'">Aprobă</a> ';
							echo '<a class="btn btn-danger" href = "'.base_url().'panou_admin/respinge/'.$pet->id.'">Respinge</a> ';				
							echo '<a class="btn btn-danger" href = "'.base_url().'panou_admin/sterge/'.$pet->id.'">Șterge</a>';
						}else if($pet->starepetitie == 1){
							echo 'Respinsă ';
							echo '<a class="btn btn-success" href = "'.base_url().'panou_admin/aproba/'.$pet->id.'">Aprobă</a> ';
							echo '<a class="btn btn-danger" href = "'.base_url().'panou_admin/sterge/'.$pet->id.'">Șterge</a>';
						}
					echo '</td></tr>';
				}
				echo '</table>';
			?>
		</div>
		<div class="tab-pane" id="aprobate">
			<h2>Petiții aprobate</h2>
			<table class="table table-bordered">
				<tr><td>Titlu</td><td>Text petiție</td><td>Nr. semnături</td><td>Stare petiție</td><td>Evolutie vizuala</td></tr>
				<?php	
					$i = 0;	
					foreach($petitii_aprobate as $petitie){
						echo '<tr>';
								echo '<td>';
								echo $petitie['titlu'];
								echo '</td><td>';
								echo $petitie['descriere'];				
								echo '</td><td>';
								echo $petitie['voturi'];
								echo ' <a class="btn btn-primary" href = "'.base_url().'panou_admin/lista_votanti/'.$petitie['id'].'">Lista votanți</a>';
								echo '</td><td>';
								switch($stare[$i]){
									case 1:
										echo 'Activă - fără răspuns <a class="btn btn-primary" href = "'.base_url().'panou_admin/raspunde/'.$petitie['id'].'">Răspunde</a>';
										break;
									case 2:
										echo 'Activă - cu răspuns';
										break;
									case 3:
										echo 'Expirată - fără răspuns <a class="btn btn-primary" href = "'.base_url().'panou_admin/raspunde/'.$petitie['id'].'">Răspunde</a>';
										break;
									case 4:
										echo 'Expirată - cu răspuns';
										break;
								}				
								echo '</td><td>';
								echo 'evolutie vizuala';				
								$i++;
					}
				?>
			</table>
		</div>
		<div class="tab-pane" id="istoric">
			<h2>Istoric IP-uri</h2>
			<?php
				echo '<table class="table table-bordered">';
				foreach($istoric_ipuri as $ip){
					echo '<tr><td>'.$ip['ip'].'</td><td>'.$ip['data'].'</td></tr>';
				}
				echo '</table>';
			?>
		</div>
	</div>
</div>
</div>