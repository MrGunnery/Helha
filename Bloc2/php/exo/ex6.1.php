<!DOCTYPE html>
<html>
<head>
	<title>Ex6.1</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		for ($i=0; $i < 6; $i++) { 
			# code...
			$tab[$i]= $i*2;
		}
	 ?>
	 <?php foreach ($tab as $value) {
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