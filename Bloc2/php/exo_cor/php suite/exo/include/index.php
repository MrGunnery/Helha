<?php 
session_start();
include("header.php");

include("menu.php");

if (isset($_GET["section"])) 
{
	switch ($_GET["section"]) {
		case 'accueil':
			include("accueil.php");
			break;
		case 'apropos':
			include("apropos.php");
			break;
		case 'contact':
			include("contact.php");
			break;
		case 'connexion':
			include("connexion.php");
			break;
		case 'deconnexion':
			include("deconnexion.php");
			break;
		
		default:
			include("notfound.php");
			break;
	}
}
elseif(isset($_POST["nom"]) && $_POST["nom"] != "")
{
	$_SESSION["nom"] = $_POST["nom"];
	header('Location:index.php');
}
elseif(isset($_POST["nom"]) && $_POST["nom"] == "")
{
	header('Location:index.php?section=connexion');
}
else
{
	include("accueil.php");
}


include("footer.php");


 ?>