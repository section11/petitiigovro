<div id="sidebar">
			
			<div class="accordion" style="margin: 10px 10px 10px 0px;" id="accordion2">
			  <div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
			        <i class="icon-th-list"></i> Petiții recente
			      </a>
			    </div>
			    <div id="collapseOne" class="accordion-body collapse out">
			      <div class="accordion-inner">
			        <?php				
						$i = 0;
			            foreach($recent_petitions as $petitie){
							if($i % 2  == 0){
			            		echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.character_limiter($petitie['titlu'],80).'</h5></a>
				                        </div>
				                        <div class="petitionContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: center;"><i class="icon-calendar icon-white"></i> '. date('d.m.Y', strtotime($petitie['data'])) .'</div>';
				                echo '</div></div>';
							}else{//alta culoare
								echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.character_limiter($petitie['titlu'],80).'</h5></a>
				                        </div>
				                        <div class="petitionContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: center;"><i class="icon-calendar icon-white"></i> '. date('d.m.Y', strtotime($petitie['data'])) .'</div>';
				                echo '</div></div>';
							}
							$i++;
						}
					?>
			      </div>
			    </div>
			  </div>
			  <!--rep-->
			  <div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
			        <i class="icon-signal"></i> Petiții populare
			      </a>
			    </div>
			    <div id="collapseTwo" class="accordion-body collapse out">
			      <div class="accordion-inner">
			        <?php 			
						$i = 0;
						foreach($top_petitions as $petitie){
							if($i % 2 == 0){
								echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.character_limiter($petitie['titlu'],80).'</h5></a>
				                        </div>
				                        <div class="petitionContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: center;"><i class="icon-pencil icon-white"></i> '.number_format(intval($petitie['voturi']), 0, '.', '.').' semnături</div>';
				                echo '</div></div>';
							}else{
									echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.character_limiter($petitie['titlu'],60).'</h5></a>
				                        </div>
				                        <div class="petitionContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: center;"><i class="icon-pencil icon-white"></i> '.number_format(intval($petitie['voturi']), 0, '.', '.').' semnături</div>';
				                echo '</div></div>';
							}
							$i++;
						}
			        ?>
			      </div>
			    </div>
			  </div>

			  <div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
			        <i class="icon-tasks"></i> Răspunsuri recente
			      </a>
			    </div>
			    <div id="collapseThree" class="accordion-body collapse out">
			      <div class="accordion-inner">
			        <?php 
						$i = 0;
						foreach($top_raspunsuri as $raspuns){
							if($i % 2 == 0){
			            		echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'raspunsuri/afisare_raspuns/'.$raspuns['id'].'"><h5>'.character_limiter($raspuns['titlu'],80).'</h5></a>
				                        </div>
				                        <div class="answerContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: center;"><i class="icon-calendar icon-white"></i> '. date('d.m.Y', strtotime($raspuns['data'])) .'</div>';
				                echo '</div></div>';
							}else{
								echo '<div class="petitionContainerSigned">
				                        <div class="petitionContainerSignedText">
				                            <a style="text-decoration:none" href="'.base_url().'raspunsuri/afisare_raspuns/'.$raspuns['id'].'"><h5>'.character_limiter($raspuns['titlu'],50).'</h5></a>
				                        </div>
				                        <div class="answerContainerSignatures" align="right"><div style="width:70%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-calendar icon-white"></i> '. date('d.m.Y', strtotime($raspuns['data'])) .'</div>';
				                echo '</div></div>';
							}
						}
					?>
			      </div>
			    </div>
			  </div>

			  <div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
			        <i class="icon-asterisk"></i> Instrumente
			      </a>
			    </div>
			    <div id="collapseFour" class="accordion-body collapse out">
			      <div class="accordion-inner">
					<div id="zoom">
						<div style="text-align: justify">
							<a href="javascript:increaseFS();" style="text-decoration:none"><i class="icon-plus"></i> Text mărit</a>
							<br><a href="javascript:decreaseFS();" style="text-decoration:none"><i class="icon-minus"></i> Text micșorat</a>
							<br><a style="text-decoration:none" href="mailto:Adresă?subject=petitii.gov.ro – Vocea ta în Guvernul României.&body=Guvernul României a lansat http://petitii.gov.ro, un instrument online ce permite cetățenilor să petiționeze administrația publică centrală pe diferite domenii de interes. Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României avansând o petiție nouă sau semnând o petiție deja deschisă."><i class="icon-envelope"></i> Recomandă prin e-mail</a>
							<br><a id="bookmarkme" href="javascript:void(0)" onClick="return ATBookmarkApp.addBookmark(this)" title="petitii.gov.ro – Vocea ta în Guvernul României" style="text-decoration:none"><i class="icon-bookmark"></i> Salvează la favorite</a>
							<br><a onclick="window.print();return false;" href="#" style="text-decoration:none"><i class="icon-print"></i> Tipărește conținut</a>
						</div>
					</div>
			      </div>
			    </div>
			  </div>

			 </div>

			<div class="accordion" style="margin: -8px 10px 10px 0px;" id="accordion3">
				<div class="accordion-group">
				    <div class="accordion-heading">
				      	<a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion5" href="#collapseFive">
				        	<i class="icon-retweet"></i> Proiecte similare
				      	</a>
				    </div>
				    <div id="collapseFive" class="accordion-body collapse in">
				      	<div class="accordion-inner">
							<div id="zoom">
								<div style="text-align: justify; color: #6a7180;">
									<div id="bannerOtherPrj">
										<div class="bannerOtherPrj">
											<a href="http://buget.gov.ro">
											<img src="<?php echo base_url();?>img/buget.gov.ro.jpg" id="bannerOtherPrj" style="height:69px; width:276px;"/></a>
										</div>
										<div class="bannerOtherPrj">
											<a href="http://angajati.gov.ro">
											<img src="<?php echo base_url();?>img/angajati.gov.ro.jpg" id="bannerOtherPrj" style="height:69px; width:276px;"/></a>
										</div>
										<div class="bannerOtherPrj">
											<a href="http://posturi.gov.ro">
											<img src="<?php echo base_url();?>img/posturi.gov.ro.jpg" id="bannerOtherPrj" style="height:69px; width:276px;"/></a>
										</div>
										<div class="bannerOtherPrj">
											<a href="http://date.gov.ro">
											<img src="<?php echo base_url();?>img/date.gov.ro.jpg" id="bannerOtherPrj" style="height:69px; width:276px;"/></a>
										</div>
								</div>
							</div>
				      	</div>
				    </div>
			    </div>
			</div>


				<div class="accordion-group">
				    <div class="accordion-heading">
				      	<a class="accordion-toggle" style="text-decoration: none" data-toggle="collapse" data-parent="#accordion5" href="#collapseSix">
				        	<i class="icon-globe"></i> Conectează-te
				      	</a>
				    </div>
				    <div id="collapseSix" class="accordion-body collapse in">
				      	<div class="accordion-inner">
							<div id="zoom">
								<iframe src="//www.facebook.com/plugins/likebox.php?locale=ro_RO&amp;href=http%3A%2F%2Fwww.facebook.com%2Fguv.ro&amp;width=292&amp;height=200&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:200px;" allowTransparency="true"></iframe>
							</div>
				      	</div>
				    </div>
			    </div>
			</div>


			</div>
		
    </div>
</div>
