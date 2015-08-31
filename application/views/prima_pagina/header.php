<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="petitii, petitii online, petitii guvern, guvernul romaniei, site oficial al guvernului romaniei">
        <meta name="description" content="Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României avansând o petiție nouă sau semnând o petiție deja deschisă.">
        <meta name="copyright" content="02 2013">

        <title><?php echo $title?></title>

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>img/favicon.ico" />
        <link href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/messenger.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/messenger-spinner.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/messenger-theme-air.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/jquery-ui/jquery-ui.css" rel="stylesheet">
        <link media="print" href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/default.css" rel="stylesheet">

        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/md5.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/messenger.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/messenger-theme-future.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/misc.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>js/utils.js"></script>
        <script type="text/javascript">
            $(function() {
                $( "#inputAge" ).datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
            $(function() {
                $( "#inputAge2" ).datepicker({
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script>
    </head>
    <body>
        <div class="top-bar">
            <div style="width:960px;margin:auto;">
                <a href="http://www.gov.ro/" style="color:white;" id="gov-oficial-text">
                <span class="text"> 
                    Site oficial al Guvernului României
                </span>
                <img src="<?php echo base_url()?>img/logo.png" class="logo" alt="Stema României"></a>
            </div>
        </div>
		<div id="header-image">
	        <div id="main-nav">
                <div class="logo" align="left">
                    <div style="width:960px; margin:auto;">
                        <a href="<?php echo base_url();?>">
                            <img src="<?php echo base_url();?>img/title.png"/>
                        </a>
                    </div>
	        </div>
            <div class="shadowTop">
                <div class="container" style="width:960px;">
    	            <div class="navbar">
        	            <div class="navbar-inner">
        	                <ul class="nav">
        	                    <li <?php if(isset($highlight) && $highlight==1) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>"><i class="icon-home icon-white"></i></a></li>
                                <li <?php if(isset($highlight) && $highlight==2) echo 'class="selectedButton"';?>><a href="#require-auth-modal" data-toggle="modal"><i class="icon-plus icon-white"></i> Petiție nouă</a></li>
                                <li <?php if(isset($highlight) && $highlight==3) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>petitii_deschise"><i class="icon-tasks icon-white"></i> Petiții deschise</a></li>
                                <li <?php if(isset($highlight) && $highlight==4) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>raspunsuri"><i class="icon-edit icon-white"></i> Răspunsuri</a></li>
                                <li <?php if(isset($highlight) && $highlight==5) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>ghid"><i class="icon-question-sign icon-white"></i> Ghid</a></li>
                                <li <?php if(isset($highlight) && $highlight==6) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>contact"><i class="icon-envelope icon-white"></i> Contact</a></li>
        	                </ul>
                            <div class="input-append user-slot" style="display: block;">
            	                <div class="pull-right <?php if(isset($highlight) && $highlight==7) echo 'selectedButton';?>">
            	                    <ul class="nav">
                                        <li><a href="<?php echo base_url();?>inregistrare" style="font-weight: normal;"><i class="icon-wrench icon-white"></i> Înregistrare</a></li>
                                        <li><a href="#login-modal" data-toggle="modal" id="login-box" style="font-weight: normal;"><i class="icon-user icon-white"></i> Autentificare</a></li>
                                    </ul>
            	                </div>
                            </div>
        	            </div>
                    </div>
    	        </div>
                <div class="inspirational-slot">
                    <div class="inspirational-slot-text" style="margin:0;padding-left:18px;padding-top:18px;">
                            <h1 style="margin: 0px;">Vocea ta în Guvernul României</h1>
                        <p style="line-height:1.5; text-align:justify;">
                            „Transparența și deschiderea spre partenerii sociali şi consultarea societăţii civile reprezintă constante ale actului de guvernare. Ele vor asigura o bază solidă de susţinere a iniţiativelor şi măsurilor Guvernului, întărind angajamentul acestuia pentru respectarea principiilor bunei guvernări: transparenţă, responsabilitate, participare cetăţenească”.
                        </p>
                        <p style="padding-top:0px; text-align: right;"><a style="color:white;text-decoration:none;" href="http://www.guv.ro/programul-de-guvernare-2012__l1a117011.html">Citește întreg Programul de Guvernare 2013-2016 &raquo;</a></p>
                    </div>
                    <img src="<?php echo base_url();?>img/dreapta_gov.jpg" id="titlePhoto"/>
                </div>
            </div>
        </div>
    </div>
<div id="login-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="login-modal-label">Autentificare</h3>
    </div>
    <div class="modal-body">
                <form class="modal-form form-horizontal" action="<?php echo base_url();?>login/index" method="POST">
                            <div class="alert alert-block alert-error fade in" id="popup" style="display:none;">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <?php if(isset($suspendat) && $suspendat == 0){
                                ?>
                                <h4 class="alert-heading">Autentificare eșuată</h4>
                                <p>Adresa de e-mail ori parola introduse nu corespund.</p>
                                <?php
                                }else if($suspendat == 5){
                                ?>
                                <h4 class="alert-heading">Autentificare eșuată</h4>
                                <p>Contul a fost suspendat temporar.</p>
                                <?php
                                }
                                ?>                                                  
                            </div>  
                    <div class="input-prepend" style="float:left;width:265px;border-right: 1px solid #eee;">										
                                <span class="add-on">@</span>
                                <input id="email-field" type="email" name="email" placeholder="E-mail" style="margin-bottom:10px;"><br>
                                <span class="add-on">?</span>
                                <input id="password-field" type="password" name="password" placeholder="Parolă" style="margin-bottom:10px;">
                                <label class="checkbox">
                                    <input id="session-remember-checkbox" type="checkbox" name="keep-session" value="true" style="margin-bottom:10px;">Salvează datele
                                </label>
								<input type="hidden" name="url_last"  value = "<?php echo $url_last;?>">
                                <input class="btn btn-primary" type="submit" value="Autentificare" style="float: right; margin-right: 30px;">

                    </div>
                    <div style="float:right;width:250px;height:138px;text-align:justify;">
                        <p>După autentificare, poţi adăuga petiţii noi şi le poţi semna pe cele deja deschise. <br><br> Petiţiile care ating pragul necesar de sprijin din partea comunităţii vor primi un răspuns oficial legat de iniţiativa propusă.</p>
                    </div>
                </form>
    </div>
    <div class="modal-footer">
		<div style="display:inline-block"><a href="#forgotten-pass-modal" data-dismiss="modal" data-toggle="modal">Ai uitat parola</a>?</div>
        <div style="display:inline-block;padding-left:240px">Dacă nu ai cont, te poți <a href="<?php echo base_url(); ?>inregistrare">înregistra</a>.</div>
    </div>
</div>
<div id="require-auth-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="require-auth-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="require-auth-label">Autentificare necesară</h3>
    </div>

    <div class="modal-body">
        <p>Pentru a iniția o petiție, trebuie să fiți autentificat. <a href="<?php echo base_url();?>inregistrare">Înregistrați-vă</a> sau <a href="#login-modal" data-dismiss="modal" data-toggle="modal">autentificați-vă</a>.</p>
    </div>
</div>
<div id="forgotten-pass-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="forgotten-pass-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="forgotten-pass-label">Recuperare parolă</h3>
    </div>

    <div class="modal-body">
            <div class="alert alert-block alert-error fade in" id="popup">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <h4 class="alert-heading" id = "completion-status" style = "padding-bottom:10px;"></h4>
                    <?php $erori = 0;                   
                    $ec1 = form_error('email'); 
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
                        $erori = 1;
                    }
                    $ec2 = form_error('varsta');
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
                        $erori = 1;
                    }                
                    if($erori == 1){
                        echo '<ul>';
                            if($ec1 != ''){
                                echo '<li>'. $ec1;
                            }
                            if($ec2 != ''){
                                echo '<li>'. $ec2;
                            }
                            
                        echo '</ul>';
                    }
                    ?>
                    <?php
                        if(isset($exista) && $exista != ""){
                            $erori=1;
                            echo $exista. '<br>';
                        }
                        if(isset($varsta) && $varsta != ""){
                            $erori=1;
                            echo $varsta;
                        }
                    ?>
                    <script type="text/javascript">
                        document.getElementById("completion-status").innerHTML = "Recuperarea parolei a eșuat.";
                        <?php if($erori === 0) {
                                echo "$('.alert').hide();";
                        }
                            else {
                                echo "$('.alert').show();";
                            }
                        ?>
                    </script>
                </div>
    </div>

            <div class="modal-body">
            <form action="<?php echo base_url();?>login/recuperare_parola" method="post" class="form-horizontal modal-form">                        
                    <div class="input-prepend" style="float:left;width:265px;border-right: 1px solid #eee;">
                        <span class="add-on">@</span>
                        <input style="margin-bottom:10px;" type="email" name="email" value="<?php echo set_value('email'); ?>" id="inputEmail" placeholder="E-mail" title="Completează adresa de e-mail" data-placement="right"><br>
                        <span class="add-on">?</span>
                        <input style="margin-bottom:10px;" type="text" name="varsta" value="<?php echo set_value('varsta'); ?>" id="inputAge" placeholder="Data nașterii" data-placement="right">
                        <button type="submit" class="btn btn-primary" id="trimite" style="float: right; margin-right: 30px;">Trimite</button>
                    </div>
                    <script type="text/javascript">
                        document.getElementById("completion-status").innerHTML = "Nu ați completat datele necesare.";
                        <?php if($erori === 0) {
                                echo "$('.alert').hide();";
                        }
                            else {
                                echo "$('.alert').show();";
                            }
                        ?>
                    </script>           
            </form>
        <div style="float:right;width:250px;height:138px;text-align:justify;">
                <p>Completează următoarele câmpuri pentru a puterea reseta parola aferentă contului de utilizator. Vei primi un e-mail de confirmare în acest sens.</p>
        </div>
    </div>
</div>
</div>
