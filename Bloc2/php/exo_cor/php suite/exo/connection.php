<h1> connexion</h1>

<form action="index.php" method="post">
	<label for="nom">nom</label>
	<input type="text " name= "name">
	<input type="submit" value="connexion">
</form>
<?php 
if (!isset($_SESSION["count"])) {
	$_SESSION["count"] = 1;
	# code...
}
else
{
	echo "<p> veuillez vous connecter <p>";
}

 ?>