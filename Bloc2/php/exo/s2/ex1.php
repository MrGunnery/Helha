<!DOCTYPE html>
<html>
<head>
	<title>ex1</title>
	<meta charset="utf-8">
</head>
<body>
	
	<form action="ex1.php" method="post">
		
		<input type="number" name="nbr" value="<?php if (isset($_POST['nbr'])){echo $_POST['nbr'];} ?>">
		<input type="submit">
		<?php 
			if (isset($_POST['nbr'])) {
				# code...
				$nbr = $_POST['nbr'];
		?>
			<p>
				<?php echo ("le resultat est: ". exposant($nbr)) ; ?>
			</p>
			<?php } ?>
	</form>
</body>
</html>

<?php 

	function exposant($nbr){
	return $nbr*$nbr;
	}
	
 ?>