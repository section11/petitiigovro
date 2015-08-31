<div id="content-wrapper" class="drop-shadow">
    <div id="content">
        <div class="petitionContainerSignedText" align="center">
            <div class="btn-group">
                <a class="btn dropdown-toggle" href="<?php echo base_url().'petitii_deschise'?>" style="width: 200px"><b><span style="font-variant: small-caps">Petiții deschise</span></b></a>
            </div>
            <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-refresh"></i> Sortare <span class="caret"></span></button>
                <ul class="dropdown-menu" style="width: 250px; text-align:left; background-color:#f0efef;border: 1px solid #D7D8D9;">
                        <li style="width: 250px;"><a style="color: #346699 !important;"href="<?php echo base_url().'petitii_deschise/index/1'?>"><i class="icon-chevron-down"></i> Total voturi</a></li>                        
                        <li style="width: 250px;"><a style="color: #346699 !important;"href="<?php echo base_url().'petitii_deschise/index/2'?>"><i class="icon-chevron-down"></i> Data expirării</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i> Căutare <span class="caret"></span></button>
                <ul class="dropdown-menu" style="background-color:#f0efef;;padding-left:5px;padding-right:5px;">
                    <div class="input-append" style="display: block;">
                        <form class="navbar-search pull-right search-area" id ="search-form" action="<?php echo base_url();?>search" method = "POST">
                            <input type="text" placeholder="Cuvinte cheie" name="termen"  id="searched">
                            <button class="btn" type="submit"><i class="icon-search"></i></button>
                        </form>
                    </div>
                </ul>
            </div>
            <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i> Domenii <span class="caret"></span></button>
                <ul class="dropdown-menu" style="width: 750px; text-align:left; background-color:#f0efef;margin-left:-350px;border: 1px solid #D7D8D9;">
                    <?php
                        foreach($categories as $c) {
                        ?>
                        <li style="float: left; width: 250px;"><a style="color: #346699 !important;"href="<?php echo base_url().'petitii_deschise/categorie/'.$c['categorie_n']?>"><?php echo $c['categorie_m'];?></a></li>
                        <?php 
                        }
                    ?>
                </ul>
            </div>
        </div>

		<div style="clear: both"></div>
        <?php
        $i = 0;
        if(count($petitions) == 0)
            echo '<div class="alert alert-block alert-error fade in" id="popup"><h4 class="alert-heading">Căutarea nu a returnat niciun rezultat!</h4></div>';
        else 
            foreach ($petitions as $petitie) {					
				if($petitie['zile'] > 2){
					$zile =  '<i class="icon-time icon-white"></i>Timp rămas: '.$petitie['zile']. ' zile';
				}else if($petitie['zile'] == 2){
					$zile = '<i class="icon-time icon-white"></i>Timp rămas: două zile';
				}else if($petitie['zile'] == 1){
					$zile = '<i class="icon-time icon-white"></i>Timp rămas: o zi';
				}else{
					$zile = '';
				}				
                 echo '<div class="petitionContainerSigned">
                        <div class="petitionContainerSignedText">
                            <a href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.character_limiter($petitie['titlu'],80).'</h5></a>
                        </div>';
                        if($admin == true){
							echo '<div class="petitionContainerSignatures"><div style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-pencil icon-white"></i> Semnături strânse: '.number_format(intval($petitie['voturi']), 0, '.', '.').'</div> <div align="center" style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-calendar icon-white"></i> Data depunerii: '. date('d.m.Y', strtotime($petitie['data'])) .'</div> <div style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;">Autor: '.'<a href="'.base_url().'panou_admin/user/'.$petitie['initiator'].'">'. $petitie['author'] .'</a></div>';
						}else{ 
							echo '<div class="petitionContainerSignatures"><div align="center" style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-pencil icon-white"></i> Semnături strânse: '.number_format(intval($petitie['voturi']), 0, '.', '.').'</div> <div align="center" style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-calendar icon-white"></i> Data depunerii: '. date('d.m.Y', strtotime($petitie['data'])) .'</div> <div align="center" style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;">'.$zile.'</div>';
						}
                echo '</div></div>';
            }

            echo $this->pagination->create_links();
        ?>

    </div>



<script type="text/javascript">
        $('#search-form').submit(function(e) {
            if (!$('#searched').val()) {
                e.preventDefault();
            }       
        });

    $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
        e.stopPropagation();
    });
</script>

