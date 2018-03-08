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
$nb2 = 0;
echo "<table><tr>";

do{
	$nb1 = 1;
	$nb2++;
	if ($nb2 == 6) {
		echo "</tr><tr>";
	}
	echo "<td>Table par $nb2<br>";
	
	do{
		$result = $nb1 *$nb2;
		echo "$nb1 x $nb2 = $result<br>";
		$nb1++;
	}while ($nb1 <= 10) ;
	echo "</td>";
}while ($nb2 <= 9) ;

echo "<tr></table>";
 ?>
	</body>
</html>
