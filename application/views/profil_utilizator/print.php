<?php
$titlu="Titlu petitie";
$categ="Categorie";
$data="Data initiere";
$nume_init="Nume";
$prenume_init="Prenume";
$email="E-mail initiator";
$telefon="0231 tel. initiator";
$text="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla id ultricies dolor. Suspendisse sed lectus sed elit semper viverra ac eu sem. Phasellus auctor quam eu turpis semper volutpat. Vestibulum facilisis sapien eget mauris elementum pellentesque sed vel ante. Integer lectus nisl, aliquam tincidunt varius eu, semper eu sem. Fusce cursus, purus et vehicula mattis, sapien augue suscipit mauris, a fringilla felis arcu et turpis. Aenean tincidunt auctor rhoncus. Sed eget aliquet massa.
<br><br>
Etiam facilisis interdum justo sed vulputate. Quisque sodales sem sit amet arcu mattis interdum. Ut posuere molestie magna, condimentum tincidunt nibh sodales et. Suspendisse mauris tortor, consequat ut lacinia et, eleifend a neque. Quisque velit elit, tincidunt eget hendrerit eu, accumsan a velit. Morbi condimentum mi vitae lectus iaculis pharetra. Vivamus a elit quis mi dapibus sollicitudin. Etiam et metus quis velit tincidunt bibendum. Donec elit neque, vestibulum sit amet suscipit non, aliquet a est. Quisque eu volutpat mi. In convallis convallis convallis.
<br><br>
Proin interdum convallis ligula, non varius nunc feugiat eu. In volutpat ipsum vel eros semper aliquam. Nunc et turpis vitae dui mattis blandit. Curabitur lobortis sem id ipsum gravida blandit. Donec commodo laoreet congue. Aliquam vitae feugiat justo. Proin eget sem enim. Pellentesque viverra arcu in sem dictum dignissim. Etiam tempor, velit et mollis rhoncus, diam eros volutpat justo, condimentum congue enim ante a turpis. Praesent vulputate lorem sit amet metus adipiscing gravida. Sed lacinia massa ut enim egestas id blandit ligula venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla odio urna, ultrices sit amet elementum non, auctor nec ante. Suspendisse potenti. Nulla congue lacus et nisi hendrerit venenatis. Fusce iaculis vulputate imperdiet.";
$nr_sem="Nr. semnaturi";

echo '<html><head><style type="text/css">

</style></head>';
echo "<body><img style='left: 0; position: absolute; top: 0;' src='http://localhost/petitii-gov-ro/img/logo.png' /><b><font style='padding: 0 0 0 50px;' face='Helvetica'>GUVERNUL ROMANIEI</font><br><font style='padding: 0 0 0 50px;' face='Helvetica'>PETITII.GOV.RO</font><br><br><br><center><font face='Helvetica' style='font-size: 28px;'>PETITIE</font></center></b><br><br><br><b><font face='Arial' style='font-size: 14px;'>Titlu: </b>".$titlu."</font><br><b><font face='Arial' style='font-size: 14px;'>Categorie: </b>".$categ."</font><br><b><font face='Arial' style='font-size: 14px;'>Data initiere: </b>".$data."</font><br><b><font face='Arial' style='font-size: 14px;'>Numar semnaturi: </b>".$nr_sem."</font><br><b><font face='Arial' style='font-size: 14px;'>Initiator: </b>".$nume_init." ".$prenume_init."</font><br><b><font face='Arial' style='font-size: 14px;'>Telefon initiator: </b>".$telefon."</font><br><b><font face='Arial' style='font-size: 14px;'>E-mail initiator: </b>".$email."</font><br><b><font face='Arial' style='font-size: 14px;'>Text: </b><br><span style='padding-left:20px'>".$text."</span></font><br></body></html>";
?>