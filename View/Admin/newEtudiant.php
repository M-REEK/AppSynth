<main>
    <section id=new_etu>
		<h1>Nouvel étudiant</h1>
		<div id=form>
			<form method="POST" action="">
				<p><label>Civilite</label> :<label>Mr</label>  <input type="radio" checked name="civilite[]" value=M /><label>Mme</label>  <input type="radio" name="civilite[]" value=F /></p>
				<p><label for="nom_etu">Nom</label> : <input type="text" id="nom_etu" name="nom_etu" /></p>
				<p><label for="prenom_etu">Prenom</label> : <input type="text" id="prenom_etu" name="prenom_etu" /></p>
  				<p><label for="num_etu">Numéro Etudiant</label> : <input type="text" id="num_etu" name="num_etu" /></p>
  				<p><label for="DOB_etu">Date de naissance</label> : <input type="date" id="DOB_etu" name="DOB_etu" /></p>
				<p><label for="adresse_etu">Adresse</label> : <input type="text" id="adresse_etu" name="adresse_etu" /></p>
				<p><label for="CP_etu">Code Postal</label> : <input type="number" id="CP_etu" name="CP_etu" /></p>
				<p><label for="telephone_etu">Téléphone</label> : <input type="number" id="telephone_etu" name="telephone_etu" /></p>
				<p><label for="email_etu">E-mail</label> : <input type="email" id="email_etu" name="email_etu" /></p>
				<p><button >Ajouter Etudiant</button></p>
			</form>
		</div>
    </section>
</main>