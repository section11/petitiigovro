<table>
<tr><td>Mesaj<td>Administrator<td>Data
<?php
	foreach($mesaje->result() as $row){
		echo '<tr>';
		echo '<td>';
		echo $row->mesaj;
		echo '<td>';
		echo $row->nume_admin;
		echo '<td>';		
		echo $row->data;
	}
?>
</table>