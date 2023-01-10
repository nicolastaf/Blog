    <h2>Tableau de bord</h2>
    <div class="row">
        <div class="col l4 m6 s12">
            <div class="card blue white-text">
                <span class="card-title">Commentaires :</span>
                <h4><?= $count_comments[0] ?></h4>
            </div>
        </div>
        <a href="index.php?controller=admin&page=listpost">
            <div class="col l4 m6 s12">
                <div class="card blue-grey white-text">
                    <span class="card-title">Articles :</span>
                    <h4><?= $count_articles[0] ?></h4>
                </div>
            </div></a>
        <a href="index.php?controller=admin&page=settings">
            <div class="col l4 m6 s12">
                <div class="card red white-text">
                    <span class="card-title">Modérateurs :</span>
                    <h4><?= $count_users[0] ?></h4>
                </div>
            </div>
        </a>
    </div>
    <div class="col m6 s12">
         <div id="response" class="card"></div>
        <h4 id="commentaire">Commentaires non lus</h4>
        <table class="highlight">
            <thead>
                <tr>
                    <th>Articles</th>
                    <th>Commentaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($comments)){
                    foreach ($comments as $comment){
                        ?>
                            <tr id="commentaire_<?= $comment->getId(); ?>">
                                <td width="20%"><?= $comment->getPost()->getTitle(); ?></td>
                                <td width="60%"><?= substr($comment->getComment(), 0, 100); ?>...</td>
                                <td width="20%">
                                    <a href="#" id="<?= $comment->getId(); ?>" class="btn-floating btn-small waves-effect see_comment"><i class="material-icons">done</i></a>
                                    <a href="#" id="<?= $comment->getId(); ?>" class="btn-floating btn-small waves-effect red delete_comment"><i class="material-icons">delete</i></a>
                                    <a href="#comment_<?= $comment->getId(); ?>" class="btn-floating btn-small waves-effect blue modal-trigger"><i class="material-icons">more_vert</i></a>
                                    <div class="modal" id="comment_<?= $comment->getId(); ?>">
                                        <div class="modal-content" >
                                            <h4><?= $comment->getPost()->getTitle(); ?></h4>
                                            <p>Commentaire posté par <strong><?= $comment->getName()." (" .$comment->getEmail(). ")</strong><br />Le " .date("d/m/Y", strtotime($comment->getDateComment())); ?></p>
                                            <hr>
                                            <p><?= nl2br($comment->getComment()); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" id="<?= $comment->getId(); ?>" class="modal-action modal-close waves-effect waves-red btn-flat delete_comment"><i class="material-icons ">delete</i></a>
                                            <a href="#" id="<?= $comment->getId(); ?>" class="modal-action modal-close waves-effect waves-green btn-flat see_comment"><i class="material-icons ">done</i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                    }
                }else{
                    ?>
                        <tr>
                            <td></td>
                            <td style="text-align: center">Aucun commentaire à valider</td>
                        </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
