<div id="content-wrapper" class="drop-shadow">
    <div id="content">
	<table>
	<tr><td>Nume<td>Prenume<td>Email<td>Id<td>Data
<?php
	$i = 0;
	foreach ($votanti as $votant) {
			echo '<tr>';
			echo '<td>';
			echo '<a href="'.base_url().'panou_admin/user/'.$votant['id_user'].'">'.$votant['nume'].'</a>';			
			echo '<td>';
			echo $votant['prenume'];
			echo '<td>';
			echo $votant['email'];
			echo '<td>';
			echo $votant['id_user'];
			echo '<td>';
			echo $votant['data'];
    } 
	?>
	</table>
	<?php
    echo $this->pagination->create_links();
    ?>
	</div>
</div>	