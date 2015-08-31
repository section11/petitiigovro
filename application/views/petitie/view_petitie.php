	<script src="<?php echo base_url()?>js/jquery.counter.js" type="text/javascript"></script>
<!-- SHARE BUTTONS -->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "0c636883-4b1a-42ce-bcfc-5fba52ace7bc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<!-- SHARE BUTTONS END -->

<?php if (!empty($rezultate)) : ?>
	<div id="content-wrapper" class="drop-shadow">
		<div id="content">
			<?php if($rezultate['datatinta'] < date('Y-m-d H:i:s') && $rezultate['voturi'] < 10000){?>
			<div class="alert alert-info">
				Îți mulțumim pentru interesul tău pentru PETIȚII.GOV.RO – vocea ta în Guvernul României, un instrument nou menit să încurajeze implicarea cetățenilor la procesul decizional din interiorul Palatului Victoria.<br><br>
				Din păcate, petiția accesată a expirat întrucât nu a reunit sprijinul necesar de 10.000 de semnături necesare în intervalul de timp de 30 de zile de la data depunerii acesteia.<br><br>
				Astfel, deşi cursul acestei petiţii nu mai este de actualitate, poţi căuta alte propuneri similare la PETIȚII.GOV.RO pe care le poți sprijini. 
				Dacă vrei să avansezi o propunere nouă, poți face acest lucru în pagina dedicată petițiilor noi.
			</div>
			<?php } else { ?>
			<div class="alert alert-block alert-error fade in" id="popup">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<h4 class="alert-heading">Ați semnat deja această petiție</h4>
				<?php
					$erori = 0;
					if(isset($deja) && $deja != ""){
						$erori=1;
						echo $deja;
					}
				?>
			</div>
			<script type="text/javascript">
				<?php if($erori === 0) {
					echo "$('.alert').hide();";
				} else {
					echo "$('.alert').show();";
				}
				?>
			</script>
			<?php
				if($rezultate['voturi'] >= 10000 && $raspuns == 0){
			?>
			<div class="alert alert-success">
			    Această petiție a atins pragul necesar de semnături și așteaptă un răspuns oficial.
			</div>
			<?php
				}
			?>
			
			<h3 style="width: 600px;">
                <?php 
                    echo $rezultate['titlu'];
                ?>
			</h3>

			<?php 
				if($admin == true) {
					echo '<small style="padding-right: 10px;"> <i class="icon-user"></i> <a href="'.base_url().'panou_admin/user/'.$initiator.'">'.$autor.'</a></small>';
				}
			?>
                <small style="padding-right: 10px;"><i class="icon-calendar"></i> <?php echo date('d.m.Y, H:i', strtotime($rezultate['data']));?></small>
				<small style="padding-right: 10px;"><i class="icon-tags"></i> <?php echo $categorie;?></small>
				<hr>
				<div class="petition-text">
				<?php

				?>
					<p style="text-align: justify;">
						<?php
							echo nl2br($rezultate['descriere']);
						?>
					</p>
				</div>

				<hr>

				<!-- SIGN -->
				<div style="height:45px;">
					<!-- SHARE BUTTONS -->
					<div style="float:right;padding-top:6px;">
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_email_large' displayText='Email'></span>
					</div>
					<!-- SHARE BUTTONS END -->

					<div style="float:left">
						<?php
					if(isset($admin)){
						if($admin == TRUE){
						?>
							<!--
							<form action="<?php echo base_url();?>panou_admin/raspunde<?php echo $id; ?>" method="post" style="display:inline-table">
								<input type="text" name="id_petitie" value="<?php echo $id; ?>" style="display:none;">
								<button class="btn btn-primary btn-large" id="slidePusher2"><i class="icon-white icon-pencil"></i> Răspundeți</button>								
							</form>
							<form action="<?php echo base_url();?>print_petitie" method="post" style="display:inline-table">
								<button type="submit" class="btn btn-primary btn-large" id="slidePusher2"><i class="icon-white icon-envelope"></i> Trimite</button>
								<input type="text" name="id_petitie" value="<?php echo $id; ?>" style="display:none;">
							</form>
							-->
							<?php 
								if($semnare == 0){
							?>
							<form style="display:inline-table;" action="<?php echo base_url();?>semnare/index" method="post" <?php if(!$logat) echo 'onsubmit="return !$(\'#login-box\').click();"';?> >
								<button type="submit" class="btn btn-primary btn-large" id="sign"><i class="icon-white icon-pencil"></i> Semnează</button>
								<input type="text" name="id_petitie" value="<?php echo $id; ?>" style="display:none;">
							</form>
							<a type="button" class="btn btn-primary btn-large" id="sign" href = "<?php echo base_url();?>panou_admin/raspunde/<?php echo $id; ?>" style="display:inline-table;height: 20px;"><i class="icon-white icon-pencil"></i> Răspunde</a>
							<?php 
								} else {
							?>
							<button type="submit" class="btn btn-primary btn-large" id="sign" disabled><i class="icon-white icon-pencil"></i> Semnătura a fost înregistrată</button>
							<?php 
								}
							?>
						<?php					
						} else {							
							if($semnare != 0){
						?>
                            <button type="submit" class="btn btn-primary btn-large" id="sign" disabled><i class="icon-white icon-pencil"></i> Semnătura a fost înregistrată</button>
						<?php
							} else {
						?>
							<form action="<?php echo base_url();?>semnare/index" method="post" <?php if(!$logat) echo 'onsubmit="return !$(\'#login-box\').click();"';?> >
								<button type="submit" class="btn btn-primary btn-large" id="sign"><i class="icon-white icon-pencil"></i> Semnează</button>
								<input type="text" name="id_petitie" value="<?php echo $id; ?>" style="display:none;">
							</form>
						<?php
							}	
						}							
					}else{
							echo '<a class="btn btn-success btn-large" id="viewResponse" href="'.base_url().'raspunsuri/afisare_raspuns/'.$id.'"><i class="icon-white icon-check"></i> Citește răspunsul</a>';
						}				
					?>
						
					</div>
				</div>
				<!-- END SIGN -->
                <br>


                <div style="overflow:hidden;height: 57px;line-height:15px;">
                <div class="vote-wrapper" style="float: left;">
                    <table style="background-color: white;">
                        <tr>
                        <td>
                        <div class="vote-counter">
                            <div id="counter_voturi">
                                <input type="hidden" name="counter-value" value="<?php echo $rezultate['voturi'];?>">
                            </div>
                        </div>
                        </td>
                        
                        <td style="width: 110px;">
                        <span>Semnături strânse până în prezent</span>
                        </td>                    
                        </tr>
                    </table>
                </div>

                <div class="vote-wrapper" style="float: right">
                    <table style="background-color: white;"> <!-- #527da8 -->
                        <tr>
                        <td style="width: 120px;">
                        <span>Semnături necesare până la <?php echo $rezultate['data_expirarii'];?> </span>
                        </td>

                        <td>
                        <div class="vote-counter">
                            <div id="counter_voturi_necesare">
                                <input type="hidden" name="counter-value" value="<?php
                                    $necesare = (10000 - $rezultate['voturi']);
                                    if($necesare <= (-1)) { $necesare = 0;}

                                    echo $necesare;?>">
                            </div>
                        </div>
                        </td>
                        </tr>
                    </table>
                </div>
                </div>

                <br>
                <div style="box-shadow:none; background-image:none;" class="progress progress-striped active">
                <?php $procent = ($rezultate['voturi']/10000.0 * 100); ?>
                    <div class="bar" style="width: <?php echo $procent;?>%; background-color: #346699;" title="<?php echo $rezultate['voturi'];?> semnături strânse"></div>
                    <!-- <div class="bar bar-success" style="width: <?php echo $procent;?>%; background-color: #679A01;" title="<?php echo $rezultate['voturi'];?> semnături strânse"></div>
                    <div class="bar" style="width: <?php echo 100.0-$procent;?>%; background-color: #346699;" title="<?php echo (10000 - $rezultate['voturi']);?> semnături necesare"></div> -->
                </div>

                <script type="text/javascript">
				/* <![CDATA[ */
					jQuery(document).ready(function($) {
							$("#counter_voturi").flipCounter();            
                            $("#counter_voturi_necesare").flipCounter();
					});
				/* ]]> */
				</script>
				<!-- RASPUNS DACA ARE -->
				<?php 
				if($raspuns == 1){
				?>
			<div class="accordion" id="accordion7">
				<div class="accordion-group">
				    <div class="accordion-heading">
				      	<a class="accordion-toggle" style="color:white; background: rgba(103, 154, 1, 0.71); text-align:center; text-decoration: none" data-toggle="collapse" data-parent="#accordion7" href="#collapseSvn">
				        	<i class="icon-retweet icon-white"></i> Vezi răspunsul oficial
				      	</a>
				    </div>
				    <div id="collapseSvn" class="accordion-body collapse out">
				      	<div class="accordion-inner">
							<div class="petitionContainerSigned">
								<div class="petitionContainerSignedText">
									<h3 style="width: 600px;">
										<div class="petitionTitle">
											<?php 
												echo $date_raspuns['titlu'];
											?>
										</div>
									</h3>
									<small style="padding-right: 10px;"><i class="icon-user"></i> <?php echo $date_raspuns['respondent']; ?></small>
									<small style="padding-right: 10px;"><i class="icon-calendar"></i> <?php echo date('d.m.Y, H:i', strtotime($date_raspuns['data']));?></small>				
									<hr>

									<p style="text-align: justify;">				
										<?php echo nl2br($date_raspuns['raspuns']); ?>
									</p>
								</div>
							</div>
				      	</div>
				    </div>
			    </div>
			</div>
				<?php
				}
				?>
				<!-- SEMNATARI -->
				<h2>Cele mai recente semnături</h2>
				<br>
				<div class="semnatari" style="display:inline-table">
					<?php foreach($semnaturi as $semnatar): ?>
							<div class="semnatar">
								<?php
								
								if($admin == TRUE ){
									$n = $semnatar['nume'];
									$p = $semnatar['prenume'];
								}
								else{
										$n = substr($semnatar['nume'], 0, 1).'.';
										$p = substr($semnatar['prenume'], 0, 1).'.';
								}
								
								

								 echo sprintf('<b>%s %s</b> <br>%s<br>%s',
									$p,
									$n,
									$semnatar['oras'],
									date('d.m.Y, H:i', strtotime($semnatar['data']))
								) ?>
							</div>
					<?php endforeach; ?>
				</div>
				<br>
		<?php }?>
		</div>
	
<?php else : ?>
<div id="content-wrapper" class="drop-shadow">
	<div id="content">
		<div class="alert alert-error" align="center">
			<b>Ne pare rău, această pagină nu este disponibilă.<br />
				Adresa pe care ați urmat-o este invalidă, sau pagina a fost dezactivată.
			</b>
			<br />
			<a href="<?php echo base_url()?>" style="text-decoration: none">Mergeți la prima pagină</a> sau  <a href="<?php echo base_url()?>petitie_noua">creați o petiție nouă</a>
		</div>
	</div>
	
<?php endif; ?>
