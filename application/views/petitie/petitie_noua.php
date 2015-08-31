<?php
	$ec1 = form_error('titlu'); 
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
	}
	$ec2 = form_error('petitie'); 
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
	}
	$ec3 = form_error('categorii[]'); 
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
	}
	
?>
<div id="content-wrapper" class="drop-shadow">
    <div id="content-alone">
				<div class="control-group">
				<h2>+ Petiție nouă</h2>
				<div class="alert alert-info blueBox">
					Completeză cu atenție formularul de mai jos pentru a transmite o petiție nouă.
					<ul>
						<li>După ce ai compeletat titlul și descrierea petiției tale, alege maximum trei categorii aferente acesteia;</li>
						<li>Odată parcurși pașii anteriori, poți previzualiza petiția, o poți salva pentru completări ulterioare sau o poți trimite spre aprobare;</li>
						<li>Pentru detalii privind condițiile de participare și cele de moderare, citește <a style="color:white; text-decoration:underline;" href="<?php base_url();?>ghid" target="_blank">Ghidul de utilizare</a>.</li>
					</ul>
				</div>
				<fieldset>
				<form action ="<?php echo base_url(); ?>petitie_noua" method = "POST" id="formular">
					<div class="alert alert-info blueBox">
						<b>Pasul I &ndash; Titlul petiției</b> <span style="padding-left: 565px" class="countdownTitle"></span>
						<div style="padding-top:10px;">
							<input type="text" name="titlu" id="titlu" maxlength="100" placeholder="Propunerea mea pentru Guvernul României este..." class="field" style="width: 100%;"
								value = "<?php echo set_value('titlu')?>"
							>
							<?php 
								if($ec1 != ""){
									echo $ec1;
								}
							?>
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Pasul II &ndash; Conținutul petiției</b> <span style="padding-left: 520px" class="countdown"></span>
						<div style="padding-top:10px;">
							<textarea class="field" name="petitie" id="petitie" maxlength="1000" rows="17" id="inputPetitie" placeholder="Introdu textul petiției..." style="height:200px; width:100%;"><?php echo set_value('petitie')?></textarea>
							<?php 
								if($ec2 != ""){
									echo $ec2;
								}
							?>
						</div>
					</div>

					<div class="alert alert-info blueBox" style="overflow: hidden;">
						<b>Pasul III &ndash; Categoriile petiției</b>
						<?php 
							if($ec3 != ""){
								echo $ec3;
							}
						?>
                        <div style="padding-left:100px;padding-top:10px;">
                        <ul style="list-style: none; float: left;">
<?php

function list_item ($categorie) {
?>
<li>
    <input style="float: left;" id="<?php echo str_replace(" ", "_", $categorie['categorie_n']); ?>" type="checkbox" name="categorii[]" id= "cateogrii" value="<?php echo $categorie['categorie_n']?>" />
    <label for="<?php echo str_replace(" ,().", "_", $categorie['categorie_n']); ?>" style="margin-left: 20px;"><?php echo $categorie['categorie_m']?></label>
</li>
<?php
}


for($i=0; $i < (int)(1/3 * count($categorii)); $i++) {
    list_item($categorii[$i]);
}
?>
</ul>
<ul style="list-style: none; float: left;">
<?php

