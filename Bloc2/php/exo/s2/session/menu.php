<header>
	<?php 
		if (isset($_SESSION['nom'])) {
			# code...
			echo "<p>Bienvenu ".$_SESSION['nom']."</p>";
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
				if (isset($_SESSION['nom'])) {
					# code...
					echo '<a href="?section=connexion">Connexion</a>';
				}
				else{
					echo '<a href="?section=connexion">Connexion</a>';
				}
			 ?>
	
			</li>
	</ul>

</nav>