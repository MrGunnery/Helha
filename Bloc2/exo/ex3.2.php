<?php 
$a = 3;
$b = 9; 
$c = false; 
$d = !($c);
$e = 9;

var_export($a != 3);
echo "<br>";
var_export(!($d) || $c);
echo "<br>";
var_export((($a + $b) == 12) && $d);
 ?>