<div id="content-wrapper" class="drop-shadow">
    <div id="content">

    <ul class="nav nav-tabs" id="nav_profil">
        <li class="active"><a href="#date_utilizator" data-toggle="tab">Informații cont</a></li>
        <li><a href="#petitii_asteptare" data-toggle="tab">Petiții în așteptare<sup><?php echo count($petitii_asteptare);?></sup></a></li>
        <li><a href="#petitii_aprobate" data-toggle="tab">Petiții aprobate<sup><?php echo count($petitii_aprobate);?></sup></a></li>
        <li><a href="#petitii_neaprobate" data-toggle="tab">Petiții respinse<sup><?php echo count($petitii_neaprobate);?></sup></a></li>
        <li><a href="#petitii_salvate" data-toggle="tab">Ciorne<sup><?php echo count($petitii_salvate);?></sup></a></li>
    </ul>

    <div class="tab-content">
    <div class="tab-pane active" id="date_utilizator">
    <h2>Informații cont (<span style="color: <?php if($user->ACTIV){echo 'green';} else {echo 'red';}?>"><?php if($user->ACTIV){echo 'activ';} else {echo 'nu este activ';}?></span>)
    </h2>
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
	if($update == 1){
	?>
	<div class="alert alert-block alert-success fade in" id="popup">
		<button data-dismiss="alert" class="close" type="button">×</button>
	<?php
		echo 'Informațiile au fost salvate.';				
	?>
	</div>
	<?php
	}
	?>
    <form  method="post" action="<?php echo base_url()?>profil_utilizator/">
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
            <td><label style="padding-right:5px;" class="control-label" for="inputTelefon">Telefon</label></td>
            <td><input type="text" name="telefon" value="<?php echo $user->TELEFON;?>" id="inputTelefon" title="Număr de telefon" data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputAddress">Adresă</label></td>
            <td><textarea type="text" name="adresa" rows="3" id="inputAddress" title="Adresă" data-placement="right"><?php echo $user->ADRESA;?></textarea></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputCity">Localitate</label></td>
            <td><input type="text" name="localitate" value="<?php echo $user->LOCALITATE;?>" id="inputCity" title="Introduceți localitatea în care locuiți." data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputOccupation">Ocupaţie</label></td>
            <td><input type="text" name="ocupatie" value="<?php echo $user->OCUPATIE;?>" id="inputOccupation" title="Introduceți ocupația dvs. curentă." data-placement="right"></td>
            </tr>

            <tr>
            <td><label style="padding-right:5px;" class="control-label" for="inputJudet">Judeţ</label></td>
            <td><select name="judet" id="inputJudet">
                <option value="Alba" <?php if($user->JUDET == 'Alba') {echo 'selected="selected"';}?>>Alba</option>
                <option value="Arad" <?php if($user->JUDET == 'Arad') {echo 'selected="selected"';}?>>Arad</option>
                <option value="Argeș" <?php if($user->JUDET == 'Argeș') {echo 'selected="selected"';}?>>Argeș</option>
                <option value="Bacău" <?php if($user->JUDET == 'Bacău') {echo 'selected="selected"';}?>>Bacău</option>
                <option value="Bihor" <?php if($user->JUDET == 'Bihor') {echo 'selected="selected"';}?>>Bihor</option>
                <option value="Bistrița-Năsăud"  <?php if($user->JUDET == 'Bistrița-Năsăud') {echo 'selected="selected"';}?>>Bistrița-Năsăud</option>
                <option value="Botoșani" <?php if($user->JUDET == 'Botoșani') {echo 'selected="selected"';}?>>Botoșani</option>
                <option value="Brăila" <?php if($user->JUDET == 'Brăila') {echo 'selected="selected"';}?>>Brăila</option>
                <option value="Brașov" <?php if($user->JUDET == 'Brașov') {echo 'selected="selected"';}?>>Brașov</option>
                <option value="București" <?php if($user->JUDET == 'București') {echo 'selected="selected"';}?>>București</option>
                <option value="Buzău" <?php if($user->JUDET == 'Buzău') {echo 'selected="selected"';}?>>Buzău</option>
                <option value="Călărași"  <?php if($user->JUDET == 'Călărași') {echo 'selected="selected"';}?>>Călărași</option>
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
            <input type="submit" class="btn btn-large btn-primary controls" value= "Salvare"/>
        </table>
	</form>
    </div>
    
    <div class="tab-pane" id="petitii_asteptare">
    <?php
        foreach($petitii_asteptare as $p) {
        ?>
        
        <div class="petitionContainerSigned">
            <div class="petitionContainerSignedText">
                <a href="<?php echo base_url().'petitie_noua/asteptare/'.$p->id;?>"><h5><?php echo $p->titlu; ?></h5></a>
            </div>
        </div>        
    <?php
        }
    ?>
    </div>
    
    <div class="tab-pane" id="petitii_aprobate">
    <?php
    foreach($petitii_aprobate as $p) {
    ?>
    
    <div class="petitionContainerSigned">
        <div class="petitionContainerSignedText">
            <a href="<?php echo base_url().'search/view_petitie/'.$p['id'];?>"><h5><?php echo $p['titlu']; ?></h5></a>
        </div>
    </div>        
    <?php
        }
    ?>
    </div>
    
    <div class="tab-pane" id="petitii_neaprobate">
    <?php
    foreach($petitii_neaprobate as $p) {
    ?>
    
    <div class="petitionContainerSigned">
        <div class="petitionContainerSignedText">
            <h5><?php echo $p->titlu; ?></h5>
        </div>
    </div>        
<?php
        }
    ?>
    </div>
    
    <div class="tab-pane" id="petitii_salvate">
     <?php
    foreach($petitii_salvate as $p) {
    ?>
    
    <div class="petitionContainerSigned">
        <div class="petitionContainerSignedText">
            <a href="<?php echo base_url().'petitie_noua/editare_petitie/'.$p->id;?>"><h5><?php echo $p->titlu; ?></h5></a>
        </div>
    </div>        
<?php
        }
    ?>
    </div>

    </div>


    </div>
