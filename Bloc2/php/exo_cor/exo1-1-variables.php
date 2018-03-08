<?php 
// declaration
$a = 5;
$b = 7;

// affichage
echo "A = $a <br>";
echo "B = ". $b."<br>";

// inversion 
// $a = $a+$b;
// $b = $a-$b;
// $a = $a - $b;

$temp = $a;
$a = $b;
$b = $temp;

// affichage
echo "A = $a <br>";
echo "B = ". $b."<br>";

 ?>