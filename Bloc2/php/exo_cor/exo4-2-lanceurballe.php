<!DOCTYPE html>
<html>
	<head>
		<title>Lanceur de balles</title>
		<meta charset="utf-8">
		<style>
			.vert {
				color: green;
			}

			.rouge {
				color : red;
			}
		</style>
	</head>
	<body>
		<form action="exo4-2-lanceurballe.php" method="post">
			<p>Pret ?</p>
			<input type="radio" name="pret" value="oui">
			<label for="oui">Oui</label>
			<input type="radio" name="pret" value="non">
			<label for="non">Non</label>
			<p>PanierVide ?</p>
			<input type="radio" name="paniervide" value="oui">
			<label for="oui">Oui</label>
			<input type="radio" name="paniervide" value="non">
			<label for="non">Non</label>
			<br>
			<input type="submit" value="Lancer">
		</form>
		<?php
if (isset($_POST["pret"]) && isset($_POST["paniervide"])) 
{
 	$pret = $_POST["pret"];
	$panierVide = $_POST["paniervide"];

	if ($pret =="oui" && $panierVide == "non") 
	{
		echo "<p class='vert'>Lancer balle</p>";
	}
	else
	{
		echo "<p class='rouge'>Ne pas lancer la balle</p>";
 	}
 } 


 ?>
	</body>
</html>


