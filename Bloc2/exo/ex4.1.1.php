<!DOCTYPE html>
<html>
<head>
	<title>Ex4.1.1</title>
	<meta charset="utf-8">
</head>
<body align="center">
	<h1>Exercice 4.1.1</h1>
	<form action="ex4.1.1.php" method="post">
		<label for="date">Date: </label>
		<input type="text" name="date">
		<input type="submit" value="Envoyé">
	</form>

	<?php 
		
		if (isset($_POST["date"]) {
			$date = $_POST["date"];
			$true = is_numeric($date);
		# code...
			if ($true) {
				# code...
				if ((($date%4==0) && ($date%100 !=0))OR $date%400 ==0 ) {
				# code...
				echo "L'année ".$date." est bissextile ";
				}
				else{
				echo "l'année ".$date." n'est pas bissextile";
				}
			}
			else{
			echo "vous n'avez pas retrer une annee";
			}
		}
	?>
</body>
</html>