<main>
    <section id=new_ent>
		<h1>Nouvelle entreprise</h1>
		<div id=form>
			<form method="POST" action="">
				<p><label for="nom_ent">Nom entreprise</label> : <input type="text" name="nom_ent" id="nom_ent" /></p>
				<p><label for="num_siren_ent">Numéro Siren</label> : <input type="text" name="num_siren_ent" id="num_siren_ent" /></p>   
				<p><label for="email_ent">E-mail</label> : <input type="email" name="email_ent" id="email_ent" /></p>    
				<p><label for="adresse_ent">Adresse</label> : <input type="text" name="adresse_ent" id="adresse_ent"/></p>
				<p><label for="CP_ent">Code Postal</label> : <input type="text" name="CP_ent" id="CP_ent"/></p>   
				<p><label for="telephone_ent">Téléphone</label> : <input type="tel" name="telephone_ent" id="telephone_ent" /></p>   
				<p><label for="indice_confiance">Indice de confiance</label>
				<select id="indice_confiance" name="indice_confiance[]"> 
					<option value="1">1</option>
    				<option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5">5</option>
				</select></p>
				<p><button>Ajouter Entreprise</button></p>
			</form>
		</div>
    </section>
</main>