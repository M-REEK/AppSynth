<main>
  <section class="ficheEntreprise">
    <h1>Fiche client de <span><?= $entreprise['nom_societe'] ?></span> </h1>
    <div class="adrEntreprise">
      <p>SIREN: <?= $entreprise['num_siren'] ?></p>
      <p>Adresse: <?= $entreprise['adresse'] ?>, <?= $entreprise['code_postal'] ?></p>
      <p>Tel: <?= $entreprise['telephone'] ?></p>
      <p>email: <?= $entreprise['email'] ?></p>
    </div>
      <p>Indice de confiance: <?= $entreprise['indice_confiance'] ?></p>
      <p>Nombre de contrats: <?= $entreprise['nb_contrats'] ?></p>
    <div class="moneyEntreprise">
      <p>Argent réglé: <?= $entreprise['argent_regle'] ?></p>
      <p>Argent dû: <?= $entreprise['argent_du'] ?></p>
    </div>
      <p>Montant total: <?= $entreprise['argent_total'] ?></p>
    
  </section>
</main>
