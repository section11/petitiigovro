<div id="content-wrapper" class="drop-shadow">
    <div id="content-alone">

    <ul class="nav nav-tabs" id="nav_profil">
        <li class="active"><a href="#petitii" data-toggle="tab">Moderare petiții<sup><?php echo $petitii_asteptare;?></sup></a></li>
        <li><a href="#raspunsuri" data-toggle="tab">Răspunsuri oficiale</a></li>
        <li><a href="#useri" data-toggle="tab">Utilizatori</a></li>
        <li><a href="#mesaj" data-toggle="tab">Mesaje</a></li>
    </ul>

    <div class="tab-content">
    <div class="tab-pane active" id="petitii">
    <h2>Aprobare și management de petiții</h2>

    <div class="accordion" style="margin: 10px 10px 10px 0px;" id="accordion2">
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
	        <i class="icon-th-list"></i> Petiții în așteptare
	      </a>
	    </div>
	    <div id="collapseOne" class="accordion-body collapse out">
	      <div class="accordion-inner">
	      	<div id="petitiiLocale">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current=5;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_locale'?>/0', function(data) {
				  $('#petitiiLocale').html(data);		
				  current += 5;
				});
					
	      	});
	      	function loadMore(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_locale'?>/' + current, function(data) {
				  $('#petitiiLocale').append(data);
				}).done(function(){
					current+=5;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	function checkEmpty(){
	      		if(current==0){
	      			loadMore();
	      		}
	      	}
	      	function approvePetition(id){
	      		$("#" + id).animate({opacity:0.2}, 500);
	      		$("#" + id).css({'background-color': 'rgb(151, 241, 115)'});
	      		$("#loadingProg").show();
	      		$.ajax({
				  url: "<?php echo base_url().'panou_admin/aproba/'?>" + id,
				  context: document.body
				}).done(function() {
				  $("#" + id).fadeOut();				  
				}).fail(function(){
					$("#" + id).animate({opacity:1, 'background-color': none}, 500);
					$("#" + id).css({'background-color': 'none'});

				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	function rejectPetition(id){
				var mesaj = $('#message_respinge' + id).val();				
	      		$("#" + id).animate({opacity:0.2, 'background-color': 'rgb(214, 72, 72)'}, 500);
	      		$("#" + id).css({'background-color': 'rgb(214, 72, 72)'});
	      		$("#loadingProg").show();
	      		$.ajax({
				  url: "<?php echo base_url().'panou_admin/respinge/'?>" + id + '/' + mesaj,				  		
				  mes: mesaj,
				  context: document.body
				}).done(function() {
				  $("#" + id).fadeOut();
				  
				}).fail(function(){
					$("#" + id).animate({opacity:1, 'background-color': none}, 500);
					$("#" + id).css({'background-color': 'none'});
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
			function showRespinge(id){
				$('#send_message_respinge' + id).show();				
			}
	      	</script>
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
	        <i class="icon-th-list"></i> Petiții respinse
	      </a>
	    </div>
	    <div id="collapseTwo" class="accordion-body collapse out">
	      <div class="accordion-inner">
	        <div id="petitiiRespinse">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore_respinse()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current_respinse = 3;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_respinse'?>/' + current_respinse, function(data) {
				  $('#petitiiRespinse').html(data);
				  current_respinse += 3;
				});
	      	});
	      	function loadMore_respinse(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_respinse'?>/' + current_respinse, function(data) {
				  $('#petitiiRespinse').append(data);
				}).done(function(){
					current_respinse += 3;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	</script>
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
	        <i class="icon-th-list"></i>Petiții expirate
	      </a>
	    </div>
	    <div id="collapseThree" class="accordion-body collapse out">
	      <div class="accordion-inner">
	        <div id="petitiiExpirate">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore_expirate()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current_expirate = 3;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_expirate'?>/' + current_expirate, function(data) {
				  $('#petitiiExpirate').html(data);
					current_expirate += 3;
				});
	      	});
	      	function loadMore_expirate(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_expirate'?>/' + current_expirate, function(data) {
				  $('#petitiiExpirate').append(data);
				}).done(function(){
					current_expirate += 3;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	</script>
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
	        <i class="icon-th-list"></i> Petiții active
	      </a>
	    </div>
	    <div id="collapseFour" class="accordion-body collapse out">
	      <div class="accordion-inner">
	        <div id="petitiiActive">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore_active()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current_active = 3;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_active'?>/' + current_active, function(data) {
				  $('#petitiiActive').html(data);
					current_active += 3;
				});
	      	});
	      	function loadMore_active(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_active'?>/' + current_active, function(data) {
				  $('#petitiiActive').append(data);
				}).done(function(){
					current_active += 3;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	</script>
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
	        <i class="icon-th-list"></i> Petiții fără răspuns 
	      </a>
	    </div>
	    <div id="collapseFive" class="accordion-body collapse out">
	      <div class="accordion-inner">
	        <div id="petitiiFRaspuns">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore_FRaspuns()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current_fara_raspuns = 3;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_fara_raspuns'?>/' + current_fara_raspuns, function(data) {
				  $('#petitiiFRaspuns').html(data);
				  current_fara_raspuns += 3;
				});
	      	});
	      	function loadMore_FRaspuns(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_fara_raspuns'?>/' + current_fara_raspuns, function(data) {
				  $('#petitiiFRaspuns').append(data);
				}).done(function(){
					current_fara_raspuns += 3;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	</script>
	      </div>
	    </div>
	  </div>
	  <div class="accordion-group">
	    <div class="accordion-heading">
	      <a class="accordion-toggle" style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
	        <i class="icon-th-list"></i> Petiții cu răspuns 
	      </a>
	    </div>
	    <div id="collapseSix" class="accordion-body collapse out">
	      <div class="accordion-inner">
	        <div id="petitiiCRaspuns">
	      	</div>
	      	<button class="btn btn-primary" id="incarcare" onClick="loadMore_CRaspuns()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	      	<script type="text/javascript">
	      	var current_cu_raspuns = 3;
	      	$(document).ready(function() {
		      	$.get('<?php echo base_url().'panou_admin/petitii_cu_raspuns'?>/' + current_cu_raspuns, function(data) {
				  $('#petitiiCRaspuns').html(data);
				  current_cu_raspuns += 3;
				});
	      	});
	      	function loadMore_CRaspuns(){
	      		$("#loadingProg").show();
	      		$.get('<?php echo base_url().'panou_admin/petitii_cu_raspuns'?>/' + current_cu_raspuns, function(data) {
				  $('#petitiiCRaspuns').append(data);
				}).done(function(){
					current_cu_raspuns += 3;
				}).then(function(){
					$("#loadingProg").hide();
				});
	      	}
	      	</script>
	      </div>
	    </div>
	  </div>
	</div>

    <!--

	DE FOLOSIT CAND AFISEZ PETITIILE

    <div class="petitionContainerSigned">
        <div class="petitionContainerSignedText">
            <a href="<?php echo base_url().'search/view_petitie/'.$p->id;?>"><h5><?php echo $p->titlu; ?></h5></a>
        </div>
    </div>

	-->


    </div>
    
    <div class="tab-pane" id="raspunsuri">
	    <h2>Editare răspunsuri</h2>
	    <div id="raspunsuriContainer">
	  	</div>
	  	<button class="btn btn-primary" id="incarcare" onClick="loadMore3()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/>Mai mult...</button>
	  	<script type="text/javascript">
	  	var current3 = 5;
	  	$(document).ready(function() {
	      	$.get('<?php echo base_url().'panou_admin/raspunsuri'?>/5', function(data) {
			  $('#raspunsuriContainer').append(data);
			  current3 += 5;
			});
	  	});
	  	function loadMore3(){
	  		$("#loadingProg").show();
	  		$.get('<?php echo base_url().'panou_admin/raspunsuri'?>/' + current3, function(data) {
			  $('#raspunsuriContainer').append(data);
			}).done(function(){
				current3 += 5;
			}).then(function(){
				$("#loadingProg").hide();
			});
	  	}
	  	</script>
    </div>
    
    <div class="tab-pane" id="useri">    				
		<div id="useriContainer">
            <table class="table table-striped" style="width: 100%" id="tabelUseri">
                <tr>
                	<td> </td>
					<td>#</td>
                    <td>Nume</td>
                    <td>Prenume</td>
                    <td>E-mail</td>
                    <td>IP</td>
                    <td>Stare</td>
                    <td>Acțiuni</td>
                </tr>
            </table>
		
		
	  	</div>		
	  	<button class="btn btn-primary" id="incarcare" onClick="loadMore4()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/><i class="icon-chevron-down icon-white"></i> Continuare</button>
	  	<button class="btn btn-primary pull-right" id="sterge_multiplu" onClick="suspendeaza_multiplu()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/><i class="icon-ban-circle icon-white"></i> Suspendă</button>
	  	<button class="btn btn-primary pull-right" id="sterge_multiplu" onClick="unsuspendeaza_multiplu()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/><i class="icon-ok-sign icon-white"></i> Desuspendă</button>
        <button class="btn btn-primary pull-right" id="sterge_multiplu" onClick="sterge_multiplu()"><img style="display:none;" id="loadingProg" src="<?php echo base_url().'img/loading.gif'?>"/><i class="icon-remove-sign icon-white"></i> Șterge</button>

	  	<script type="text/javascript">	  	
		var current4=20;
	  	$(document).ready(function() {			
	      	$.get('<?php echo base_url().'panou_admin/useri/'?>' + current4, function(data) {
			    $('#tabelUseri').append(data);			
			    current4+=20;
			});
			
	  	});	  	
		function loadMore4(){
	  		$("#loadingProg").show();
	  		$.get('<?php echo base_url().'panou_admin/useri/'?>' + current4, function(data) {
			  $('#tabelUseri').append(data);
			}).done(function(){
				current4+=20;
			}).then(function(){
				$("#loadingProg").hide();
			});
	  	}
	  	function suspendare(id){
	  		Messenger().run({
				progressMessage: "Utilizator în curs de suspendare...",
				errorMessage: "Suspendare eșuată!",
				successMessage: "Suspendare reușită!"
			}, {
			url: "<?php echo base_url();?>panou_admin/suspendare_user/" + id,
			type: 'POST'		
			}).done(function(){
				$("#"+id).css({"background-color":"rgb(255, 255, 186)"});
				$("#stare"+id).html("suspendat");
			});
			return false; 
	  	}
	  	function unsuspendare(id){
	  		Messenger().run({
				progressMessage: "Utilizator în curs de activare...",
				errorMessage: "Activare eșuată!",
				successMessage: "Activare reușită!"
			}, {
			url: "<?php echo base_url();?>panou_admin/unsuspendare_user/" + id,
			type: 'POST'		
			}).done(function(){
				$("#"+id).css({"background-color":"rgb(227, 255, 186)"});
				$("#stare"+id).html("activat");
			});
			return false; 
	  	}
	  	function stergere(id){
	  		Messenger().run({
				progressMessage: "Utilizator în curs de ștergere...",
				errorMessage: "Ștergere eșuată!",
				successMessage: "Ștergere reușită!"
			}, {
			url: "<?php echo base_url();?>panou_admin/stergere_user/" + id,
			type: 'POST'		
			}).done(function(){
				$("#"+id).css({"background-color":"rgb(255, 166, 166)"});
				$("#stare"+id).html("sters");
			});
			return false; 
	  	}
		function sterge_multiplu(){
			var chkElem = document.getElementsByName("utilizatori[]");
			var choice ="";
			for(var i=0; i< chkElem.length; i++){
				if(chkElem[i].checked){				
					choice = choice + chkElem[i].value + ',';
				}
			}
			if(choice==""){
				Messenger().post({
				  message: 'Trebuie să selectezi cel puțin un utilizator',
				  type: 'error',
				  showCloseButton: true
				});
				return false;
			}
			var form_data = {				
				useri: choice,				
				ajax: '1'  
			};
		
			Messenger().run({
				progressMessage: "Utilizatori în curs de stergere...",
				errorMessage: "Stergere eșuată!",
				successMessage: "Stergere reușită!"
			}, {
			url: "<?php echo base_url('panou_admin/stergere_multiple'); ?>",
			type: 'POST',
			data: form_data,			
			}).done(function(){
				for(var i=0; i< chkElem.length; i++){
					if(chkElem[i].checked){				
						$("#"+chkElem[i].value).css({"background-color":"rgb(255, 166, 166)"});
						$("#stare"+chkElem[i].value).html("sters");
					}
				}
			});
			return false; 			
		}
		function suspendeaza_multiplu(){
			var chkElem = document.getElementsByName("utilizatori[]");
			var choice ="";
			for(var i=0; i< chkElem.length; i++){
				if(chkElem[i].checked){
					choice = choice + chkElem[i].value + ',';
				}
			}
			if(choice==""){
				Messenger().post({
				  message: 'Trebuie să selectezi cel puțin un utilizator',
				  type: 'error',
				  showCloseButton: true
				});
				return false;
			}
			var form_data = {				
				useri: choice,				
				ajax: '1'  
			};
		
			Messenger().run({
				progressMessage: "Utilizatori în curs de suspendare...",
				errorMessage: "Suspendare eșuată!",
				successMessage: "Suspendare cu succes!"
			}, {
				url: "<?php echo base_url('panou_admin/suspendare_multiple'); ?>",
				type: 'POST',
				data: form_data,			
			}).done(function(){
				for(var i=0; i< chkElem.length; i++){
					if(chkElem[i].checked){				
						$("#"+chkElem[i].value).css({"background-color":"rgb(255, 255, 186)"});
						$("#stare"+chkElem[i].value).html("suspendat");
					}
				}
			});
			return false; 			
		}
		function unsuspendeaza_multiplu(){
			var chkElem = document.getElementsByName("utilizatori[]");
			var choice ="";
			for(var i=0; i< chkElem.length; i++){
				if(chkElem[i].checked){
					choice = choice + chkElem[i].value + ',';
				}
			}
			if(choice==""){
				Messenger().post({
				  message: 'Trebuie să selectezi cel puțin un utilizator',
				  type: 'error',
				  showCloseButton: true
				});
				return false;
			}
			var form_data = {				
				useri: choice,				
				ajax: '1'  
			};
		
			Messenger().run({
				progressMessage: "Utilizatori în curs de activare...",
				errorMessage: "Activare eșuată!",
				successMessage: "Activare cu succes!"
			}, {
				url: "<?php echo base_url('panou_admin/unsuspendare_multiple'); ?>",
				type: 'POST',
				data: form_data,			
				}).done(function(){
				for(var i=0; i< chkElem.length; i++){
					if(chkElem[i].checked){				
						$("#"+chkElem[i].value).css({"background-color":"rgb(227, 255, 186)"});
						$("#stare"+chkElem[i].value).html("activat");
					}
				}
			});
			return false; 			
		}
	</script>	
	</table>


    
    </div>
     <div class="tab-pane" id="mesaj">
	    <h2>Trimitere mesaj catre toti utilizatorii</h2>
	   <form>
		<textarea id="mesaj_utilizatori" name = "mesaj_utilizatori" ></textarea><br>
		<button type="submit" id="submit_mesaj">Trimite mesaj</button>
	   </form>
	  <script type="text/javascript">
		$(document).ready(function(){
			$('#submit_mesaj').click(function(){
				var val = $('#mesaj_utilizatori').val();	
				
				var form_data = {				
					mesaj: val,				
					ajax: '1'  
				};
		
				Messenger().run({
					progressMessage: "Mesaj in curs de trimitere...",
					errorMessage: "Trimitere eșuată!",
					successMessage: "Mesaj trimis cu succes!"
				}, {
					url: "<?php echo base_url('panou_admin/mesaj_allusers'); ?>",
					type: 'POST',
					data: form_data,			
					});
				return false; 		
			});
		});		
	  </script>
	  <h2>Istoric Mesaje</h2>
	  <div id="istoric_mesaje">
	  </div>
	  <script type="text/javascript">
		$(document).ready(function() {			
	      	$.get('<?php echo base_url().'panou_admin/istoric_mesaje/'?>', function(data) {
			    $('#istoric_mesaje').append(data);						    
			});
			
	  	});
	  </script>
    </div>
    </div>

</div>
    </div>
