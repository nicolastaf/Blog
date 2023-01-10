    <h4>Changer le mot de passe</h4>
    <form method="post">
        <div class="row">
            <div class="col m6 s12">
                <div class="input-field col s12">
                    <table class="responsive-table striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $user->getName(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getRole(); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col m6 s12">
                <div class="input-field col s12">
                    <input type="password" name="password" id="password" />
                    <label for="password">Nouveau mot de passe</label>
                </div>
                <div class="input-field col s12">
                    <input type="password" name="password_confirm" id="assword_confirm" />
                    <label for="password_confirm">Confirmer le mot de passe</label>
                </div>
                <div class="col s12">
                    <button type="submit" name="submit" class="btn">Modifier</button>
                </div>
            </div>
        </div>
    </form>