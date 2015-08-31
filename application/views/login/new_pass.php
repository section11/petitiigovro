
	<div id="content-wrapper"class="drop-shadow">
		<div id="content">
			<div class="alert alert-block alert-error fade in" id="popup">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4 class="alert-heading" id = "completion-status"></h4>
					<?php $erori = 0;					
					$ec = form_error('parola');  if ($ec != ""){$erori=1; echo $ec;}										
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
			<form action="<?php echo base_url();?>login/new_pass/<?php echo $cod?>" method="post" class="form-horizontal">
		    	
				<fieldset>							
					<div class="controls">
						<label style="padding-right:5px;" class="control-label" for="inputparola">Parolă nouă</label>
						<input type="parola" name="parola" value="<?php echo set_value('parola'); ?>" id="inputparola" title="Completează noua parolă" data-placement="right">
			    	</div>			    	
			    	<script type="text/javascript">
			    		document.getElementById("completion-status").innerHTML = "Nu ai completat datele necesare.";
					    <?php if($erori === 0) {
					            echo "$('.alert').hide();";
					    }
					        else {
					            echo "$('.alert').show();";
					        }
					    ?>

					    $('.date').datepicker()
					</script>			     
					<input type="hidden" value="<?php echo $cod?>" name="cod"/>
					<div align="center">
						<button type="submit" class="btn btn-large btn-primary controls" id="trimite"><i class="icon-calendar icon-white"></i> Salvează</button>
					</div>
				</fieldset>
			</form>
		</div>

