<h4>Espace profil</h4>
<form method="post">
    <div class="row">
        <div class="col m6 s12">
            <span>Bonjour <strong><?= $profil->getName(); ?></strong></span>
            <div class="input-field col s12">
                <table class="responsive-table striped">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Rôle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $profil->getEmail(); ?></td>
                        <td><?= $profil->getRole(); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col m6 s12">
            <h5>Changer votre mot de passe</h5>
            <div class="input-field col s12">
                <input type="password" name="password" id="password" />
                <label for="password">Votre nouveau mot de passe</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="password_confirm" id="assword_confirm" />
                <label for="password_confirm">Confirmer votre mot de passe</label>
            </div>
            <div class="col s12">
                <button type="submit" name="submit" class="btn">Modifier</button>
            </div>
        </div>
    </div>
</form>