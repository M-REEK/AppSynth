<?php require 'menu.php'; ?>
<main class="newConvention">
	<p>Nouvelle convention</p>
	<form method="POST" action="">
		<select name="pays" id="pays">
		<?php
 		while ($donnees = $allEntreprises->fetch())
		{?>
           <option value=" <?php echo $donnees['nom_societe']; ?>"> <?php echo $donnees['nom_societe']; ?></option>
		<?php
		}
		$allEntreprises->closeCursor();
		?>
		</select>
				<p><button >Ajouter Convention</button></p>
	</form>
</main>
