<!DOCTYPE html>
<html>
<head>
	<title>ex5.3</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$i=0;
		do {
			# code...
	?>
	<p style="font-size: 20px">
		<?php 
			echo ($i."x2=".($i*2));
		 ?>
	</p>
	<?php 
		$i+=1;
		} while ( $i<= 10);
	 ?>
		
</body>
</html>