<!DOCTYPE html>
<html>
<head>
	<title>Ex 4.4</title>
	<meta charset="utf-8">
</head>
<body align="center">
	<h1>Ex 4.4</h1>
	<form action="ex4.4.php" method="post">
		<label for="nbr1">Introduire le premier nombre</label>
		<input type="number" name="nbr1"><br>
		<label for="signe">Quel est le signe</label>
		<input type="text" name="signe"><br>
		<label for="nbr2">Introduire le dexieme nombre</label>
		<input type="number" name="nbr2"><br>
		<input type="submit"><br>
		<?php 
			if (isset($_POST['nbr1'])and isset($_POST['signe'])and isset($_POST['nbr2']) ) {
				# code...
				$nbr1 = $_POST['nbr1'];
				$nbr2 = $_POST['nbr2'];
				$signe = $_POST['signe'];

				switch ($signe) {
					case '+':
						# code...
					    echo $nbr1+$nbr2;
						break;
					case '-':
						# code...
						echo $nbr1-$nbr2;
						break;
					case '*':
						# code...
						echo $nbr1*$nbr2;
						break;
					case '/':
						# code...
						if ($nbr2 == 0) {
							# code...
							echo "Impossible de diviser par 0";
						}
						else{
							echo $nbr1/$nbr2;
						}
						break;
					default:
						echo "Vous n'avez pas fait un choix correct";
						break;
				}
			}
		 ?>
	</form>
</body>
</html>