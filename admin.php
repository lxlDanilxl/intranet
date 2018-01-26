<?php
	include "comun/vars.php";
	include "admin/necesario.php";
	if (get_rol_level()==3) {
		header("Refresh:0; url=http://localhost/intranet");
	}
?>
<!DOCTYPE html>
<html lang="es">
	<?php
		include ROOT."comun/head.php";
	?>
	<body>
		<?php
			include ROOT."comun/nav.php";
		?>
		<div class="container">
			<div class="row">
				<!--<div class="col-sm-2 col-xs-12"></div>-->
				<div class="col-sm-8 col-xs-12">
					<div class="Adminevento">
						<button type="submit" onclick="location.href = 'http://localhost/intranet/admin.php?f=ver_juego';" class="btn btn-primary">Ver Juegos</button>
						<button type="submit" onclick="location.href = 'http://localhost/intranet/admin.php?f=creategame';" class="btn btn-primary">Añadir Juego</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php
		include ROOT."comun/libs.php";
		if (isset($_GET['f'])) {
			$getf=$_GET['f'];
			switch ($getf) {
				case 'ver_juego':
					listgames();
				break;
				case 'creategame':
					creategame();
				break;
				case 'newgame':
					newgame();
				break;
				case 'editgame':
					editgame();
				break;
				default:
					
				break;
			}
		}
	?>
</html>