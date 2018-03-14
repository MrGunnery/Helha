<h1>Connexion</h1>

<form action="index.php" method="post">
	<label for="nom">Nom :</label>
	<input type="text" name="nom">
	<input type="submit" value="Connexion">
</form>

<?php 

if (!isset($_SESSION["count"])) 
{
	$_SESSION["count"] = 1;
}
else
{
	echo "<p>Veuillez vous connecter</p>";
}


 ?>