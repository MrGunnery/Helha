<?php 
session_start();
include("header.php");

include("menu.php");

echo"<p>bonjou<\p>";



if(isset($GET["setion"]))
{
	switch ($_GET["section"]) {
		case 'accueil':
			include("accueil.php")
			break;
		case 'apropos':
			include("apropos.php")
		case 'contact':
			include("contact.php")
			break;
		case 'connexion':
			include ("connexion")
			break;
		case 'deconnexion':
			include ("deconnexion")
			break;
		
		
		default:
			include("notfoundt.php")
			break;
	}
}

elseif (isset($_POST["nom"] && $_POST["nom"] != "" ) {
	$_SESSION["nom"] = $_POST["nom"];

header('Location:index.php');
}
elseif (isset($_POST["nom"] && $_POST["nom"] == "" )
 {

header('Location:index.php?section=connection');
}
else
{
	include("accuiel.php");
}



include("footer.php");



 ?>