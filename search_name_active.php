<?php
	require_once 'login.php';

	$tag = $_GET['tag'];
	$tag = mysqli_real_escape_string($link, $tag);
	$query = "SELECT * FROM clients WHERE name_cli = '$tag'";
	$qry_result = mysqli_query($link, $query) or die(mysql_error());

	echo "<br /><table border=1>";
	echo "<tr>";
	echo "<th>Код</th>";
	echo "<th>ФИО</th>";
	echo "<th>Дата рождения</th>";
	echo "<th>Телефон</th>";
	echo "<th>Пспортные данные</th>";
	echo "</tr>";
	
	while($row = mysqli_fetch_array($qry_result)) 
	{
		echo "<tr align='center'>";
		echo "<td>$row[id_cli]</td>";
		echo "<td>$row[name_cli]</td>";
		echo "<td>$row[dat_cli]</td>";
		echo "<td>$row[tel_cli]</td>";
		echo "<td>$row[pasp_cli]</td>";
		echo "</tr>";
	
	}
	
	echo "</table><br />";

?>