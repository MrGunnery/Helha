<!DOCTYPE html>
<html>
<head>
	<title>ex6.2</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$tab[0]=2;
		for ($i=1; $i < 10 ; $i++) { 
			# code...
			$tab[$i]= $tab[$i-1]*2;
		}
		foreach ($tab as $value) {
			# code...
	 ?>
	 <p style="font-size: 20px">
	 	<?php 
	 		echo ($value);
	 	 ?>
	 </p>
	 <?php } ?>
</body>
</html>