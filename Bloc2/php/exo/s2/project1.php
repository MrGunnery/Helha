<?php
// connexion avec la base de données avec PDO
$basededonnees = "mysql:host=localhost;dbname=martin";
$utilisateur = "root";
$motdepasse = "";
$pdo = new PDO($basededonnees, $utilisateur, $motdepasse);
// sélection des données
$requete = "SELECT id FROM tableau ";
// affichage des données avec une nouvelle boucle « foreach »
$produits = $pdo->query($requete);
$i=0;
foreach ($produits as $value) {
	# code...
	$id[$i] = $value['id'];
	if ($id[$i] != NULL) {
		$i++;
	}
	

	// unset($tab[array_search(NULL, $tab)]);
}
$requete = "SELECT Valeur FROM tableau ";
// affichage des données avec une nouvelle boucle « foreach »
$produits = $pdo->query($requete);
$i=0;
foreach ($produits as $value) {
	# code...
	$valeur[$i] = $value['Valeur'];
	if ($valeur[$i] != NULL) {
		$i++;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Project 1</title>
	<meta charset="utf-8">
</head>
<body>
	<table style="border: 1px solid black" align="center">

		<tr>
			<?php 
			foreach ($id as $value) {
			 	# code.. ?>
			 	<td><?php echo($value) ?></td>
			 	<?php } ?>
		</tr>
		<tr>
			<?php 
			foreach ($valeur as $value) {
			 	# code... ?>
			 	<td><?php echo($value) ?></td>
			 	<?php } ?>
		</tr>
		
	</table>
	<form action="project1.php" method="post">
		<select name="liste">
			<option value="grand">Plus Grand</option>
			<option value="peti">Plus Petit</option>
			<option value="moyenne">Moyenne</option>
			<option value="somme">Somme</option>
		</select>	
		<input type="submit">
	</form>
	<?php 
		if (isset($_POST['liste'])) {
			# code...
			switch ($_POST['liste']) {
				case 'grand':
					# code...
				?> 
				<p><?php echo(max($valeur)); ?></p>
				<?php 
					break;
				case 'petit':
					# code...
				?> 
				<p><?php echo(min($valeur)); ?></p>
				<?php 
					break;
				case 'moyenne':
					# code...
				?> 
				<p><?php echo(array_sum($valeur)/count($valeur)); ?></p>
				<?php 
					break;
				case 'somme':
					# code...
				?> 
				<p><?php echo(array_sum($valeur)); ?></p>
				<?php 
				
					break;
				default:
					# code...
					break;
			}
		}
	 ?>
	

</body>
</html>