for($i=(int)(1/3 * count($categorii)); $i < (int)(2/3 * count($categorii)); $i++) {
    list_item($categorii[$i]);
}
?>
</ul>
<ul style="list-style: none; float: left;">
<?php
for($i=(int)(2/3 * count($categorii)); $i < count($categorii); $i++) {
    list_item($categorii[$i]);
}
?>
</ul>
</div>							
								</div>
								<?php
								if(!isset($id_petitie)){
									$id_petitie = 0;
								}
								?>
								<input type="hidden" value="<?php echo $id_petitie?>" name = "id_petitie" id="id_petitie"/>
								<div align="center">									
									<button href="#preview" data-toggle="modal" type="button" class="btn btn-large btn-success" align="center" id="previz"><i class="icon-zoom-in icon-white"></i> Previzualizare</button>
									<button type="button" class="btn btn-large btn-success" align="center" id="salvare"><i class="icon-briefcase icon-white"></i> Salvare</button>
									<button type="submit" class="btn btn-large btn-primary" align="center" id="trimite"><i class="icon-ok icon-white"></i> Trimitere</button>									
									<button type="button" class="btn btn-large btn-success" align="center" id="sterge"><i class="icon-remove icon-white"></i> Ştergere</button>
								</div>
								<div id ="salvat">
								</div>
					</form>
				</div>
				</fieldset>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function() {
	$('#salvare').click(function() {		
		var chkElem = document.getElementsByName("categorii[]");
		var choice ="";
        for(var i=0; i< chkElem.length; i++){
            if(chkElem[i].checked)
                choice = choice + ',' + chkElem[i].value;
        }		
		if(choice==""){
			Messenger().post({
			  message: 'Trebuie să selectezi cel puțin o categorie',
			  type: 'error',
			  showCloseButton: true
			});
			return false;
		}else if($.trim($('#titlu').val())==""){
			Messenger().post({
			  message: 'Petiția trebuie să aibă un titlu',
			  type: 'error',
			  showCloseButton: true
			});
			return false;
		}
		var form_data = {
			titlu: $('#titlu').val(),	
			petitie: $('#petitie').val(),
			categorii: choice,
			id_petitie: $('#id_petitie').val(),
			ajax: '1'  
		};
		
		Messenger().run({
	  		progressMessage: "Petiție în curs de salvare...",
	  		errorMessage: "Salvare eșuată!",
	  		successMessage: "Petiție salvată cu succes! Încă nu a fost publicată și poate fi vizualizată in contul tău."
		}, {
		  url: "<?php echo base_url('petitie_noua/salvare'); ?>",
		  type: 'POST',
		  data: form_data,
		  success: function(msg) {				
				$('#id_petitie').val(msg);
			}
		});
		return false; 
	});

	previewInsert
	var d = new Date();
	$("#previz").click(function() {
        $("#titleInsert").html($("#titlu").val());
        $("#contentInsert").html($("#petitie").val());
        $("#userInsert").html(<?php echo "'".$author."'";?>);
        var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

		var yyyy = today.getFullYear();
		if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = mm+'.'+dd+'.'+yyyy+', '+today.getHours()+':'+((today.getMinutes()<10) ? ('0' + today.getMinutes()) : (today.getMinutes()));
        $("#timeInsert").html(today);
        var labels = document.getElementsByTagName('LABEL');
		for (var i = 0; i < labels.length; i++) {
		    if (labels[i].htmlFor != '') {
		         var elem = document.getElementById(labels[i].htmlFor);
		         if (elem)
		            elem.label = labels[i];			
		    }
		}
        var chkElem = document.getElementsByName("categorii[]");
		var choice ="";
        for(var i=0; i< chkElem.length; i++){
            if(chkElem[i].checked)
                choice = choice + ', <a href="<?php echo base_url();?>petitii_deschise/categorie/' + labels[i+1].htmlFor + '">' + document.getElementById(chkElem[i].value).label.innerHTML + '</a>';
        }
        choice = choice.substring(2);
        $("#categoryInsert").html(choice);
    });
	
	$('#sterge').click(function() {			
		var form_data = {			
			id_petitie: $('#id_petitie').val(),
			ajax: '1'  
		};
		
		Messenger().run({
	  		progressMessage: "Petiție în curs de stergere...",
	  		errorMessage: "Stergere eșuată!",
	  		successMessage: "Petiție stearsă cu succes!"
		}, {
		  url: "<?php echo base_url('petitie_noua/stergere'); ?>",
		  type: 'POST',
		  data: form_data,
		  success: function(msg) {																
				$('#titlu').val('');
				$('#petitie').val('');
				$('#id_petitie').val('0');
				var chkElem = document.getElementsByName("categorii[]");
				for(var i=0; i< chkElem.length; i++){
					if(chkElem[i].checked){
						chkElem[i].checked = false;
					}
				}					
			}
		});
		return false; 
	});


});
</script>		
<script type="text/javascript">
    $("input[type=checkbox]").click(function() {

    var bol = $("input[type=checkbox]:checked").length >= 3;     
    $("input[type=checkbox]").not(":checked").attr("disabled",bol);

});


jQuery(document).ready(function($) {
    updateCountdown();
    $('#petitie').change(updateCountdown);
    $('#petitie').keyup(updateCountdown);
});

jQuery(document).ready(function($) {
    updateCountdownTitle();
    $('#titlu').change(updateCountdownTitle);
    $('#titlu').keyup(updateCountdownTitle);
});


function updateCountdown() {
    var remaining = 1000 - jQuery('#petitie').val().length;
    jQuery('.countdown').text(remaining + ' caractere disponibile');
}

function updateCountdownTitle() {
    var remaining = 100 - jQuery('#titlu').val().length;
    jQuery('.countdownTitle').text(remaining + ' caractere disponibile');
}

</script>

<div id="preview" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Previzualizarea petiției</h3>
  </div>
  <div class="modal-body" id="previewInsert" style="overflow:hidden;">
	  	<h2 style="width: 600px;">
	        <div class="petitionTitle" id="titleInsert">
	        </div>
		</h2>

		<!--<small style="padding-right: 10px;"> 
			<i class="icon-user"></i> 
			<?php echo $autor; ?>
		</small>-->
		<small style="padding-right: 10px;"><i class="icon-user"></i> <div id="userInsert" style="display: inline-table;"></div></small>
	    <small style="padding-right: 10px;"><i class="icon-calendar"></i> <div id="timeInsert" style="display: inline-table;"></div></small>

		<small style="padding-right: 10px;"><i class="icon-tags"></i> <div id="categoryInsert" style="display: inline-table;"></div></small>
		<hr style="margin:0;">
		<div class="petition-text">
			<p style = "text-align: justify; white-space:pre;margin-top: 10px;" id="contentInsert">
			</p>
		</div>
  </div>
  <div class="modal-footer">
  </div>
</div>
