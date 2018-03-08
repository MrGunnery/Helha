<!DOCTYPE html>
<html>
<head>
	<title>ex6.5</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		for ($i=0; $i < 5 ; $i++) { 
			# code...
			$tab[$i]=$i+1;
		}
		$somme= array_sum($tab);
		// foreach ($tab as $value) {
		// 	# code...
		// 	$somme +=$value;
		// }
	 ?>
	 <p style="font-size: 20px">
	 	<?php echo("la somme du tableau est de: ".$somme) ?>
	 </p>
</body>
</html>