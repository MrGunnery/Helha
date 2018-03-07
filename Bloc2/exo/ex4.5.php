<!DOCTYPE html>
<html>
<head>
	<title>Ex 4.5 </title>
	<meta charset="utf-8">
</head>
<body align="center">
	<h1>Ex 4.5</h1>
	<form action="ex4.5.php" method="post">
		<label for="resultat">Quel est le resultat? </label>
		<input type="numbre" name="resultat"><br>
		<?php 
			if (isset($_POST['resultat'])) {
				# code...
				$resultat = $_POST['resultat'];
				if ($resultat<10) {
					# code...
					echo '<p style="color:#000000;"> I</p>';
				}
				elseif (10<=$resultat and $resultat<=12) {
					# code...
					echo '<p style="color:#154000;"> S</p>';
				}
				elseif (13<=$resultat and $resultat<=15) {
					# code...
					echo '<p style="color:#277202;"> B</p>';
				}
				elseif (16<=$resultat and $resultat<=18) {
					# code...
					echo '<p style="color:#3BAD03;"> TB</p>';
				}
				elseif (19<=$resultat and $resultat<=20) {
					# code...
					echo '<p style="color:#54FF00;font-size:36px"> Exelent</p>';
				}
				
			}
		 ?>
	</form>
</body>
</html>