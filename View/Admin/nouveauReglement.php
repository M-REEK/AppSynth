<main>
    <section class="newRèglement">
		<h1>Nouveau règlement</h1>
		<div class="infoNewRèglement">
			<form method="POST" action="">
        <div>
          <div class="infoReglement">
            <p><label for="num_conv">Numero Convention</label> : <span><?= $reglement['id_convention'] ?></span></p>
    				<p><label for="nom_ent">Nom entreprise</label> :  <span><?= $client['nom_societe'] ?></span></p>
    				<p><label for="montant_total">Montant total</label> :  <span><?= $reglement['montant'] ?></span></p>
    				<p><label for="montant_restant">Montant Restant</label> :  <span><?= $reglement['montant']-$reglement['montant_regle'] ?></span></p>
          </div>
          <div class="separator">

          </div>
  				 <div class="reglement">
             <label for="type_reglement">Type de reglement:</label>
             <div class="moyenPaiement">
               <label>Cheque</label>  <input type="radio" checked name="type_reglement[]" value=Cheque />
         			 <label>Carte bancaire</label>  <input type="radio"  name="type_reglement[]" value=CarteBancaire />
               <label>Espèce</label>  <input type="radio"  name="type_reglement[]" value=Espece />
               <label>Virement</label>  <input type="radio"  name="type_reglement[]" value=Virement />
               <p><label for="numero_reglement">Numéro Cheque ou Carte bancaire</label> : <input type="text" name="numero_reglement" id="numero_reglement"/></p>
       				<p><label for="montant">Montant</label> : <input type="number" step="0.01" name="montant" id="montant" /></p>
       				<p><button >Ajouter Reglement</button></p>
            </div>
          </div>
        </div>
			</form>
		</div>
    </section>
</main>
