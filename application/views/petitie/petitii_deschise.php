<?php
$i = 0;
/*echo '<div class="row-fluid">';
echo '<div class="span8" style="padding-left:10%">
        <div class="page-header">
                <h3>Categorii</h3>
        </div>
        <div class="row-fluid show-grid">';
foreach ($categories as $categorie) {
    echo '<a href="'.base_url().'lista_petitii/categorie/'.$categorie['categorie_n'].'">'.$categorie['categorie_m'].'</a>';
}
echo '</div>';*/
?>
<?php
		$i = 0;
if(count($petitions) == 0)
	echo 'Nicio petiție nu a fost gasită';
else 
foreach ($petitions as $petitie) {
echo '<div class="petitionContainerSigned">
        <div class="petitionContainerSignedText">
            <p style="font-weight: bold;font-size: 13px;">'.$authors[$i++].'</p>
            <a href="'.base_url().'search/view_petitie/'.$petitie["id"].'"><h5>'.$petitie['titlu'].'</h5></a>
        </div>
            <div class="petitionContainerSignatures">'.number_format(intval($petitie['voturi']), 0, '.', '.').' ';
        if($petitie['voturi']==1)
            echo 'semnătură</div>'; 
        else 
            echo 'semnături</div>';
        echo '</div>';
}
echo $this->pagination->create_links();
?>
</div>
</div>