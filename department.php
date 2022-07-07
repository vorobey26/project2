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
			
			$query = 'SELECT * FROM tur';
			$res = mysqli_query($link, $query);
			
			echo '<div class="d_cont">';
			echo '<h2>Информация о турах</h2>';
			echo '<button type="button" onClick="history.back();">Назад</button><br>';
			echo '<br><table border="1">';
			echo '<tr align="center"><th>Код</th><th>Направление</th><th>Дни</th><th>Цена</th><tr>';
			
			while ( $item = mysqli_fetch_array( $res ) )
			{
				echo '<tr align="center" class="tbl">';
				echo '<td>'.$item['id_tur'].'</td>';
				echo '<td>'.$item['name_tur'].'</td>';
				echo '<td>'.$item['dni_tur'].'</td>';
				echo '<td>'.$item['cena_tur'].'</td>';
				echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_tur='.$item['id_tur'].'"><img src="img/edit.png" title="Редактировать"></a></td>';
				echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_tur='.$item['id_tur'].'"><img src="img/drop.png" title="Удалить"></a></td>';
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
			echo '<td>Направление</td>';
			echo '<td><input type="text" name="name_tur" value="" /></td>';
			echo '</tr>';
			echo '<td>Дни</td>';
			echo '<td><input type="text" name="dni_tur" value="" /></td>';
			echo '</tr>';
			echo '<td>Цена</td>';
			echo '<td><input type="text" name="cena_tur" value="" /></td>';
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
			$name_tur = mysql_escape_string( $_POST['name_tur']);
			$dni_tur = mysql_escape_string( $_POST['dni_tur']);
			$cena_tur = mysql_escape_string( $_POST['cena_tur']);
			$query = "INSERT INTO tur (name_tur,dni_tur,cena_tur) VALUES ('".$name_tur."','".$dni_tur."','".$cena_tur."');";
			
			mysqli_query ($link, $query);
			header( 'Location:'.$_SERVER['PHP_SELF']);
			die();
		}
	
		function get_edit_item_form()
	{
	global $link;
		echo '<div class="d_cont">';
		echo '<h2>Редактировать</h2>';
		$query = 'SELECT * FROM tur WHERE id_tur='.$_GET['id_tur'];
		$res = mysqli_query($link, $query);
		$item = mysqli_fetch_array($res);
		echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_tur='.$_GET['id_tur'].'" method="POST">';
		echo '<button type="button" onClick="history.back();">Отменить</button><br/>';
		
			echo '<br><table border="1">';
			echo '<tr>';
			echo '<td>Направление</td>';
			echo '<td><input type="text" name="name_tur" value="'.$item['name_tur'].'"></td>';
			echo '</tr>';
			echo '<td>Дни</td>';
			echo '<td><input type="text" name="dni_tur" value="'.$item['dni_tur'].'"></td>';
			echo '</tr>';
			echo '<td>Цена</td>';
			echo '<td><input type="text" name="cena_tur" value="'.$item['cena_tur'].'"></td>';
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
		$name_tur = mysql_escape_string( $_POST['name_tur']);
		$dni_tur = mysql_escape_string( $_POST['dni_tur']);
		$cena_tur = mysql_escape_string( $_POST['cena_tur']);

		$query = "UPDATE tur SET name_tur='".$name_tur."', dni_tur='".$dni_tur."', cena_tur='".$cena_tur."' WHERE id_tur=".$_GET['id_tur'];
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}
	
	function delete_item() 
	{
	global $link;
		$query = "DELETE FROM tur WHERE id_tur=".$_GET['id_tur'];
		mysqli_query($link, $query);
		header ('Location: '.$_SERVER['PHP_SELF']);
		die();
	}






?>
</body>
</html>