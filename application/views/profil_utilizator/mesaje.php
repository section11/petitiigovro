<div id="content-wrapper" class="drop-shadow">
    <div id="content">
    	<h2>Mesaje</h2>
    	<table class="table table-bordered">
    		<?php 
				$i = 1;
				foreach($mesaje as $mesaj){
					echo '<tr>';
					echo '<td>';
					if ($mesaj['vazuta'] == 1)
						echo '<i class="icon-ok"></i>';
					else echo '<i class="icon-envelope"></i>';
					echo '</td>';					
					echo '<td>';
					echo '<a href ="'.base_url().'/profil_utilizator/mesaj/'.$mesaj['id'].'">'.$mesaj['titlu'].'</a>';
					echo '</td>';									
					echo '</tr>';
					$i++;
				}
			?>


    	</table>

    </div>