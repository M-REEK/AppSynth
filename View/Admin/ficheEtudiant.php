
<main>
  <section>
    <h1>Fiche etudiant de  <span><?= $etudiant['prenom'] ?> <?= $etudiant['nom'] ?></span> </h1>
      <p>n°etudant: <?= $etudiant['login'] ?></p>
      <p>Date de naissance <?= $etudiant['dateDeNaissance'] ?></p>
      <p>Adresse: <?= $etudiant['adresse'] ?>, <?= $etudiant['code_postal'] ?></p>
      <p>Portable: <?= $etudiant['telephone_portable'] ?></p>
      <p>Mail: <?= $etudiant['email'] ?></p>
    </section>
</main>
