<!DOCTYPE html>
<html>
<head>
	<title>Ex 4.3</title>
	<meta charset="utf-8">
</head>
<body align="center">
	<h1>Choix de boisson</h1>
	<form action="ex4.3.php" method="post">
		<select name="boisson">
			<option value="coca">Coca</option>
			<option value="eau">Eau</option>
		</select>
		<input type="submit" value="Choisir">
	</form>
	

	<?php 
		$nbr_coca = 10;
		$nbr_eau = 10;
		if (isset($_POST["boisson"])) {
			# code...
			$choix = $_POST["boisson"];
			
			switch ($choix) {
				case 'coca':
					# code...
					if ($nbr_coca!=0) {
						# code...
						echo '<img src="https://www.bretzelburgard.fr/snacking/649-large_default/coca-33cl.jpg">';
						$nbr_coca = $nbr_coca-1;
					}
					else{
						echo "il n'y a plus de coca";
					}
					break;
				case 'eau':
					# code...
					if ($nbr_eau!=0) {
						# code...
						echo '<img src="data:image/jpeg;base64,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">';
						$nbr_eau=$nbr_eau-1;
					}
					else{
						echo "il n'y a plus d'eau";
					}
					break;
				default:
					# code...
					echo "Avez vous fait un choix?";
					break;
			}
		}
	 ?>
</body>
</html>