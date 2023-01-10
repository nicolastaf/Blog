<h2>Paramètres</h2>
<div class="row">
    <div class="col m6 s12">
        <h4>Modérateurs</h4>
        <table class="highlight">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Validé</th>
                    <th>Editer</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
              <tr>
                 <td><?= $user->getName(); ?></td>
                 <td><?= $user->getEmail(); ?></td>
                 <td><?= $user->getRole(); ?></td>
                 <td><i class="material-icons"><?php echo (!empty($user->getPassword())) ? "verified_user" : "av_timer" ?></i></td>
                 <td><i class="material-icons green-text"><a class="green-text" href="index.php?controller=admin&page=users&id=<?= $user->getId(); ?>">edit</a></i></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col m6 s12">
        <h4>Ajouter un modérateur</h4>
        <form method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="name" id="name" />
                    <label for="name">Nom</label>
                </div>
                <div class="input-field col s12">
                    <input type="email" name="email" id="email" />
                    <label for="email">Adresse e-mail</label>
                </div>
                <div class="input-field col s12">
                    <input type="email" name="email_again" id="email_again" />
                    <label for="email_again">Confirmer votre e-mail</label>
                </div>
                <div class="input-field col s12">
                    <select name="role" id="role">
                        <option value="modo">Modérateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                    <label for="role">Rôle</label>
                </div>
                <div class="col s12">
                    <button type="submit" name="submit" class="btn">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>