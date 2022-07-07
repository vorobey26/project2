<!DOCTYPE html>
<html>
	<head> 
		<title> ТУРФИРМА </title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/script.js"></script>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
		<script>
			$(document).ready(function() {
				$("#tag").autocomplete("autocomplete.php",
				{
					selectFirst: true
				});
			});
		</script>
	</head>
<body> 		
	<div align="center" class="d_banner">
		<!--<a href="index.html"> -->
		<img src="img/banner1.jpg" width=100% height=200px>
	</div>
	
<div align="center" class="d_menu">
		<ul class="menu">
		<li><a href="index.html">Общая информация</a></li>
		<li><a href="#">Туры</a>
			<ul class="submenu">
				<li><a href="department.php">Информация о турах</a></li>
			</ul>
		</li>
		<li><a href="#">Заказы</a>
			<ul class="submenu">
				<li><a href="category.php">Клиентская база</a></li>
				<li><a href="active.php">Информация о заказах</a></li>
				<li><a href="search_active.php">Поиск информации о заказах</a></li>
			</ul>
		</li>
		</ul>
	</div>


	<div class="d_cont">
	<h2>Поиск данных турфирмы </h2>
	<select onChange="javascript: go(this);">
		<option selected disabled>Категория поиска</option>
		<option value="1">Поиск заказов по фамилии</option>
		<option value="2">Поиск туров по направлению</option>
		<option value="3">Поиск информации о клиентах по фамилии</option>
	</select>
	
	<div id="page1" style="display: none">
		<form name="form1">
			<?php
				require_once 'login.php';
				$query = "SELECT * FROM clients";
				$sql = mysqli_query($link, $query);
				echo "<br>";
				echo "<select id='id_cli' onChange='ajaxFunction()'>\r\n";
				echo "<option selected disabled>Выберите фамилию</option>";
				while($row = mysqli_fetch_array($sql))
				{
					$id_cli = intval($row['id_cli']);
					$name_cli = htmlspecialchars($row['name_cli']);
					echo "<option value=$id_cli>$name_cli</option>\r\n";
				}
				echo "</select>\r\n";
			?>
			<div id="ajaxDiv"></div>	
		</form>
	</div>
	
	<div id="page2" style="display: none">
		<form name="form2">
			<?php
				require_once 'login.php';
				$query = "SELECT * FROM tur";
				$sql = mysqli_query($link, $query);
				echo "<br>";
				echo "<select id='id_tur' onChange='ajaxFunction1()'>\r\n";
				echo "<option selected disabled>Выберите направление</option>";
				while($row = mysqli_fetch_array($sql))
				{
					$id_tur = intval($row['id_tur']);
					$name_tur = htmlspecialchars($row['name_tur']);
					echo "<option value=$id_tur>$name_tur</option>\r\n";
				}
				echo "</select>\r\n";
			?>
			
			<div id="ajaxDiv1"></div>	
		</form>
	</div>
	
	<div id="page3" style="display: none">
		<br>
			<input name="tag" type="text" id="tag" size="20" onforminput='ajaxFunction2()'/>
			<input type="button" value="Найти" onClick='ajaxFunction2()'>
			<div id="ajaxDiv2"></div>	
		</form>
	</div>
	
	</div>
	

</body>
</html>