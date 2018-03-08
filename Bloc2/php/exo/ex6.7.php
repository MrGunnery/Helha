<!DOCTYPE html>
<html>
<head>
	<title>ex6.7</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$tab = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
		foreach ($tab as $value) {
			# code...
	 ?>
	 <p style="font-size: 20px">
	 	<?php echo($value) ?>
	 </p>
	 <?php } ?>
</body>
</html>