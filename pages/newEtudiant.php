<?php require 'menu.php' ?>
<main>
    <section id=new_ent>
		<h1>Nouvel étudiant</h1>
		<div id=form>
			<form method="POST" action="traitement.php">
				<p><label>Civilite</label> :<label>Mr</label>  <input type="checkbox" name="civilite_mr" /><label>Mme</label>  <input type="checkbox" name="civilite_mme" /></p>
				<p><label>Nom</label> : <input type="text" name="nom_etu" /></p>
				<p><label>Prenom</label> : <input type="text" name="prenom_etu" /></p>   
  				<p><label>Numéro Etudiant</label> : <input type="text" name="num_etu" /></p> 
				<p><label>Adresse</label> : <input type="text" name="adresse_etu" /></p>
				<p><label>Code Postal</label> : <input type="text" name="CP_etu" /></p>  
				<p><label>Téléphone</label> : <input type="text" name="telephone_ent" /></p>  
				<p><label>E-mail</label> : <input type="text" name="e-mail_etu" /></p>   
			</form>
		<p><button type="button">Valider</button></p>
		</div>
    </section>
</main>