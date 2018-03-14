<?php 
session_destroy();
unset($_SESSION["count"]);
unset($_SESSION["nom"]);
header('Location:index.php');

 ?>