<div id="content-wrapper" class="drop-shadow">
    <div id="content">
        <h2>Bun venit!</h2>
        <p style="text-align: justify">
        	Guvernarea eficientă nu poate fi exercitată în mod unidirecțional, fără un dialog constant între factorii de decizie – pe de o parte – și cetățeni, societatea civilă, mediul privat și toți ceilalți actori interesați – pe de altă parte. Deciziile guvernamentale trebuie luate în raport cu necesitățile reale ale cetățenilor. În vederea garantării unui exercițiu al puterii cât mai coerent, colaborarea continuă între cei guvernați și cei care guvernează este vitală.
			<br /><br />
			Această iniţiativă online facilitează participarea cetăţenilor în cadrul procesului decizional la nivelul administraţiei publice centrale, atrăgând atenția Guvernului cu privire la problemele stringente ale societății noastre.
			<br /><br />
			Atunci când o petiție întrunește numărul necesar de susținători, aceasta ajunge în atenția personalului specializat la nivelul Palatului Victoria în domeniul respectiv. În pasul următor ne angajăm să căutăm soluția optimă sau, după caz, să punem laolaltă factorii de decizie abilitați pentru a emite un punct de vedere oficial. 
			Pentru a înțelege mecanismul de funcționare al procesului de petiționare online, am redactat un <a href="<?php echo base_url(); ?>ghid">Ghid explicativ de utilizare</a>. 
			<br /><br />
			Progresul României necesită implicarea activă a cât mai multora dintre noi. Contribuie şi tu la transformarea României <a href="<?php echo base_url(); ?>petitie_noua">avansând o petiție nouă</a> sau <a href="<?php echo base_url(); ?>petitii_deschise">semnând o petiție deja deschisă</a>.
		</p>
		<h2>Petiții populare</h2>
		<div>
			<?php 
            $i = 0;
            foreach ($top_petitions as $petitie) {
                echo '<div class="petitionContainerSigned">
                        <div class="petitionContainerSignedText">
                            <a style="text-decoration:none"; href="'.base_url().'search/view_petitie/'.$petitie['id'].'"><h5>'.$petitie['titlu'].'</h5></a>
                        </div>
                        <div class="petitionContainerSignatures"><div align="center" style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-pencil icon-white"></i> Semnături strânse: '.number_format(intval($petitie['voturi']), 0, '.', '.').'</div> <div align="center"; style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-calendar icon-white"></i> Data depunerii: '. date('d.m.Y', strtotime($petitie['data'])) .'</div><div align="center"; style="width:33%;display: block;-webkit-box-flex: 1;overflow: hidden;padding: 0;position: relative;float: left;"><i class="icon-time icon-white"></i> Timp rămas: '.$petitie['zile'] . ' zile</div>';
                echo '</div></div>';
            } ?>
		</div>
    </div>


            
