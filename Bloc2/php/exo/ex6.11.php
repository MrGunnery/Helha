<!DOCTYPE html>
<html>
<head>
	<title>ex6.11</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$septembre =array(20, 20, 20, 20, 24, 19, 18, 17, 16, 17, 17, 18, 17, 17, 14, 15, 16, 16, 16, 17, 17, 19, 17, 20, 19, 20, 21, 21, 24, 17);
	?>
	<p style="font-size: 20px">
		<?php echo("la moyenne est de: ". (array_sum($septembre)/30)."°c") ?>
	</p>
</body>
</html>