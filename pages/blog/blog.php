<h2>Bienvenue sur mon blog</h2>
<p>Billet simple pour l'Alaska</p>
<?php foreach($posts as $post): ?>
    <div class="row">
        <div class="col s12 m12 l12">
            <h4><?= $post->getTitle(); ?></h4>
            <div class="row">
                <div>
                    <div class="col s12 m6 l8">
                        <?= substr(html_entity_decode($post->getContent(), ENT_HTML5 , 'UTF-8'), 0, 450); ?>
                    </div>
                    <div>
                        <div class="col s12 m6 l4">
                            <img src="content/img/posts/<?= $post->getImage(); ?>" class="materialboxed responsive-img" alt="<?= $post->getTitle(); ?>"/>
                            <br /><br />
                            <a class="btn waves-effect waves-light" href="index.php?controller=blog&page=post&id=<?= $post->getId(); ?>">Lire le chapitre complet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>