<!DOCTYPE html>
<html>
<head>
	<title>ex6.3</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		for ($i=0; $i < 5 ; $i++) { 
			# code...
			$tab[$i]=$i+1;
		}
		$nbr=0;
		foreach ($tab as $value) {
			# code...
			if ($value > $nbr) {
				# code...
				$nbr = $value;
			}
		}
	 ?>
	 <p style="font-size: 20px">
	 	<?php 
	 		echo ("le nombre le plus grand est : ".$nbr);
	 	 ?>
	 </p>
</body>
</html>