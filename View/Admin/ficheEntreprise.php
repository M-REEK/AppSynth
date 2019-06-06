<main>
  <section>
    <h1>Fiche etudiant</h1>
      <p>Société: <?= $ent['civilite'] ?></p>
      <p>Nom: <?= $ent['nom_societe'] ?></p>
      <p>SIREN: <?= $ent['num_siren'] ?></p>
      <p>email: <?= $ent['email'] ?></p>
      <p>Date de naissance <?= $ent['dateDeNaissance'] ?></p>
      <p>Adresse: <?= $ent['adresse'] ?></p>
      <p>Code postal: <?= $ent['code_postal'] ?></p>
      <p>Tel: <?= $ent['telephone'] ?></p>
      <p>Indice de confiance: <?= $ent['indice_confiance'] ?></p>
      <p>Nombre de contrats: <?= $ent['nb_contrats'] ?></p>
      <p>Argent réglé: <?= $ent['argent_regle'] ?></p>
      <p>Argent dû: <?= $ent['argent_du'] ?></p>
      <p>Montant total: <?= $ent['argent_total'] ?></p>
    </section>
</main>
