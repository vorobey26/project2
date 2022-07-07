<?php
	require_once 'login.php';

	$search = $_GET['search'];
	$search = mysqli_real_escape_string($link, $search);
	$query = "SELECT * FROM active WHERE id_cli = '$search'";
	$qry_result = mysqli_query($link, $query) or die(mysql_error());

	echo "<br /><table border=1>";
	echo "<tr>";
	echo "<th>Код заказа</th>";
	echo "<th>Код клиента</th>";
	echo "<th>Код тура</th>";
	echo "<th>Дата оформления тура</th>";
	echo "<th>Дата выезда</th>";
		echo "</tr>";
	
	while($row = mysqli_fetch_array($qry_result)) 
	{
		echo "<tr align='center'>";
		echo "<td>$row[id_act]</td>";
		echo "<td>$row[id_cli]</td>";
		echo "<td>$row[id_tur]</td>";
		echo "<td>$row[dot_act]</td>";
		echo "<td>$row[vid_act]</td>";
		echo "</tr>";
	
	}
	
	echo "</table><br />";

?>