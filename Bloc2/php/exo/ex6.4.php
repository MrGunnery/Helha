<!DOCTYPE html>
<html>
<head>
	<title>ex6.4</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		for ($i=0; $i < 5 ; $i++) { 
			# code...
			$tab[$i]=$i+1;
		}
		$nbr_plus=0;
		$nbr_moins=$tab[2];
		foreach ($tab as $value) {
			# code...
			if ($value > $nbr_plus) {
				# code...
				$nbr_plus = $value;
			}
			if ($value < $nbr_moins) {
				# code...
				$nbr_moins = $value;
			}
		}
	 ?>
	 <p style="font-size: 20px">
	 	<?php 
	 		echo ("le nombre le plus grand est : ".$nbr_plus."<br>");
	 		echo ("le nombre le plus petit est : ".$nbr_moins."<br>");
	 	 ?>
	 </p>
</body>
</html>