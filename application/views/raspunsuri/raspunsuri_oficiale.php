<script src="<?php echo base_url()?>js/jquery.counter.js" type="text/javascript"></script>
<div id="content-wrapper" class="drop-shadow">
    <div id="content">
		<h2 style="width: 600px;">
            <div class="petitionTitle">
                <?php 
                    echo $raspuns['titlu'];
                ?>
            </div>
		</h2>
			<small style="padding-right: 10px;"><i class="icon-user"></i> <?php echo $raspuns['respondent']; ?></small>
			<small style="padding-right: 10px;"><i class="icon-calendar"></i> <?php echo date('d.m.Y, H:i', strtotime($raspuns['data']));?></small>
			<small style="padding-right: 10px;"><i class="icon-tags"></i> <?php echo $raspuns['categorie'];?></small>
			<hr>
			<p style="text-align: justify;">				
				<?php echo nl2br($raspuns['raspuns']); ?>
			</p>
			<hr>
			<?php
			echo '<p>Acest răspuns oficial a fost formulat de ' .$raspuns['respondent'] .' față de petiția având ca titlu <a target="_blank" href="'.base_url().'search/view_petitie/'.$raspuns['id'].'">'.$raspuns['titlu_petitie'].'</a>:</p>';
			?>

			<div class="accordion" id="accordion7">
				<div class="accordion-group">
				    <div class="accordion-heading">
				      	<a class="accordion-toggle" style="color:white; background: rgba(52, 102, 153, 0.71); text-align:center; text-decoration: none" data-toggle="collapse" data-parent="#accordion8" href="#collapseEit">
				        	<i class="icon-retweet icon-white"></i> Vezi petiția <?php echo $raspuns['titlu_petitie']; ?>
				      	</a>
				    </div>
				    <div id="collapseEit" class="accordion-body collapse out">
				      	<div class="accordion-inner">
							<div class="petitionContainerSigned">
								<div class="petitionContainerSignedText">
									<h3 style="width: 600px;">
			                        	<?php 
			                            	echo $petitie['titlu'];
			                        	?>
									</h3>				
									<small style="padding-right: 10px;"><i class="icon-calendar"></i> <?php echo date('d.m.Y, H:i', strtotime($petitie['data']));?></small>
									<hr>
									<div class="petition-text">
										<p style = "text-align: justify;">
											<?php
												echo nl2br($petitie['descriere']);
											?>
										</p>
									</div>
			            		</div>
			            		<div class="petitionContainerSignatures"><div align="center" style="display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-pencil icon-white"></i> Semnături strânse: <?php echo number_format(intval($petitie['voturi']), 0, '.', '.'); ?></div></div>
			        		</div>	
						</div>
				    </div>
				</div>
			</div>
	</div>