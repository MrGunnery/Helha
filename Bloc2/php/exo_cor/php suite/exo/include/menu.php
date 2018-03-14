<header>
	<?php 
		if (isset($_SESSION["nom"])) 
		{
			echo '<p>Bienvenue ' . $_SESSION["nom"] . '</p>';
		}

	 ?>
</header>
<nav>
	<ul>
		<li><a href="?section=accueil">Accueil</a></li>
		<li><a href="?section=apropos">A propos</a></li>
		<li><a href="?section=contact">Contact</a></li>
		<li>
			<?php 
			if (isset($_SESSION["nom"])) 
			{
				echo '<a href="?section=deconnexion">Déconnexion</a>';
			}
			else
			{
				echo '<a href="?section=connexion">Connexion</a>';
			}

			 ?>
		</li>
	</ul>
</nav>