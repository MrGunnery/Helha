<!DOCTYPE html>
<html>
<head>
	<title>ex6.7</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$tab = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
		$tab_jour = array(31,28,30,31,30,31,30,31,30,31,30,31,30,31,30,31,30);
		for ($i=0; $i < 12 ; $i++) { 
			# code...
			# code...
	 ?>
	 <p style="font-size: 20px">
	 	<?php echo($tab[$i].": ". $tab_jour[$i]) ?>
	 </p>
	 <?php } ?>
</body>
</html>