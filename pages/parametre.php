<?php require 'menu.php' ?>
<main class="parametre">
	<section>
		<h1>Parametres</h1>
		<div id="param">
			<form class="" action="" method="POST">
				<div class="form">
					<p><span>Identifiant : <?= $user['login'] ?></span><label for="modif_id">Modifier : </label><input type="text" name="modif_id" id="modif_id"/><button >Valider</button></p>
				</div>
				<div class="form">
					<p><span>Mot de passe : <?= $user['mdp']?></span><label for="modif_mdp">Modifier : </label><input type="text" name="modif_mdp" id="modif_mdp"/><button>Valider</button></p>
				</div>
				<div class="form">
					<p><span>E-mail : <?= $user['mail']?></span><label for="modif_mail">Modifier : </label><input type="text" name="modif_mail" id="modif_mail"/><button>Valider</button></p>
				</div>
			</form>
		</div>
	</section>
</main>
