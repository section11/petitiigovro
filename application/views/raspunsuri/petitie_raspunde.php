<div id="content-wrapper" class="drop-shadow">
    <div id="content-alone">
		<div class="control-group">
			<h2>+ Răspuns la petiție</h2>
			<fieldset>
				<form action ="<?php echo base_url(); ?>panou_admin/raspuns" method = "POST">
					<div class="alert alert-info blueBox">
						<b>Pasul I &ndash; Titlul răspunsului</b>
						<div style="padding-top:10px;">					
							<input type="text" name="titlu" maxlength="105" placeholder="Introdu titlul răspunsului..." class="field" style="width: 100%;">
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Pasul II &ndash; Autorul răspunsului</b>			
						<div style="padding-top:10px;">	
							<input type="text" name="titular" maxlength="105" placeholder="Introdu autorul răspunsului..." class="field" style="width: 100%;">
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Pasul III &ndash; Conținutul răspunsului</b>			
						<div style="padding-top:10px;">	
							<textarea class="field" name="raspuns" rows="17" id="inputRaspuns" placeholder="Introduceți textul răspunsului..." style="height:200px; width:100%;"></textarea>
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
