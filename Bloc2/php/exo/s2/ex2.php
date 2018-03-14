<!DOCTYPE html>
<html>
<head>
	<title>ex2</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		$tableau  = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	 ?>
	<form action="ex2.php" method="post">
		
		<input type="number" name="nbr" value="<?php if (isset($_POST['nbr'])){echo $_POST['nbr'];} ?>">
		<input type="submit">
		<?php 
			if (isset($_POST['nbr'])) {
				# code...
				$nbr = $_POST['nbr'];
				if (trouve($tableau, $nbr) == 1 ) {
					# code...
					echo("le nombre ". $nbr. " a été trouvé");
				}
				else{
					echo("le nombre ". $nbr. " n'a pas été trouvé");
				}
		 } ?>
	</form>
</body>
</html>

<?php 
	
	function trouve($tab, $nbrecherche){
		
		foreach ($tab as $value) {
			# code...
			if ($nbrecherche == $value) {
				# code...
				$retour = 1 ;
				break;
			}
			else{
				$retour = -1;
			}
		}
		return $retour;
	}
 ?>