<?php
$nr_petitii = count($rezultate);
echo '<div class="row-fluid">
    <!-- <div align="center" class="well">
        <button class="btn btn-default btn-primary" type="button">Listă petiţii</button>
        <button class="btn btn-default btn-primary" type="button">Creează o petiţie</button>
    </div> -->

        <div class="span8" style="padding-left:10%">
            <h2>Rezultate căutare</h2>';
echo		'
			<div class="row-fluid">
				<div class="span12">
					<div class="pagination pagination-large">
						<ul>
							<li id="btn_pg_1" class="active" style="cursor: pointer;"><a onclick="show_rez_1();">1</a></li>';
							if ($nr_petitii/10>1)
							{
								for ($j=2; $j<=$nr_petitii/10; $j++)
								{
									echo '
									<li id="btn_pg_'.$j.'" style="cursor: pointer;"><a onclick="show_rez_'.$j.'();">'.$j.'</a></li>';
								}
								echo '
								<li id="btn_pg_'.$j.'" style="cursor: pointer;"><a onclick="show_rez_'.$j.'();">'.$j.'</a></li>';
							}
							echo '
						</ul>
					</div>
				</div>
			</div>';

			echo '
			<div id="lista_rez_1" style="display: block;" class="row show-grid">';
			for ($j=1; $j<=10; $j++)
			{
				echo '
				<div class="well">Titlu de titlu<br>Numar semnaturi: 123</div>				';
			}
			echo '
			</div>';
			if ($nr_petitii/10>1)
			{
				for ($i=2; $i<=$nr_petitii/10; $i++)
				{
					echo '
					<div id="lista_rez_'.$i.'" style="display: none;" class="row show-grid">';
					for ($j=1; $j<=10; $j++)
					{
						echo '
						<div class="well">Titlu de titlu<br>Numar semnaturi: 123</div>';
					}
					echo '
					</div>';
				}
				echo '
				<div id="lista_rez_'.$i++.'" style="display: none;" class="row show-grid">';
				for ($j=1; $j<=$nr_petitii%10; $j++)
				{
					echo '
					<div class="well">Titlu de titlu '.$j.'<br>Numar semnaturi: 123</div>';
				}
			}
			echo '
			</div>';
echo		'
			<div class="row-fluid">
				<div class="span12">
					<div class="pagination pagination-large">
						<ul>
							<li id="btn_pg_1" class="active" style="cursor: pointer;"><a onclick="show_rez_1();">1</a></li>';
							if ($nr_petitii/10>1)
							{
								for ($j=2; $j<=$nr_petitii/10; $j++)
								{
									echo '
									<li id="btn_pg_'.$j.'" style="cursor: pointer;"><a onclick="show_rez_'.$j.'();">'.$j.'</a></li>';
								}
								echo '
								<li id="btn_pg_'.$j.'" style="cursor: pointer;"><a onclick="show_rez_'.$j.'();">'.$j.'</a></li>';
							}
							echo '
						</ul>
					</div>
				</div>
			</div>
        </div>';
		
echo	'
		<script>
			function hideall()
			{';
			for ($i=1; $i<=$nr_petitii/10+1; $i++)
			{
				echo '
				document.getElementById("lista_rez_'.$i.'").style.display = "none";';
			}
			echo '
			}
			function eraseclass()
			{';
			for ($i=1; $i<=$nr_petitii/10+1; $i++)
			{
				echo '
				document.getElementById("btn_pg_'.$i.'").setAttribute("class", "");';
			}
			echo '
			}';
			for ($i=1; $i<=$nr_petitii/10+1; $i++)
			{
				echo '
				function show_rez_'.$i.'()
				{
					hideall();
					document.getElementById("lista_rez_'.$i.'").style.display = "block";
					eraseclass();
					document.getElementById("btn_pg_'.$i.'").setAttribute("class", "active");
				}';
			}
echo	'
</script>
        <li class="span3" style="margin-top:10px;">
            <div class="thumbnail">
                <img alt="300x200" style="width: 300px; height: 200px;" src="'.base_url().'img/dreapta_gov.jpg">
                <div class="caption">
                    <h3>Nu găsiţi petiţia ?</h3>
                    <p>O puteţi creea dumneavoastră, în numai câteva minute, iar aceasta va fi publicată pe site şi va putea fi văzută de guvernanţi</p>
                    <p><a href="<?php echo base_url(); ?>petitie_noua" class="btn btn-primary">Creează petiţia</a> <a href="#" class="btn">Listă petiţii</a></p>
                </div>
            </div>
        </li>
    </div>
</div>';
?>