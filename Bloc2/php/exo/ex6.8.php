<!DOCTYPE html>
<html>
<head>
	<title>ex6.8</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$tab = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
		$tab_reverse = array_reverse($tab);
		//for ($i=11; $i >=0 ; $i--) { 
		for ($i=0; $i < 12 ; $i++) { 
			# code...
	 ?>
	 <p style="font-size: 20px">
	 	<?php echo($tab_reverse[$i]) ?>
	 </p>
	 <?php } ?>
</body>
</html>