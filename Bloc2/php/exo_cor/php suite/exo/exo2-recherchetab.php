<?php 
// fonction de recherche
function recherchetab($array, $taille, $valeur)
{
	for ($i=0; $i < $taille; $i++) 
	{ 
		if ($array[$i] == $valeur) 
		{
			$result = $i;
		}
		elseif(!isset($result))
		{
			$result = -1;
		}
	}
	return $result;
}
$tab = array(1, 2, 3, 5);
$tai = count($tab);

echo recherchetab($tab, $tai, 0);


 ?>