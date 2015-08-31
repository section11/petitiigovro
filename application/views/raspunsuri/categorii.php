<div id="content-wrapper" class="drop-shadow">
    <div id="content">
        <div class="petitionContainerSignedText" align="center">
             <div class="btn-group">
                <button class="btn dropdown-toggle" style="width: 355px"><b><span style="font-variant: small-caps">Răspunsuri oficiale &ndash; <?php echo $categorie2 ?></span></b></button>
            </div>      
            <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i> Căutare <span class="caret"></span></button>
                <ul class="dropdown-menu" style="background-color:#f0efef;;padding-left:5px;padding-right:5px;">
                    <div class="input-append" style="display: block;">
                        <form class="navbar-search pull-right search-area" id ="search-form" action="<?php echo base_url();?>raspunsuri/search" method = "POST">
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
                        <li style="float: left; width: 250px;"><a style="color: #346699 !important;"href="<?php echo base_url().'raspunsuri/categorie/'.$c['categorie_n']?>"><?php echo $c['categorie_m'];?></a></li>
                        <?php 
                        }
                    ?>
                </ul>
            </div>
        </div>        
        <?php
        $i = 0;
        if(count($raspunsuri) == 0)
            echo '<div class="alert alert-block alert-error fade in" id="popup"><h4 class="alert-heading">Căutarea nu a returnat niciun rezultat!</h4></div>';
        else 
           foreach ($raspunsuri as $raspuns) {
                 echo '<div class="petitionContainerSigned">
                        <div class="petitionContainerSignedText">
                            <a href="'.base_url().'raspunsuri/afisare_raspuns/'.$raspuns['id_petitie'].'"><h5>'.$raspuns['titlu'].'</h5></a>
                        </div>
                        <div class="answerContainerSignatures"><div align="center" style="width:40%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-calendar icon-white"></i> Data răspunsului: '. date('d.m.Y', strtotime($raspuns['data'])) .'</div> <div align="left" style="width:60%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-comment icon-white"></i> '. $raspuns['respondent'].'</div>';
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