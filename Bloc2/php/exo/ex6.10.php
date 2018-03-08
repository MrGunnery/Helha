<!DOCTYPE html>
<html>
<head>
	<title>ex6.10</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	$septembre =array(20, 20, 20, 20, 24, 19, 18, 17, 16, 17, 17, 18, 17, 17, 14, 15, 16, 16, 16, 17, 17, 19, 17, 20, 19, 20, 21, 21, 24, 17);
	
	for ($i=0; $i <30 ; $i++) { 
		# code...

 ?>
 	<p style="font-size: : 20px">
 		<?php echo(($i+1)." septembre: ".$septembre[$i]."°c"); ?>
 	</p>
<?php } ?>
</body>
</html>