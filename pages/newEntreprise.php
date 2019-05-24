    <?php require 'menu.php' ?>

<main>
    <section id=new_ent>
    <h1>Nouvelle entreprise</h1>
    <div id=form>
    <form method="post" action="traitement.php">
    <p><label>Numero Entreprise</label> : <input type="text" name="numero_ent" /></p>
    <p><label>Nom entreprise</label> : <input type="text" name="nom_ent" /></p>
    <p><label>Numéro Siren</label> : <input type="text" name="numero_siren_ent" /></p>   
    <p><label>E-mail</label> : <input type="text" name="e-mail_ent" /></p>    
    <p><label>Adresse</label> : <input type="text" name="adresse_ent" /></p>
    <p><label>Code Postal</label> : <input type="text" name="CP_ent" /></p>   
    <p><label>Téléphone</label> : <input type="text" name="telephone_ent" /></p>   
    </form>
    <p><button type="button"> Valider </button>
    </div>
    </section>
</main>
