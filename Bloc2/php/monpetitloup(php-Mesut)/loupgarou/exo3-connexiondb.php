<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<?php
		// connexion avec la base de données avec PDO
		$basededonnees = "mysql:host=localhost;dbname=nom_bd";
		$user = "root";
		$password = "";
		$pdo = new PDO($basededonnees, $user, $password);

		// sélection des données -- selection requete
		$requete = "SELECT id, nom_mois FROM mois_annee ";

		// affichage des données avec une nouvelle boucle « foreach »
		 $mois = $pdo->query($requete);
		// var_dump($produits);
		// foreach($produits as $produit)
		// {
		// 	echo $produit['description']." ";
		// 	echo $produit['marque']." ";
		// 	echo $produit['pu']." €<br>";
		// }


		$arrayMois = array();
		$i=0;
		foreach ($mois as $mois) 
		{
			$arrayMois[$i] = $mois['nom_mois'];
			$i++;
		}
	 ?>
	
	<form action="exo3-connexiondb.php" method="post">
		<input type="radio"  name="choixTri" value="chronologique"><label for="choixTri">Chronologique</label>
		<input type="radio"  name="choixTri" value="inverse"><label for="choixTri">Inverse</label>
		<input type="submit" value="Trier">
	</form>
	<table>
		<tr>
			<th>Mois</th>
		</tr>
	
		<?php 

		if (isset($_POST["choixTri"])) 
		{
			switch ($_POST["choixTri"]) {
				case 'chronologique':
					foreach ($arrayMois as $key) 
					{
						echo "<tr><td>" . $key . "</tr></td>";
					}
					break;
				case 'Inverse':
					echo "Valeur min : " . min($arrayTableau);
					break;			
				default:
					# code...
					break;
			}
		}



	 ?>
	</table>






<!-- 	</table>
	<form action="exo3-connexiondb.php" method="post">
		
		<select name="choix">
			// <option value="plusgrand" <?php 
			// 		if (isset($_POST["choix"]))
			// 		{
			// 			if ($_POST["choix"] == "plusgrand") {
			// 				echo "selected";
			// 			}
						
			// 		}
				 ?>>Plus grand</option>
			// <option value="pluspetit" <?php 
			// 		if (isset($_POST["choix"]))
			// 		{
			// 			if ($_POST["choix"] == "pluspetit") {
			// 				echo "selected";
			// 			}
						
			// 		}
				 ?>>Plus petit</option>
			<option value="somme" 
				<?php 
					// if (isset($_POST["choix"]))
					// {
					// 	if ($_POST["choix"] == "somme") {
					// 		echo "selected";
					// 	}
						
					// }
				 ?>

			 >Somme</option>
			<option value="moyenne" <?php 
					// if (isset($_POST["choix"]))
					// {
					// 	if ($_POST["choix"] == "moyenne") {
					// 		echo "selected";
					// 	}
						
					// }
				 ?>>Moyenne</option>
		</select>
		<input type="submit" value="Rechercher">
	</form> -->

	<?php 

		// if (isset($_POST["choix"])) 
		// {
		// 	switch ($_POST["choix"]) {
		// 		case 'plusgrand':
		// 			echo "Valeur max : " . max($arrayTableau);
		// 			break;
		// 		case 'pluspetit':
		// 			echo "Valeur min : " . min($arrayTableau);
		// 			break;
		// 		case 'moyenne':
		// 			echo "Moyenne : " . array_sum($arrayTableau) / count($arrayTableau);
		// 			break;
		// 		case 'somme':
		// 			echo "Somme : " . array_sum($arrayTableau);
		// 			break;
				
		// 		default:
		// 			# code...
		// 			break;
		// 	}
		// }



	 ?>

	<!-- <table>
		<tr>
			<th>Description</th>
			<th>Marque</th>
			<th>Prix unitaire</th>
		</tr>
		<?php 
			// foreach($produits as $produit)
			// {	
			// 	echo "<tr>";
			// 	echo "<td>" . $produit['description']." </td>";
			// 	echo "<td>" . $produit['marque']." </td>";
			// 	echo "<td>" . $produit['pu']." €</td>";
			// 	echo "</tr>";
			// }
		 ?>
	</table> -->



</body>
</html>