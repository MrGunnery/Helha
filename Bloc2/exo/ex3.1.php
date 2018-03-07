

<?php 
 	$a = 3;
 	$b = 9; 
 	$c = false; 
 	$d = !($c); 
 	$e = 9;
 	var_export(($a > 8));
 	echo "<br>";
 	var_export(($b == 9));
 	echo "<br>";
 	var_export(!($a != 3));
 	echo "<br>";
 	var_export(!($c));
 	echo "<br>";
 	var_export((($a < $b) || $c));
 	echo "<br>";
 	var_export((($a + $b) != 12));
 	echo "<br>";
 	var_export((($b == 5) || (($e > 10) && ($a < 8))));
 	echo "<br>";
 	var_export((((($b == 5) || (($e > 10) && ($a < 8))) || ($a < $b) || $c) && $c));
 	
 ?>