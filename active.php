<!DOCTYPE html>
<html>
	<head> 
		<title> ТУРФИРМА </title>
		<link rel="stylesheet" href="css/styles.css">
		<script src="js/script.js"></script>
		<meta charset="UTF-8">
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

<?php

require_once 'login.php';

	if ( !isset($_GET["action"])) $_GET["action"] = "showlist";
	
		switch ( $_GET["action"] )
		{
				case "showlist":
					show_list($link); break;
				case "addform":
					get_add_item_form(); break;
				case "add":
					add_item(); break;
				case "editform":
					get_edit_item_form(); break;
				case "update":
					update_item(); break;
				case "delete":
					delete_item(); break;
				default:
					show_list($link);
		}
	function show_list($link)
	{
		global $link;
		
		$query = 'SELECT * FROM v_active';
		$res = mysqli_query ( $link, $query);
	
	echo '<div class="d_cont">';
	echo '<h2>Информация о заказах</h2>';
	echo '<button type = "button" onClick="history.back();">Назад</button><br>';
	echo '<br><table border="1">';
	echo '<tr align="center"><th>Код заказа</th><th>Код клиента</th><th>ФИО</th><th>Код тура</th><th>Направление тура</th><th>Дата оформления тура</th><th>Дата выезда</th>
	<th></th><th></th></tr>';
	
	while ( $item = mysqli_fetch_array( $res ) )
	{
		echo '<tr align ="center" class="tbl">'; //тут нечего менять
		echo '<td>'.$item['id_act'].'</td>';
		echo '<td>'.$item['id_cli'].'</td>';
		echo '<td>'.$item['name_cli'].'</td>';
		echo '<td>'.$item['id_tur'].'</td>';
		echo '<td>'.$item['name_tur'].'</td>';
		echo '<td>'.$item['dot_act'].'</td>';
		echo '<td>'.$item['vid_act'].'</td>';
		
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_act='.$item['id_act'].'">
		<img src="img/edit.png" title="Редактировать"></a></td>';
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_act='.$item['id_act'].'">
		<img src="img/drop.png" title="Удалить"></a></td>';
		echo '</tr>';
	}
	
	echo '<tr align="center"><td colspan = 11><a href="'.$_SERVER['PHP_SELF'].'?action=addform"><button type="button">Добавить</button></a></td></tr>';
	echo '</table>';
	echo '</div>';
}

	function get_add_item_form()
	{
		global $link;
		echo '<div class="d_cont">';
		echo '<h2>Добавить</h2>';
		echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
		echo '<button type = "button" onClick="history.back();">Отменить</button><br>';
		echo '<br><table border="1">';
		
						
		echo '<tr>';
		echo '<td>Код клиента</td>';
		echo '<td>';
		$sql1 = "SELECT * FROM clients";
	
		$res1 = mysqli_query($link, $sql1) or die("Error in $sql1 : " . mysql_error());
		
		echo '<select name="id_cli">\r\n';
		echo "<option selected disabled>Выберите клиента</option>";
		while($row = mysqli_fetch_array($res1))
		{
			$id_cli = intval($row['id_cli']);
			$name_cli = htmlspecialchars($row['name_cli']);
		echo "<option value=$id_cli>$id_cli - $name_cli</option>\r\n";
		}
		echo "</select>\r\n";
		echo '</td>';
		echo '</tr>';	

		echo '<tr>';
		echo '<td>Код тура</td>';
		echo '<td>';
		$sql2 = "SELECT * FROM tur";
	
		$res2 = mysqli_query($link, $sql2) or die("Error in $sql2 : " . mysql_error());
		
		echo '<select name="id_tur">\r\n';
		echo "<option selected disabled>Выберите тур</option>";
		while($row = mysqli_fetch_array($res2))
		{
			$id_tur = intval($row['id_tur']);
			$name_tur = htmlspecialchars($row['name_tur']);
		echo "<option value=$id_tur>$id_tur - $name_tur</option>\r\n";
		}
		echo "</select>\r\n";
		echo '</td>';
		echo '</tr>';	
	
		echo '<tr>';
		echo '<td>Дата оформления тура</td>';
		echo '<td><input type="text" name="dot_act" value="" /></td>';
		echo '<tr>';
		
		echo '<tr>';
		echo '<td>Дата выезда</td>';
		echo '<td><input type="text" name="vid_act" value="" /></td>'; 
		echo '</tr>';	
			
		echo '<tr align ="center">';
		echo '<td colspan="2"><input type="submit" value="Сохранить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
		echo '</div>';
	}

	function add_item()
	{
	global $link;
		
		$id_cli = mysql_escape_string($_POST['id_cli']);
		$id_tur = mysql_escape_string($_POST['id_tur']);
		$dot_act = mysql_escape_string($_POST['dot_act']);
		$vid_act = mysql_escape_string($_POST['vid_act']);
		
		$query = "INSERT INTO active ( id_cli, id_tur, dot_act, vid_act) VALUES ( '".$id_cli."', '".$id_tur."', '".$dot_act."', '".$vid_act."');";

		 mysqli_query($link, $query);
		 header ('Location: '.$_SERVER['PHP_SELF']);
		 die();
	}

