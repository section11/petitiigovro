<div id="content-wrapper" class="drop-shadow">
    <div id="content-alone">
		<div class="control-group">
			<h2>+ Editare răspuns la petiție</h2>
			<fieldset>
				<form action ="<?php echo base_url(); ?>panou_admin/editare_raspuns/<?php echo $id ?>" method = "POST">
					<div class="alert alert-info blueBox">
						<b>Pasul I &ndash; Titlul răspunsului</b>
						<div style="padding-top:10px;">					
							<input type="text" name="titlu" maxlength="105" value="<?php echo $raspuns['titlu']?>" class="field" style="width: 100%;">
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Pasul II &ndash; Autorul răspunsului</b>			
						<div style="padding-top:10px;">	
							<input type="text" name="titular" maxlength="105" value="<?php echo $raspuns['respondent']?>" class="field" style="width: 100%;">
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Pasul III &ndash; Conținutul răspunsului</b>			
						<div style="padding-top:10px;">	
							<textarea class="field" name="raspuns" rows="17" id="inputRaspuns" style="height:200px; width:100%;"><?php echo $raspuns['raspuns']?></textarea>
							<?php echo form_error('raspuns'); ?>
						</div>
					</div>
				</div>
				<div align="center">
					<button type="submit" class="btn btn-large btn-primary" align="center" id="trimite"><i class="icon-ok icon-white"></i> Trimite</button>
				</div>
					<input type="hidden" value="<?php echo $id;?>" name="id_petitie"/>
				</form>
			</fieldset>
    	</div>
    </div>
</div>
