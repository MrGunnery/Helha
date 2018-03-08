<?php 
$a = 3;
$b = 9;
$c = false;
$d = !($c);
$e = 9;

$ex1 = $a > 8;
$ex2 = $b == 9;
$ex3 = !($a != 3);
$ex4 = !($c);
$ex5 = ($a < $b) || $c;
$ex6 = (($a + $b) != 12);
$ex7 = (($b == 5) || (($e > 10) && ($a < 8)));
$ex8 = ((($b == 5) || (($e > 10) && ($a < 8))) || ($a < $b) || $c) && $c;
$ex11 = $a != 3;
$ex12 = !($d) || $c;
$ex13 = (($a + $b) == 12) && $d;

var_dump($ex1);
var_dump($ex2);
var_dump($ex3);
var_dump($ex4);
var_dump($ex5);
var_dump($ex6);
var_dump($ex7);
var_dump($ex11);
var_dump($ex12);
var_dump($ex13);

debug_zval_dump($ex1);

echo "Calcul 1 = ". (boolval($ex1)? 'Vrai' : 'Faux'). "<br>";

var_export($ex1);
print_r($ex2);

 ?>