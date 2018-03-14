<h1>Deconnexion</h1>

<?php 
session_destroy();
unset($_SESSION[]);
header('Location:index.php');
 ?>