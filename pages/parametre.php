<?php require 'menu.php' ?>
<main class="parametre">
	<section>
		<h1>Parametres</h1>
		<div id="param">
			<form class="" action="index.html" method="post">
				<div class="form">
					<p><span>Identifiant : <?= $user['login'] ?></span><label>Modifier : </label><input type="text" name="modif_id"><button type="button">Valider</button></p>
				</div>
				<div class="form">
					<p><span>Mot de passe : <?= $user['mdp']?></span><label>Modifier : </label><input type="text" name="modif_mdp"><button type="button">Valider</button></p>
				</div>
				<div class="form">
					<p><span>E-mail : <?= $user['mail']?></span><label>Modifier : </label><input type="text" name="modif_mail"><button type="button">Valider</button></p>
				</div>
			</form>
		</div>
	</section>
</main>
