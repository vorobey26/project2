<?php
	require_once 'login.php';
	$q=$_GET['q'];
	$query = "SELECT * FROM clients WHERE name_cli LIKE '%$q%'";
	$qry_result = mysqli_query($link, $query) or die(mysql_error());
	
		if (!empty($qry_result))
		{
			while($row = mysqli_fetch_array($qry_result))
			{
				echo $row['name_cli']."\n";
			}
		}
?>