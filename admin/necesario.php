<?php
	include "../api/config.php";

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();
	$userid=$_SESSION['user_id'];

	function get_rol_level() {
		GLOBAL $conn, $userid;
		$qry="SELECT role FROM users WHERE id = :id";
		$result=$conn->prepare($qry);
		$result->bindParam(':id',$userid);
		$result->execute();
		$rol=$result->fetchColumn();
		if (!isset($_SESSION['user_id'])) {
			$rol=3;
		}
		return $rol;
	}
	function admingame() {
		if (get_rol_level()<3) {

		} else {
			echo "Parece que te equivocaste, pero no tienes permiso para estar aquí";
		}
	}
	function listgames() {
		GLOBAL $conn;
		$qry="SELECT * FROM games";
		$result=$conn->prepare($qry);
		$result->execute();
		echo "<table width='1000 border='1'><tr><td>ID</td><td>Título</td><td width='20%'>Descripción</td><td>Fecha</td><td>Día</td><td>Hora</td><td>Máx</td><td>Equipo mínimo</td><td>Equipo máximo</td><td>Fin registro</td><td>Seleccionar</td></tr><form>";
		while ($eventos = $result->fetch()) {
			echo "<tr><td>".$eventos[0]."</td><td>".$eventos[2]."</td><td>".$eventos[3]."</td><td>".$eventos[4]."</td><td>".$eventos[5]."</td><td>".$eventos[6]."</td><td>".$eventos[7]."</td><td>".$eventos[8]."</td><td>".$eventos[9]."</td><td>".$eventos[10]."</td><td><input type='radio' name='evento' value='".$eventos[0]."'</tr>";
		}
		echo "</table>";
	}
	function creategame() {
		GLOBAL $conn;
		$qry="SELECT MAX(ID) FROM games";
		$result=$conn->prepare($qry);
		$result->execute();
		$id=$result->fetchColumn();
		echo "<table width='1000 border='1'><tr><td>ID</td><td>Título</td><td width='20%'>Descripción</td><td>Fecha</td><td>Día</td><td>Hora</td><td>Máx</td><td>Equipo mínimo</td><td>Equipo máximo</td><td>Fin registro</td></tr>";
		echo "<form method='post' action='http://localhost/intranet/admin/necesario.php?f=newgame'><tr><td><input type='text' name='id' readonly='readonly' value='".($id+1);
		echo "'></td>
		<td><input type='text' name='a1'></td>
		<td><input type='text' name='a2'></td>
		<td><input type='datetime-local' name='a3'></td>
		<td><input type='text' name='a4'></td>
		<td><input type='time' name='a5'></td>
		<td><input type='text' name='a6'></td>
		<td><input type='text' name='a7'></td>
		<td><input type='text' name='a8'></td>
		<td><input type='datetime-local' name='a9'></td></tr>
		<button type='submit' formmethod='post' class='btn btn-primary'>Submit</button>";
	}
	function newgame() {
		if(isset($_GET['f']) AND $_GET['f']=='newgame') {
			GLOBAL $conn;
			$qry="INSERT INTO games (`id`, `title`, `description`, `date`, `day_week`, `hour`, `max`, `min_team`, `max_team`, `date_end_reg`) VALUES (':id', ':a1', ':a2', ':a3', ':a4', ':a5', ':a6', ':a7', ':a8', ':a9')";
			$result=$conn->prepare($qry);
			$result->bindParam(':id',$_POST['id']);
			$result->bindParam(':a1',$_POST['a1']);
			$result->bindParam(':a2',$_POST['a2']);
			$result->bindParam(':a3',$_POST['a3']);
			$result->bindParam(':a4',$_POST['a4']);
			$result->bindParam(':a5',$_POST['a5']);
			$result->bindParam(':a6',$_POST['a6']);
			$result->bindParam(':a7',$_POST['a7']);
			$result->bindParam(':a8',$_POST['a8']);
			$result->bindParam(':a9',$_POST['a9']);
			$result->execute();
		}
	}
?>