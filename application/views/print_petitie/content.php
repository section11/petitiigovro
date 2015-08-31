<?php

$titlu=$rezultate['titlu'];
$categ=$rezultate['categorie'];
$data=$rezultate['data'][8].$rezultate['data'][9].".".$rezultate['data'][5].$rezultate['data'][6].".".$rezultate['data'][0].$rezultate['data'][1].$rezultate['data'][2].$rezultate['data'][3];
$nume_init=$autor;
$email=$mailtel['email'];
$telefon=$mailtel['telefon'];
$nr_sem=$rezultate['voturi'];
$text=$rezultate['descriere'];


$html = "<html><head>
<style>
h1 {
font-size: 18px;
font-weight:bold;
position:absolute;
padding: -8px 0 0 50px;
font-family: 'Segoe UI', Tahoma, sans-serif;
}

h2 {
font-size: 18px;
font-weight:bold;
padding: -45px 0 0 50px;
font-family: 'Segoe UI', Tahoma, sans-serif;
}

h3 {
font-size: 28px;
font-family: 'Segoe UI', Tahoma, sans-serif;
text-align:center;
font-weight:bold;
}

h4 {
position:absolute;
font-size: 18px;
font-family: 'Segoe UI', Tahoma, sans-serif;
text-align:center;
font-weight:bold;
width:300px;
left:50%;
margin-left:-110px;
bottom:10px;
}

.camp1 {
font-family:'Arial';
font-size:14px;
font-weight:bold;
}

.camp2 {
font-family:'Arial';
font-size:14px;
}
</style>
</head>
<body>
<img style='left: 0; position: absolute; top: 0;' src='".base_url()."img/logo.png' />
<h1>GUVERNUL ROMÂNIEI</h1>
<br>
<h2>PETITII.GOV.RO</h2>
<br>
<h3>PETIŢIE</h3>
<br><br>
<span class='camp1'>Titlu: </span><span class='camp2'>".$titlu."</span><br><div style='height:3px;'/>
<span class='camp1'>Categorie: </span><span class='camp2'>".$categ."</span><br><div style='height:3px;'/>
<span class='camp1'>Număr semnaturi: </span><span class='camp2'>".$nr_sem."</span><br><div style='height:3px;'/>
<span class='camp1'>Inițiator: </span><span class='camp2'>".$nume_init."</span><br><div style='height:3px;'/>
<span class='camp1'>Dată inițiere: </span><span class='camp2'>".$data."</span><br><div style='height:3px;'/>
<span class='camp1'>Telefon inițiator: </span><span class='camp2'>".$telefon."</span><br><div style='height:3px;'/>
<span class='camp1'>E-mail inițiator: </span><span class='camp2'>".$email."</span><br><div style='height:3px;'/>
<span class='camp1'>Text petiție: </span><br><div style='height:3px;'/><span class='camp2' style='padding-left:20px'>".$text."</span>
<h4>PETITII.GOV.RO</h4>
</body></html>";

$html2 = "<h1 style='padding:0px;'>Semnături</h1><br><br><br><table style='width:100%;'>";
$par=0;
foreach($semnaturi as $semnatar)
{
	$par++;
	if ($par%2==1)
	{
		$html2.="<tr><td>".$semnatar['nume']." ";
		$html2.=$semnatar['prenume']."</td>";
	}
	else
	{
		$html2.="<td>".$semnatar['nume']." ";
		$html2.=$semnatar['prenume']."</td></tr>";
	}
}
$html2.="</table>";

$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHTML($html2);
//$mpdf->Output();
$mpdf->Output('petitie_'.date("d.m.Y").'.pdf', 'F');
$this->printmail_model->trimitepdf('online@gov.ro');
unlink('petitie_'.date("d.m.Y").'.pdf');
redirect('prima_pagina');
?>