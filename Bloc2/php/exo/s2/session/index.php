<?php 
session_start();
include("header.php");
include("menu.php");
// echo "<p>Bonjour</p>";

if (isset($_GET['section'])) {
	# code...
	switch ($_GET['section']) {
		case 'accueil':
			# code...
			include 'accueil.php';
			break;
		case 'apropos':
			# code...
			include 'apropos.php';
			break;
		case 'contact':
			# code...
			include 'contact.php';
			break;
		case 'connexion':
			# code...
			include 'connexion.php';
			break;
		case 'deconnexion':
			# code...
			include 'deconnexion.php';
			break;
		default:
			# code...
			include 'notfund.php';
			break;
	}
}

elseif (isset($_POST['nom']) and $_POST['nom'] != "") {
	# code...
	$_SESSION['nom'] = $_POST['nom'];
	header('Location:index.php');
}

elseif (isset($_POST['nom']) and $_POST['nom'] == "") {
	# code...
	$_SESSION['nom'] = $_POST['nom'];
	header('Location:index.php?section=connexion');
}
else{
	include 'accueil.php';
	
}

include("footer.php");
	
 ?>