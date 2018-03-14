<?php
// connexion avec la base de données avec PDO
$basededonnees = "mysql:host=localhost;dbname=martin";
$utilisateur = "root";
$motdepasse = "";
$pdo = new PDO($basededonnees, $utilisateur, $motdepasse);
// sélection des données
$requete = "SELECT nom_mois FROM mois_année ";
$mois = $pdo->query($requete);
$i =0;
foreach ($mois as $value) {
	# code...
	$m[$i]= $value['nom_mois'];
	$i++;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>projet2</title>
	<meta charset="utf-8">
</head>
<body>
	<table>
		<thead>
			<tr>
				<td>Mois de l'année</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($m as $value) { ?>
				<tr>
					<td><?php echo($value) ?></td>
				</tr>
				<?php } ?>
		</tbody>
	</table>
</body>
</html>