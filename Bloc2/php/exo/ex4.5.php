<!DOCTYPE html>
<html>
<head>
	<title>Ex 4.5 </title>
	<meta charset="utf-8">
</head>
<body align="center">
	<h1>Ex 4.5</h1>
	<form action="ex4.5.php" method="post" style="font-size:20px;">
		<label for="resultat">Quel est le resultat? </label>
		<input type="numbre" name="resultat" value="<?php if (isset($_POST['resultat'])){echo $_POST['resultat'];} ?>">
		<input type="submit" style="border-style: double;"><br>
		<?php 
			if (isset($_POST['resultat'])) {
				# code...
				$resultat = $_POST['resultat'];
				if (0<=$resultat and $resultat<10) {
					# code...
					echo '<p style="color:#F60000;"> I</p>';
				}
				elseif (10<=$resultat and $resultat<=12) {
					# code...
					echo '<p style="color:#F68B00;"> S</p>';
				}
				elseif (13<=$resultat and $resultat<=15) {
					# code...
					echo '<p style="color:#F6EE00;"> B</p>';
				}
				elseif (16<=$resultat and $resultat<=18) {
					# code...
					echo '<p style="color:#91F600;"> TB</p>';
				}
				elseif (19<=$resultat and $resultat<=20) {
					# code...
					echo '<p style="color:#0EF600;font-size:36px">Super</p>';
				}
				else{
					echo '<p style="color:#002EF6;font-size:36px">Entrée une nombre entre 0 et 20!!! </p>';
				}
				
			}
		 ?>
	</form>
</body>
</html>