<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="exo4-1-bissextile.php" method="post">
			<label for="annee">Année : </label>
			<input type="number" name="annee">
			<input type="reset" value="Vider">
			<input type="submit" value="Tester">
		</form>
<?php 
if (isset($_POST["annee"])) 
{
	$annee = $_POST["annee"];
	if (($annee % 4 == 0) && ($annee % 100 !=0) || ($annee %400 == 0)) 
	{
		echo "$annee est bissextile";

	}
	else
	{
		echo "$annee non bissextile";
	}
}
 ?>
	</body>
</html>

