<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<style>
			table, td {
				border : 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<?php 
echo "Table de 1 à 10 : <br>";

echo "<table><tr>";
for ($nb2=1; $nb2 <=10 ; $nb2++) 
{ 
	# code...
	if ($nb2 == 6) {
		echo "</tr><tr>";
	}
	echo "<td>Table par $nb2<br>";
	for($nb1 = 1; $nb1 <= 10; $nb1++)
	{
		$result = $nb1 *$nb2;
		echo "$nb1 x $nb2 = $result<br>";
	}
	echo "</td>";
}

echo "<tr></table>";
 ?>
	</body>
</html>
