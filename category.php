<!DOCTYPE html>
<html>
	<head> <link rel="stylesheet" href="css/styles.css">
		<title> ТУРФИРМА </title>
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
		
		if ( !isset( $_GET["action"])) $_GET["action"] = "showlist";
		
		switch ( $_GET["action"])
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
			
			$query = 'SELECT * FROM clients';
			$res = mysqli_query($link, $query);
			
			echo '<div class="d_cont">';
			echo '<h2>Информация о клиентах</h2>';
			echo '<button type="button" onClick="history.back();">Назад</button><br>';
			echo '<br><table border="1">';
			echo '<tr align="center"><th>Код</th><th>ФИО</th><th>Дата рождения</th><th>Телефон</th><th>Паспортный данные</th><tr>';
			
			while ( $item = mysqli_fetch_array( $res ) )
			{
				echo '<tr align="center" class="tbl">';
				echo '<td>'.$item['id_cli'].'</td>';
				echo '<td>'.$item['name_cli'].'</td>';
				echo '<td>'.$item['dat_cli'].'</td>';
				echo '<td>'.$item['tel_cli'].'</td>';
				echo '<td>'.$item['pasp_cli'].'</td>';
				echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_cli='.$item['id_cli'].'"><img src="img/edit.png" title="Редактировать"></a></td>';
				echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_cli='.$item['id_cli'].'"><img src="img/drop.png" title="Удалить"></a></td>';
				echo '</tr>';
			}
			
			echo '<tr align="center"><td colspan=11><a href="'.$_SERVER['PHP_SELF'].'?action=addform"><button type="button">Добавить</button></a></td></tr>';
			echo '</table>';
			echo '</div>';
		}
		
		function get_add_item_form()
		{
			echo '<div class="d_cont">';
			echo '<h2>Добавить</h2>';
			echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
			echo '<button type="button" onClick="history.back();">Отменить</button><br />';
			echo '<br><table border="1">';
			echo '<tr>';
			echo '<td>ФИО</td>';
			echo '<td><input type="text" name="name_cli" value="" /></td>';
			echo '</tr>';
			echo '<td>Дата рождения</td>';
			echo '<td><input type="text" name="dat_cli" value="" /></td>';
			echo '</tr>';
			echo '<td>Телефон</td>';
			echo '<td><input type="text" name="tel_cli" value="" /></td>';
			echo '</tr>';
			echo '<td>Паспортные данные</td>';
			echo '<td><input type="text" name="pasp_cli" value="" /></td>';
			echo '</tr>';
			echo '<tr align="center">';
			echo '<td colspan="2"><input type="submit" value="Сохранить"></td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';
			echo '</div>';
		}
		
		function add_item()
		{
			global $link;
			$name_cli = mysql_escape_string( $_POST['name_cli']);
			$dat_cli = mysql_escape_string( $_POST['dat_cli']);
			$tel_cli = mysql_escape_string( $_POST['tel_cli']);
			$pasp_cli = mysql_escape_string( $_POST['pasp_cli']);
			$query = "INSERT INTO clients (name_cli,dat_cli,tel_cli,pasp_cli) VALUES ('".$name_cli."','".$dat_cli."','".$tel_cli."','".$pasp_cli."')";
			
			mysqli_query ($link, $query);
			header( 'Location:'.$_SERVER['PHP_SELF']);
			die();
		}
	
		function get_edit_item_form()
	{
	global $link;
		echo '<div class="d_cont">';
		echo '<h2>Редактировать</h2>';
		$query = 'SELECT * FROM clients WHERE id_cli='.$_GET['id_cli'];
		$res = mysqli_query($link, $query);
		$item = mysqli_fetch_array($res);
		echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_cli='.$_GET['id_cli'].'" method="POST">';
		echo '<button type="button" onClick="history.back();">Отменить</button><br/>';
		
			echo '<br><table border="1">';
			echo '<tr>';
			echo '<td>ФИО</td>';
			echo '<td><input type="text" name="name_cli" value="'.$item['name_cli'].'"></td>';
			echo '</tr>';
			echo '<td>Дата рождения</td>';
			echo '<td><input type="text" name="dat_cli" value="'.$item['dat_cli'].'"></td>';
			echo '</tr>';
			echo '<td>Телефон</td>';
			echo '<td><input type="text" name="tel_cli" value="'.$item['tel_cli'].'"></td>';
			echo '</tr>';
			echo '</tr>';
			echo '<td>Паспортные данные</td>';
			echo '<td><input type="text" name="pasp_cli" value="'.$item['pasp_cli'].'"></td>';
			echo '</tr>';
	
		echo '<tr align ="center">';
		echo '<td colspan="5"><input type="submit" value="Сохранить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
		echo '</div>';
	}

	function update_item()
	{
	global $link;
		$name_cli = mysql_escape_string( $_POST['name_cli']);
		$dat_cli = mysql_escape_string( $_POST['dat_cli']);
		$tel_cli = mysql_escape_string( $_POST['tel_cli']);
		$pasp_cli = mysql_escape_string( $_POST['pasp_cli']);

		$query = "UPDATE clients SET name_cli='".$name_cli."', dat_cli='".$dat_cli."', tel_cli='".$tel_cli."', pasp_cli='".$pasp_cli."' WHERE id_cli=".$_GET['id_cli'];
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}
	
	function delete_item() 
	{
	global $link;
		$query = "DELETE FROM clients WHERE id_cli=".$_GET['id_cli'];
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}

?>
</body>
</html>