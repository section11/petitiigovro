
	<div id="content-wrapper"class="drop-shadow">
		<div id="content">
			<div class="alert alert-block alert-error fade in" id="popup">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4 class="alert-heading" id = "completion-status" style = "padding-bottom:10px;"></h4>
					<?php $erori = 0;					
					$ec1 = form_error('nume'); 
					if($ec1 != ""){
						if(strpos($ec1, 'Campul')){
							$ec1 = str_replace('Campul', 'Câmpul', $ec1);
						}
						if(strpos($ec1, 'contina')){
							$ec1 = str_replace('contina', 'conțină', $ec1);
						}
						if(strpos($ec1, 'aiba')){
							$ec1 = str_replace('aiba', 'aibă', $ec1);
						}
						if(strpos($ec1, ' sa ')){
							$ec1 = str_replace(' sa ', ' să ', $ec1);
						}
						$erori = 1;
					}
					$ec2 = form_error('prenume');
					if($ec2 != ""){
						if(strpos($ec2, 'Campul')){
							$ec2 = str_replace('Campul', 'Câmpul', $ec2);
						}
						if(strpos($ec2, 'contina')){
							$ec2 = str_replace('contina', 'conțină', $ec2);
						}
						if(strpos($ec2, 'aiba')){
							$ec2 = str_replace('aiba', 'aibă', $ec2);
						}
						if(strpos($ec2, ' sa ')){
							$ec2 = str_replace(' sa ', ' să ', $ec2);
						}
						$erori = 1;
					}
					$ec3 = form_error('parola');  
					if($ec3 != ""){
						if(strpos($ec3, 'Campul')){
							$ec3 = str_replace('Campul', 'Câmpul', $ec3);
						}
						if(strpos($ec3, 'contina')){
							$ec3 = str_replace('contina', 'conțină', $ec3);
						}
						if(strpos($ec3, 'aiba')){
							$ec3 = str_replace('aiba', 'aibă', $ec3);
						}
						if(strpos($ec3, ' sa ')){
							$ec3 = str_replace(' sa ', ' să ', $ec3);
						}
						$erori = 1;
					}					
					$ec4 = form_error('confparola'); 
					if($ec4 != ""){
						if(strpos($ec4, 'Campul')){
							$ec4 = str_replace('Campul', 'Câmpul', $ec4);
						}
						if(strpos($ec4, 'campului')){
							$ec4 = str_replace('campului', 'câmpului', $ec4);
						}
						if(strpos($ec4, 'contina')){
							$ec4 = str_replace('contina', 'conțină', $ec4);
						}
						if(strpos($ec4, 'aiba')){
							$ec4 = str_replace('aiba', 'aibă', $ec4);
						}
						if(strpos($ec4, ' sa ')){
							$ec4 = str_replace(' sa ', ' să ', $ec4);
						}
						$erori = 1;
					}					
					$ec5 = form_error('email'); 
					if($ec5 != ""){
						if(strpos($ec5, 'Campul')){
							$ec5 = str_replace('Campul', 'Câmpul', $ec5);
						}
						if(strpos($ec5, 'contina')){
							$ec5 = str_replace('contina', 'conțină', $ec5);
						}
						if(strpos($ec5, 'aiba')){
							$ec5 = str_replace('aiba', 'aibă', $ec5);
						}
						if(strpos($ec5, ' sa ')){
							$ec5 = str_replace(' sa ', ' să ', $ec5);
						}
						if(strpos($ec5, 'adresa')){
							$ec5 = str_replace('adresa', 'adresă', $ec5);
						}
						if(strpos($ec5, 'valida')){
							$ec5 = str_replace('valida', 'validă', $ec5);
						}
						$erori = 1;
					}					
					$ec6 = form_error('confemail');  
					if($ec6 != ""){
						if(strpos($ec6, 'Campul')){
							$ec6 = str_replace('Campul', 'Câmpul', $ec6);
						}
						if(strpos($ec6, 'campului')){
							$ec6 = str_replace('campului', 'câmpului', $ec6);
						}
						if(strpos($ec6, 'contina')){
							$ec6 = str_replace('contina', 'conțină', $ec6);
						}
						if(strpos($ec6, 'aiba')){
							$ec6 = str_replace('aiba', 'aibă', $ec6);
						}
						if(strpos($ec6, ' sa ')){
							$ec6 = str_replace(' sa ', ' să ', $ec6);
						}
						if(strpos($ec6, 'adresa')){
							$ec6 = str_replace('adresa', 'adresă', $ec6);
						}
						if(strpos($ec6, 'valida')){
							$ec6 = str_replace('valida', 'validă', $ec6);
						}
						$erori = 1;
					}					
					if($erori == 1){
						echo '<ul>';
							if($ec1 != ''){
								echo '<li>'. $ec1;
							}
							if($ec2 != ''){
								echo '<li>'. $ec2;
							}
							if($ec3 != ''){
								echo '<li>'. $ec3;
							}
							if($ec4 != ''){
								echo '<li>'. $ec4;
							}
							if($ec5 != ''){
								echo '<li>'. $ec5;
							}
							if($ec6 != ''){
								echo '<li>'. $ec6;
							}
							
						echo '</ul>';
					}
					?>
                    <?php
						if(isset($exista) && $exista != ""){
                            $erori=1;
							echo $exista. '<br>';
						}
						if(isset($varsta) && $varsta != ""){
                            $erori=1;
							echo $varsta;
						}
					?>
					<script type="text/javascript">
					<?php 
						if($erori === 0) {
							echo "$('.alert').hide();";
						}
						else {
							echo "$('.alert').show();";
						}
					?>
					</script>
				</div>
			<form action="<?php echo base_url();?>inregistrare/index" method="post" class="form-horizontal">
		    	
				<fieldset>
					<h2>Înregistrare</h2>
				<div style="display:block !important;padding-bottom:40px;text-align:justify;">
					Atât pentru a semna o petiție existentă, precum și pentru a depune o petiție nouă, este necesară înregistrarea unui nume de utilizator. Toți vizitatorii cu vârsta de cel puțin 14 ani sunt eligibili în acest sens. Urmează pașii de mai jos pentru a crea un cont nou și pentru a putea utiliza <a style="text-decoration: none;" href="<?php base_url();?>" target="_blank">PETIȚII.GOV.RO</a>.
					<br><br>
					<ol>
						<li>Creează contul: Completează și transmite formularul de mai jos pentru a crea un cont nou.</li>
						<br>
						<li>Validează contul: După transmiterea formularului vei primi prin e-mail un mesaj de validare. </li>
						<br>
						<li>Creează o petiție nouă sau semnează petițiile deja existente: Odată autentificat, poți crea o petiție nouă sau poți contribui la procesul de strângere de semnături pentru inițiative aflate deja în curs. Reține faptul că pentru a sprijini o petiție este necesar  să  apeși pe butonul „Semnează”, prezent în pagina fiecărei petiții.</li>
					</ol>
				</div>

			        <div align="center">
						<label style="width: 55px;display: inline-table;margin-bottom: 0;" for="inputPrenume">Prenume</label>
						<input style="color:black;width: 200px;" placeholder="exemplu: Ionuț" type="text" name="prenume" value="<?php echo set_value('prenume'); ?>" id="inputPrenume" data-placement="right">
						<input style="color:black;width: 200px;" placeholder="exemplu: Popescu" type="text" name="nume" value="<?php echo set_value('nume'); ?>" id="inputNume" data-placement="right">
						<label style="width: 70px;display: inline-table;margin-bottom: 0;" for="inputNume">Nume</label>
			    	</div>

			        <div align="center" style="padding-top:10px;">
						<label style="width: 55px;display: inline-table;margin-bottom: 0;" for="inputPassword">Parolă</label>
						<input style="color:black;width: 200px;" placeholder="Minimum 6 caractere" type="password" name="parola" value="" id="inputPassword" data-placement="right">
						<input style="color:black;width: 200px;" placeholder="Repetă parola anterioară" type="password" name="confparola" value="" id="inputconfPassword" data-placement="right">			    	
						<label style="width: 70px;display: inline-table;margin-bottom: 0;" for="inputconfPassword">Confirmare</label>			    	
			    	</div>
										    
			    	<script type="text/javascript">
			    		document.getElementById("completion-status").innerHTML = "Înregistrarea a eșuat.";
					    <?php if($erori === 0) {
					            echo "$('.alert').hide();";
					    }
					        else {
					            echo "$('.alert').show();";
					        }
					    ?>

					    $('.date').datepicker()
						
						$('#inputNume').keyup(function() {							
							var text = $(this).val().charAt(0).toUpperCase() + $(this).val().substring(1);
							$(this).val(text);
						});
						$('#inputPrenume').keyup(function() {							
							var text = $(this).val().charAt(0).toUpperCase() + $(this).val().substring(1);
							$(this).val(text);
						});
					</script>

			        <div align="center" style="padding-top:10px;">
						<label style="width: 55px;display: inline-table;margin-bottom: 0;" for="inputEmail">Email</label>
						<input style="color:black;width: 200px;" placeholder="exemplu@gov.ro" type="text" name="email" value="<?php echo set_value('email'); ?>" id="inputEmail" data-placement="right">
						<input style="color:black;width: 200px;" placeholder="Repetă adresa anterioară" type="text" name="confemail" value="<?php echo set_value('confemail'); ?>" id="inputconfEmail" data-placement="right">
			    		<label style="width: 70px;display: inline-table;margin-bottom: 0;" for="inputconfEmail">Confirmare</label>
			    	</div>

			    	<div align="center" style="padding-top:10px;">
						<label style="width: 55px;display: inline-table;margin-bottom: 0;" for="inputAge2">Vârsta</label>
						<input type="text" name="varsta" value="<?php echo set_value('varsta'); ?>" id="inputAge2" data-placement="right" placeholder="Selectează data nașterii" style="color:black;width: 200px;">
						<select name="judet" id="inputJudet" style="color:black;width: 214px;">
							<option value="">Județul de reședință</option>
							<option value="Alba">Alba</option>
							<option value="Arad">Arad</option>
							<option value="Argeș">Argeș</option>
							<option value="Bacău">Bacău</option>
							<option value="Bihor">Bihor</option>
							<option value="Bistrița-Năsăud">Bistrița-Năsăud</option>
							<option value="Botoșani">Botoșani</option>
							<option value="Brăila">Brăila</option>
							<option value="Brașov">Brașov</option>
							<option value="București">București</option>
							<option value="Buzău">Buzău</option>
							<option value="Călărași">Călărași</option>
							<option value="Caraș-Severin">Caraș-Severin</option>
							<option value="Cluj">Cluj</option>
							<option value="Constanța">Constanța</option>
							<option value="Covasna">Covasna</option>
							<option value="Dâmbovița">Dâmbovița</option>
							<option value="Dolj">Dolj</option>
							<option value="Galați">Galați</option>
							<option value="Giurgiu">Giurgiu</option>
							<option value="Gorj">Gorj</option>
							<option value="Harghita">Harghita</option>
							<option value="Hunedoara">Hunedoara</option>
							<option value="Ialomița">Ialomița</option>
							<option value="Iași">Iași</option>
							<option value="Ilfov">Ilfov</option>
							<option value="Maramureș">Maramureș</option>
							<option value="Mehedinți">Mehedinți</option>
							<option value="Mureș">Mureș</option>
							<option value="Neamț">Neamț</option>
							<option value="Olt">Olt</option>
							<option value="Satu-Mare">Satu-Mare</option>
							<option value="Sibiu">Sibiu</option>
							<option value="Suceava">Suceava</option>
							<option value="Teleorman">Teleorman</option>
							<option value="Timiș">Timiș</option>
							<option value="Tulcea">Tulcea</option>
							<option value="Vâlcea">Vâlcea</option>
							<option value="Vaslui">Vaslui</option>
							<option value="Vrancea">Vrancea</option>
				  		</select>
						<label style="width: 70px;display: inline-table;margin-bottom: 0;" for="inputconfPassword">Județ</label>			    	
			    	</div>
									    			        
					<div align="center" style="padding-top:20px;">
						<button style="margin-left: -45px;" type="submit" class="btn btn-large btn-primary controls" id="trimite"><i class="icon-ok icon-white"></i> Creare cont</button>
						<button style="margin-left: 0;" type="button" class="btn btn-large btn-primary controls" id="anulare"><i class="icon-remove icon-white"></i> Anulare</button>
					</div>
					<div style="display:block !important;padding-bottom:20px;text-align:justify; padding-top:50px;">
						Toate câmpurile de mai sus trebuie completate în vederea înregistrării unui cont nou.
						În situația în care ești deja înregistrat, te poți <a href="#login-modal" data-toggle="modal">autentifica aici</a>. Dacă ai uitat parola aferentă contului tău, o poți reseta accesând <a href="<?php echo base_url()?>login/recuperare_parola">această legătură</a>. 
						<br><br>
						Reține faptul că fiecare utilizator este îndreptățit  să  dețină un singur cont. Înregistrarea multiplă de către aceeași persoană pentru facilitarea strângerii de semnături nu va fi permisă.
					</div>
				</fieldset>
			</form>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#anulare').click(function(){
						$('#inputPrenume').val('');
						$('#inputNume').val('');
						$('#inputPassword').val('');
						$('#inputconfPassword').val('');
						$('#inputEmail').val('');
						$('#inputconfEmail').val('');
					});
				});
			</script>			
		</div>
