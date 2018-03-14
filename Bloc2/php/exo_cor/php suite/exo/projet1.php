<!DOCTYPE html>
 <html>
 	<head>
 		<title></title>
 		<meta charset="utf-8">
 		<style>
 			table, td {
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
 		$requete = "SELECT valeur FROM tableau";
 		
 		//affichage
 		$tab = $pdo->query($requete);
 		$table = [];
 		echo "<table><tr>";
 		foreach($tab as $ligne)
 		{
 			echo '<td>' . $ligne['valeur'] . '</td>';
 			$table[] = $ligne['valeur'];
 		}
 		echo "</tr></table>";
 		
 		// var_dump($table);
 		
 		 ?>
		<form action="#" method="post">
 		 <select name="choix">
 		 	<option value="grand">Plus grand</option>
 		 	<option value="petit">Plus petit</option>
 		 	<option value="somme">Somme</option>
 		 	<option value="moyenne">Moyenne</option>
 		 </select>
 		 <input type="submit" value="Rechercher">
		</form>

		<?php 
		if (isset($_POST["choix"])) 
		{
			switch ($_POST["choix"]) 
			{
				case 'grand':
					echo max($table);
					break;
				case 'petit':
					echo min($table);
					break;
				case 'somme':
					echo array_sum($table);
					break;
				case 'moyenne':
					echo array_sum($table)/count($table);
					break;
				
				default:
					# code...
					break;
			}
		}

		 ?>
 	</body>
 </html>