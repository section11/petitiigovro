<div id="content-wrapper" class="drop-shadow">
    <div id="content-alone">
				<div class="control-group">
				<h2>+ Petiție în așteptare</h2>				
				<fieldset>
				<form action ="" method = "POST" id="formular">
					<div class="alert alert-info blueBox">
						<b>Titlul petiției</b>
						<div style="padding-top:10px;">
							<input readonly type="text" name="titlu" id="titlu" maxlength="100" value="<?php echo $petitie->titlu?>" class="field" style="width: 100%;">
						</div>
					</div>
					<div class="alert alert-info blueBox">
						<b>Conținutul petiției</b>
						<div style="padding-top:10px;">
							<textarea readonly class="field" name="petitie" id="petitie" maxlength="1000" rows="17" id="inputPetitie"  style="height:200px; width:100%;"><?php echo $petitie->textpetitie;?></textarea>
						</div>
					</div>					
					<div class="alert alert-info blueBox" style="overflow: hidden;">
						<b>Categoriile petiției</b>						
                        <div style="padding-left:100px;padding-top:10px;">
                        <ul style="list-style: none; float: left;">
<?php

function list_item ($categorie, $cat1, $cat2, $cat3) {	
	if($cat1 == $categorie['categorie_n'] || $cat2 == $categorie['categorie_n'] || $cat3 == $categorie['categorie_n']){
	?>
	<li>
		<input style="float: left;" checked id="<?php echo str_replace(" ", "_", $categorie['categorie_n']); ?>" type="checkbox" name="categorii[]" id= "cateogrii" value="<?php echo $categorie['categorie_n']?>"  />
		<label for="<?php echo str_replace(" ,().", "_", $categorie['categorie_n']); ?>" style="margin-left: 20px;"><?php echo $categorie['categorie_m']?></label>
	</li>
	<?php
	}else{
?>
<li>
    <input style="float: left;" id="<?php echo str_replace(" ", "_", $categorie['categorie_n']); ?>" type="checkbox" name="categorii[]" id= "cateogrii" value="<?php echo $categorie['categorie_n']?>" />
    <label for="<?php echo str_replace(" ,().", "_", $categorie['categorie_n']); ?>" style="margin-left: 20px;"><?php echo $categorie['categorie_m']?></label>
</li>
<?php
	}
}


for($i=0; $i < (int)(1/3 * count($categorii)); $i++) {
    list_item($categorii[$i], $cat1, $cat2, $cat3);
}
?>
</ul>
<ul style="list-style: none; float: left;">
<?php

for($i=(int)(1/3 * count($categorii)); $i < (int)(2/3 * count($categorii)); $i++) {
    list_item($categorii[$i], $cat1, $cat2, $cat3);
}
?>
</ul>
<ul style="list-style: none; float: left;">
<?php
for($i=(int)(2/3 * count($categorii)); $i < count($categorii); $i++) {
    list_item($categorii[$i], $cat1, $cat2, $cat3);
}
?>
</ul>
</div>
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
        $("#timeInsert").html(d.toLocaleTimeString());
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
                choice = choice + ',' + document.getElementById(chkElem[i].value).label.innerHTML;
        }
        choice = choice.substring(1);
        $("#categoryInsert").html(choice);
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


function updateCountdown() {
    var remaining = 1000 - jQuery('#petitie').val().length;
    jQuery('.countdown').text(remaining + ' caractere disponibile');
}

</script>
