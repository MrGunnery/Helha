<?php 
$tab = array(1, 4, 3, 5, 2);
$max = $tab[0];
$min = $tab[0];
$somme = 0;
for ($i=0; $i < 5; $i++) { 
	if($max < $tab[$i])
	{
		$max = $tab[$i];
	}
	elseif($min > $tab[$i])
	{
		$min = $tab[$i];
	}
	$somme += $tab[$i];
}

echo "Le max est : $max <br>";
echo "Le min est : $min <br>";
echo "La somme est : $somme <br>";
echo "La moyenne est : ". $somme/5 ."<br>";

 ?>