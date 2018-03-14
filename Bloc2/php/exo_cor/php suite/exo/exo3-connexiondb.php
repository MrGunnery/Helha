<!DOCTYPE html>
 <html>
 	<head>
 		<title>Connexion Produits</title>
 		<meta charset="utf-8">
 		<style>
 			table, td, th {
 				border : 1px solid black;
 				border-collapse: collapse;
 			}
 		</style>
 	</head>
 	<body>
 		<?php 
// connexion
$basedonnees = "mysql:host=localhost; dbname=nom_bd";
$user = "root";
$pw = "";
$pdo = new PDO($basedonnees,$user,$pw);

// selection requete
$requete = "SELECT description, marque, pu FROM produits";

//affichage
$produits = $pdo->query($requete);
echo "<table><tr><th>Description</th><th>Marque</th><th>Prix unitaire</th></tr>";
foreach($produits as $produit)
{
	echo '<tr><td>' . $produit['description'] . '</td>';
	echo '<td>'. $produit['marque'] . '</td>';
	echo '<td>'. $produit['pu'] . '€ </td></tr>';
}
echo "</table>";
 ?>
 	</body>
 </html>

