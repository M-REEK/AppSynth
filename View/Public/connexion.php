<main>
    <div class="main-connexion">
        <form class="form-connexion" action="<?= BASE_URL . '/connexion' ?>" method="POST">
            <div>
                <label for="login">Identifiant</label>
                <span></span>
                <input type="text" id="login" name="login" required />
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <span></span>
                <input type="password" id="password" name="password" required />
            </div>
            <button type="submit">Connexion</button>
        </form>
    </div>
</main>