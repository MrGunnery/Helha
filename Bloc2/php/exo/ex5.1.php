<!DOCTYPE html>
<html>
<head>
	<title>Ex5.1</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$i=0;
		while ($i <= 10) {
			# code...
	?>
	<p style="font-size: 20px">
		<?php 
			echo ($i."x2=".($i*2));
			$i+=1;
		 ?>
	</p>
	<?php 
		}	
	 ?>
</body>
</html>


