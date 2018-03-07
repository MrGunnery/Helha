<!DOCTYPE html>
<html>
<head>
	<title>ex4.2</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="ex4.2.php" method="post">
		<p>Pret?</p>
		<input type="radio" name="Pret" value="oui">
		<label for="oui">Oui</label>
		<input type="radio" name="Pret" value="non">
		<label for="non">Non</label><br>
		<input type="submit">

		<?php 
		if (isset($_POST["Pret"])) {
			# code...
			$pret = $_POST["Pret"];
			$nbrBalle = 10;
			if ($pret=='oui' and $nbrBalle !=0) {
				# code...
				echo"<p class='vert'>Lance une balle</p>";
			}
			elseif ($pret == 'non'){
				# code...
				echo"<p class='rouge'>Vous n'ete pas pret</p>";
			}
		}
		?>
	</form>

</body>
</html>