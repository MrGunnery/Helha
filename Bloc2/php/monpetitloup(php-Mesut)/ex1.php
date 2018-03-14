<!DOCTYPE html>
<html>
<head>
	<title>
		

	</title>
</head>
<body>
	<?php 
		// function carree($nbre, $exp)
		// {
		// 	return pow($nbre,$exp);
		// }

		// $nb1=2;
		// $exp=8;
		// echo $nb1 . "^" . $exp . " = " . carree($nb1,$exp);

		function rechTableau($array, $taille, $valRech)
		{
			
			if (array_search($valRech, $array) != 0)
			{
				echo "trouve <br>";
    			return array_search($valRech, $array);
			}else
			{
				return -1;
			}
		}

		$tableau = array("OSEF" , "Johnny","Quentin","Eric" );

		$result = rechTableau($tableau,3,"Johnny");
		echo $result;
	?>
</body>
</html>