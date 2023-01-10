<div id="response-post" class="card"></div>
<h2>Liste des articles</h2>
<!--<p class="message"><blockquote style="display: none">Votre article a été supprimé avec succès</blockquote></p>-->
    <?php foreach($posts as $post) : ?>
    <div class="row" id="article_<?= $post->getId(); ?>">
        <div class="col s12 m12 l12">
            <p>Titre : <strong><?= $post->getTitle(); ?></strong> | Publication : <?= ($post->getPosted(0)) ? "<i class='material-icons green-text'>lock_open</i>" : "<i class='material-icons red-text'>lock</i>" ?>
                | Auteur : <strong><?= $post->getAdmin()->getName(); ?></strong> | <i class='material-icons green-text'>access_time</i> : <strong><?= date("d/m/Y à H:i", strtotime($post->getDatePost())); ?></strong></p>
            <div class="row">
                <div>
                    <div class="col s12 m6 l6 ">
                        <?= substr(html_entity_decode($post->getContent(), ENT_HTML5 , 'UTF-8'), 0, 250); ?>...
                    </div>
                    <div>
                        <div class="col s12 m6 l3">
                            <img src="content/img/posts/<?= $post->getImage(); ?>" class="materialboxed responsive-img" alt="<?= $post->getTitle(); ?>"/>
                            <br /><br />
                        </div>
                    </div>
                    <div>
                        <div class="col s12 m6 l3">
                            <a href="index.php?controller=admin&page=post&id=<?= $post->getId(); ?>" class="btn waves-effect waves-light"><i class="material-icons">create</i></a>
                            <a href="#delete_<?= $post->getId(); ?>" class="btn waves-effect waves-light red modal-trigger delete-post"><i class="material-icons">delete</i></a>
                        <div class="modal" id="delete_<?= $post->getId(); ?>">
                            <div class="modal-content" >
                                <h5>Etes-vous sûr de vouloir supprimer cet article ?</h5>
                                <h4><?= $post->getTitle(); ?></h4>
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <a href="#" id="<?= $post->getId(); ?>" class="modal-action modal-close waves-effect waves-green btn-flat delete-post-confirm"><i class="material-icons ">delete</i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div><hr>
        </div>
    </div>
    <?php endforeach; ?>

