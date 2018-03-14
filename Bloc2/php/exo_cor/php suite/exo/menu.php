<header>

	<?php 
	if (isset($_SESSION["nom"])) {
		echo '<p> Bienvenue' .$_SESSION["nom"] . '</p>';
	}

	 ?>
	bonjour
</header>
<<nav>
	<ul>
			<li><a href="?section= accueil">Accueil</a></li>
			<li><a href="?section= apropos">A propos</a></li>
			<li><a href="?section= contact">Contact</a></li>
			<li>
				<?php 

				if (isset($_SESSION["nom"])) {
					echo'<a href="?section=deconnection">Déconnection</a>';
					
				}
				else
				{
					echo'<a href="?section=connection">connection</a>';

				}



				 ?>


				<a href="?section = connexion">connexion</a></li>
		</ul>	
</nav>