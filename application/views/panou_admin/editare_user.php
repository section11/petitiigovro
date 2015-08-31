<?php $erori = 0;
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
						<label style="padding-right:5px;" class="control-label" for="inputAge">Data nasterii</label>
						<input type="text" name="varsta" value="<?php echo $user->DATA_N?>" id="inputAge" data-placement="right" readonly="readonly">
						<span class="add-on"><i class="icon-calendar"></i></span>
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
                <option value="Arge?" <?php if($user->JUDET == 'Arge?') {echo 'selected="selected"';}?>>Arge?</option>
                <option value="Bacau" <?php if($user->JUDET == 'Bacau') {echo 'selected="selected"';}?>>Bacau</option>
                <option value="Bihor" <?php if($user->JUDET == 'Bihor') {echo 'selected="selected"';}?>>Bihor</option>
                <option value="Bistri?a-Nasaud"  <?php if($user->JUDET == 'Bistri?a-Nasaud') {echo 'selected="selected"';}?>>Bistri?a-Nasaud</option>
                <option value="Boto?ani" <?php if($user->JUDET == 'Boto?ani') {echo 'selected="selected"';}?>>Boto?ani</option>
                <option value="Braila" <?php if($user->JUDET == 'Braila') {echo 'selected="selected"';}?>>Braila</option>
                <option value="Bra?ov" <?php if($user->JUDET == 'Bra?ov') {echo 'selected="selected"';}?>>Bra?ov</option>
                <option value="Bucure?ti" <?php if($user->JUDET == 'Bucure?ti') {echo 'selected="selected"';}?>>Bucure?ti</option>
                <option value="Buzau" <?php if($user->JUDET == 'Buzau') {echo 'selected="selected"';}?>>Buzau</option>
                <option value="Calara?i"  <?php if($user->JUDET == 'Calara?i') {echo 'selected="selected"';}?>>Calara?i</option>
                <option value="Cara?-Severin"  <?php if($user->JUDET == 'Cara?-Severin') {echo 'selected="selected"';}?>>Cara?-Severin</option>
                <option value="Cluj" <?php if($user->JUDET == 'Cluj') {echo 'selected="selected"';}?>>Cluj</option>
                <option value="Constan?a" <?php if($user->JUDET == 'Constan?a') {echo 'selected="selected"';}?>>Constan?a</option>
                <option value="Covasna"  <?php if($user->JUDET == 'Covasna') {echo 'selected="selected"';}?>>Covasna</option>
                <option value="Dâmbovi?a"  <?php if($user->JUDET == 'Dâmbovi?a') {echo 'selected="selected"';}?>>Dâmbovi?a</option>
                <option value="Dolj" <?php if($user->JUDET == 'Dolj') {echo 'selected="selected"';}?>>Dolj</option>
                <option value="Gala?i" <?php if($user->JUDET == 'Gala?i') {echo 'selected="selected"';}?>>Gala?i</option>
                <option value="Giurgiu" <?php if($user->JUDET == 'Giurgiu') {echo 'selected="selected"';}?>>Giurgiu</option>
                <option value="Gorj"  <?php if($user->JUDET == 'Gorj') {echo 'selected="selected"';}?>>Gorj</option>
                <option value="Harghita"  <?php if($user->JUDET == 'Harghita') {echo 'selected="selected"';}?>>Harghita</option>
                <option value="Hunedoara" <?php if($user->JUDET == 'Hunedoara') {echo 'selected="selected"';}?>>Hunedoara</option>
                <option value="Ialomi?a" <?php if($user->JUDET == 'Ialomi?a') {echo 'selected="selected"';}?>>Ialomi?a</option>
                <option value="Ia?i" <?php if($user->JUDET == 'Ia?i') {echo 'selected="selected"';}?>>Ia?i</option>
                <option value="Ilfov" <?php if($user->JUDET == 'Ilfov') {echo 'selected="selected"';}?>>Ilfov</option>
                <option value="Maramure?"  <?php if($user->JUDET == 'Maramure?') {echo 'selected="selected"';}?>>Maramure?</option>
                <option value="Mehedin?i"  <?php if($user->JUDET == 'Mehedin?i') {echo 'selected="selected"';}?>>Mehedin?i</option>
                <option value="Mure?"  <?php if($user->JUDET == 'Mure?') {echo 'selected="selected"';}?>>Mure?</option>
                <option value="Neam?"  <?php if($user->JUDET == 'Neam?') {echo 'selected="selected"';}?>>Neam?</option>
                <option value="Olt"  <?php if($user->JUDET == 'Olt') {echo 'selected="selected"';}?>>Olt</option>
                <option value="Satu-Mare"  <?php if($user->JUDET == 'Satu-Mare') {echo 'selected="selected"';}?>>Satu-Mare</option>
                <option value="Sibiu" <?php if($user->JUDET == 'Sibiu') {echo 'selected="selected"';}?>>Sibiu</option>
                <option value="Suceava" <?php if($user->JUDET == 'Suceava') {echo 'selected="selected"';}?>>Suceava</option>
                <option value="Teleorman"  <?php if($user->JUDET == 'Teleorman') {echo 'selected="selected"';}?>>Teleorman</option>
                <option value="Timi?" <?php if($user->JUDET == 'Timi?') {echo 'selected="selected"';}?>>Timi?</option>
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