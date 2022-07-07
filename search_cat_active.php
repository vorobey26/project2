<?php
	require_once 'login.php';

	$search = $_GET['search'];
	$search = mysqli_real_escape_string($link, $search);
	$query = "SELECT * FROM tur WHERE id_tur = '$search'";
	$qry_result = mysqli_query($link, $query) or die(mysql_error());

	echo "<br /><table border=1>";
	echo "<tr>";
	echo "<th>Код</th>";
	echo "<th>Направление</th>";
	echo "<th>Дни</th>";
	echo "<th>Цена</th>";
	echo "</tr>";
	

	while($row = mysqli_fetch_array($qry_result)) 
	{
		echo "<tr align='center'>";
		echo "<td>$row[id_tur]</td>";
		echo "<td>$row[name_tur]</td>";
		echo "<td>$row[dni_tur]</td>";
		echo "<td>$row[cena_tur]</td>";
		echo "</tr>";
	
	}
	
	echo "</table><br />";

?>