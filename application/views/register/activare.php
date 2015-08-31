
	<div id="content-wrapper"class="drop-shadow">
		<div id="content">
			<div class="alert alert-block alert-error fade in" id="popup">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4 class="alert-heading" id = "completion-status"></h4>
					<?php $erori = 0;																			
					$ec1 = form_error('varsta'); 
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
					$ec2 = form_error('judet'); 
					if($ec2 != ""){
						if(strpos($ec2, 'Campul')){
							$ec2 = str_replace('Campul', 'Câmpul', $ec2);
						}
						if(strpos($ec2, 'contina')){
							$ec2 = str_replace('contina', 'conțină', $ec2);
						}
						if(strpos($ec1, 'aiba')){
							$ec2 = str_replace('aiba', 'aibă', $ec2);
						}
						if(strpos($ec1, ' sa ')){
							$ec2 = str_replace(' sa ', ' să ', $ec2);
						}
						$erori = 1;
					}
					if($erori == 1){
						echo '<ul style="padding-top:10px;">';
							if($ec1 != ''){
								echo '<li>'. $ec1;
							}													
							if($ec2 != ''){
								echo '<li>'. $ec2;
							}	
						echo '</ul>';
					}
					?>
                    <?php						
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

				<div class="alert alert-info" style="display:block !important;">
					<strong>Eşti aproape gata!</strong> Completează data nașterii şi județul de reședință pentru a putea depune petiții noi și pentru a semna petiții deja deschise.
				</div>
			<form action="<?php echo base_url();?>inregistrare/activare/<?php echo $cod?>" method="post" class="form-horizontal">
		    	
				<fieldset>
						<label style="padding-right:5px;" class="control-label" for="inputAge">Data naşterii</label>
						<input type="text" name="varsta" value="<?php echo set_value('varsta'); ?>" id="inputAge2" data-placement="right" placeholder="Data nașterii">
			    	<script type="text/javascript">
			    		document.getElementById("completion-status").innerHTML = "Activarea a eșuat.";
					    <?php if($erori === 0) {
					            echo "$('.alert').hide();";
					    }
					        else {
					            echo "$('.alert').show();";
					        }
					    ?>
					</script>			     
									    
			        <div style="padding-top:7px;">
						<label style="padding-right:5px;" class="control-label" for="inputJudet">Judeţ</label>
						<select name="judet" id="inputJudet">
							<option value="">--- selectați ---</option>
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
			        </div>			   
					<input name = "cod" value = "<?php echo $cod?>" type="hidden"/>
					<div align="center">
						<button type="submit" class="btn btn-large btn-primary" style="margin-top:20px;" id="trimite">Activează</button>
					</div>
				</fieldset>
			</form>
		</div>

