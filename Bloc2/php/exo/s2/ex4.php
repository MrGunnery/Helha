<?php
// connexion avec la base de données avec PDO
$basededonnees = "mysql:host=localhost;dbname=martin";
$utilisateur = "root";
$motdepasse = "";
$pdo = new PDO($basededonnees, $utilisateur, $motdepasse);
// sélection des données
$requete = "SELECT description, marque, prix FROM produits ";
// affichage des données avec une nouvelle boucle « foreach »
$produits = $pdo->query($requete);
?>

<!DOCTYPE html>
<html>
<head>
	<title>ex4</title>
	<meta charset="utf-8">
</head>
<body>
	<table style="border: 1px solid black" align="center">
		<thead>
			<tr>
				<td style="border: 1px solid black">Description</td>
				<td style="border: 1px solid black">Marque</td>
				<td style="border: 1px solid black">Prix</td>
			</tr>
		</thead>
		<?php 
			foreach($produits as $produit)
		{
		 ?>
		<tr>
			<td style="border: 1px solid black"><?php echo $produit['description']." "; ?></td>
			<td style="border: 1px solid black"><?php echo $produit['marque']." "; ?></td>
			<td style="border: 1px solid black"><?php echo $produit['prix']." euros<br>"; ?></td>
		</tr>
		<?php } ?>


	</table>
</body>
</html>