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
        <link href="<?php echo base_url()?>css/default.css" rel="stylesheet">
        <link href="<?php echo base_url()?>css/jquery-ui/jquery-ui.css" rel="stylesheet">
        
        <link media="print" href="<?php echo base_url()?>css/bootstrap.css" rel="stylesheet">

        <script type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/md5.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/messenger.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/messenger-theme-future.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/modernizr.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>js/misc.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>js/utils.js"></script>
        <script type="text/javascript">
            $(function() {
                $( "#datepicker" ).datepicker({
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
                                <li <?php if(isset($highlight) && $highlight==2) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>petitie_noua" data-toggle="modal"><i class="icon-plus icon-white"></i> Petiție nouă</a></li>
                                <li <?php if(isset($highlight) && $highlight==3) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>petitii_deschise"><i class="icon-tasks icon-white"></i> Petiții deschise</a></li>
                                <li <?php if(isset($highlight) && $highlight==4) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>raspunsuri"><i class="icon-edit icon-white"></i> Răspunsuri</a></li>
                                <li <?php if(isset($highlight) && $highlight==5) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>ghid"><i class="icon-question-sign icon-white"></i> Ghid</a></li>
                                <li <?php if(isset($highlight) && $highlight==6) echo 'class="selectedButton"';?>><a href="<?php echo base_url();?>contact"><i class="icon-envelope icon-white"></i> Contact</a></li>
                            </ul>
                                <div class="pull-right">
                                    <ul class="nav">
                                        <li>
                                            <li class="dropdown">
                                              <a class="dropdown-toggle <?php if(isset($highlight) && $highlight==7) echo 'selectedButton';?>" data-toggle="dropdown" href="<?php echo base_url();?>profil_utilizator"><i class="icon-user icon-white"></i> <?php echo $prenume. '   '.$nume; ?></a><?php echo '<a href ="'.base_url().'profil_utilizator/mesaje">'.$mesaje.'</a>'; ?>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo base_url();?>profil_utilizator"><i class="icon-user icon-white"></i> Profilul meu</a></li>
                                                    <li><a href="<?php echo base_url();?>profil_utilizator/mesaje"><i class="icon-inbox icon-white"></i> Mesagerie</a></li>
                                                    <?php
                                                    if($admin == true){
                                                    ?>
                                                        <li><a href="<?php echo base_url();?>panou_admin"><i class="icon-wrench icon-white"></i> Administrare</a></li>
                                                    <?php 
                                                    }
                                                    ?>                                                    
                                                    <li><a href="<?php echo base_url();?>login/logout"><i class="icon-remove-circle icon-white"></i> Deconectare</a></li>
                                                </ul>
                                            </li>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="inspirational-slot">
                    <div class="inspirational-slot-text">
                        <h1 style="margin:0px;">Vocea ta în Guvernul României</h1>
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
        <div class="row-fluid">
            <div class="span12">
                <form class="modal-form form-horizontal" action="<?php echo base_url();?>login/index" method="POST">
                    <div class="control-group">
                        <div class="alert alert-block alert-error fade in" id="popup" style="display:none;">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <h4 class="alert-heading">Autentificare eșuată</h4>
                            <p>E-mail sau parolă incorecte!</p>
                        </div>
                        <div class="controls">
                            <input id="email-field" type="email" name="email" placeholder="E-mail">
                        </div>

                        <div class="controls">
                            <input id="password-field" type="password" name="password" placeholder="Parolă">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox">
                                <input id="session-remember-checkbox" type="checkbox" name="keep-session" value="true">Păstrați-mă autentificat
                            </label>
                        </div>

                        <div class="controls">
                            <input class="btn btn-primary" type="submit" value="Autentificare">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        Dacă nu aveți cont, vă puteți <a href="<?php echo base_url(); ?>register">înregistra</a>.
    </div>
</div>