// 5.9.3 Проверить строчки 226 и 229

	function get_edit_item_form()
	{
	global $link;
		echo '<div class="d_cont">';
		echo '<h2>Редактировать</h2>';
		$query = 'SELECT * FROM active WHERE id_act='.$_GET['id_act'];
		$res = mysqli_query($link, $query);
		$item = mysqli_fetch_array($res);
		echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_act='.$_GET['id_act'].'" method="POST">';
		echo '<button type = "button" onClick="history.back();">Отменить</button><br/>';
		
		echo '<br><table border="1">';
		
		echo '<tr>';
		echo '<td>Код клиента</td>';
		echo '<td><input type="text" name="id_cli" id="id_cli" value="'.$item['id_cli'].'" readonly></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td></td>';
		echo '<td>';
		$sql3 = "SELECT * FROM clients ";

		$res3 = mysqli_query($link, $sql3) or die ("Error in $sql3 : " . mysql_error());
		echo '<select name="sel_cli" id="sel_cli" onChange="f1()">\r\n';
		echo '<option selected disabled>Все клиенты</option>';
		while($row = mysqli_fetch_array($res3))
		{
			$id_cli = intval($row['id_cli']);
			$name_cli = htmlspecialchars($row['name_cli']);
			echo "<option value='$id_cli'>$id_cli - $name_cli</option>\r\n";
		}
		echo "</select>\r\n";
		echo '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>Код тура</td>';
		echo '<td><input type="text" name="id_tur" id="id_tur" value="'.$item['id_tur'].'" readonly></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td></td>';
		echo '<td>';
		$sql4 = "SELECT * FROM tur ";
		
		$res4 = mysqli_query($link, $sql4) or die ("Error in $sql4 : " . mysql_error());
		echo '<select name="sel_tur" id="sel_tur" onChange="f2()">\r\n';
		echo '<option selected disabled>Все туры</option>';
		while($row = mysqli_fetch_array($res4))
		{
			$id_tur = intval($row['id_tur']);
			$name_tur = htmlspecialchars($row['name_tur']);
			echo "<option value='$id_tur'>$id_tur - $name_tur</option>\r\n";
		}
		echo "</select>\r\n";
		echo '</td>';
		echo '</tr>';
					
		echo '<tr>';
		echo '<td>Дата оформления тура</td>';
		echo '<td><input type="text" name="dot_act" value="'.$item['dot_act'].'" ></td>';
		echo '</tr>';
		
		echo '<tr>';
		echo '<td>Дата выезда</td>';
		echo '<td><input type="text" name="vid_act" value="'.$item['vid_act'].'" ></td>'; 
		echo '</tr>';
				
		echo '<td colspan="5"><input type="submit" value="Сохранить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
		echo '</div>';
	}

	function update_item()
	{
	global $link;
		$id_cli = mysql_escape_string($_POST['id_cli']);
		$id_tur = mysql_escape_string($_POST['id_tur']);
		$dot_act = mysql_escape_string($_POST['dot_act']);
		$vid_act = mysql_escape_string($_POST['vid_act']);
		
		$query = "UPDATE active SET id_cli='".$id_cli."',id_tur='".$id_tur."',dot_act='".$dot_act."',vid_act='".$vid_act."' WHERE id_act=".$_GET['id_act'];
		 
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}
	
	function delete_item() 
	{
	global $link;
		$query = "DELETE FROM active WHERE id_act=".$_GET['id_act'];
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}

	






?>

</body>
</html>