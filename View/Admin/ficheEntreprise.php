<main>
  <section>
    <h1>Fiche client</h1>
      <p>Société: <?= $entreprise['nom_societe'] ?></p>
      <p>SIREN: <?= $entreprise['num_siren'] ?></p>
      <p>email: <?= $entreprise['email'] ?></p>
      <p>Adresse: <?= $entreprise['adresse'] ?></p>
      <p>Code postal: <?= $entreprise['code postal'] ?></p>
      <p>Tel: <?= $entreprise['telephone'] ?></p>
      <p>Indice de confiance: <?= $entreprise['indice_confiance'] ?></p>
      <p>Nombre de contrats: <?= $entreprise['nb_contrats'] ?></p>
      <p>Argent réglé: <?= $entreprise['argent_regle'] ?></p>
      <p>Argent dû: <?= $entreprise['argent_du'] ?></p>
      <p>Montant total: <?= $entreprise['argent_total'] ?></p>
    </section>
</main>
