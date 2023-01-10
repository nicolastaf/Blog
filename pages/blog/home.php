<h1>BILLET SIMPLE POUR L'ALASKA</h1>
<div class="row">
    <aside>
    <?php foreach ($posts as $post): ?>
        <div class="col l6 m6 s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="grey-text text-darken-2"><?= $post->getTitle(); ?></h5>
                    <h6 class="grey-text">Par <?= $post->getAdmin()->getName(); ?> Le <?= date("d/m/Y à H:i", strtotime($post->getDatePost())); ?> </h6>
                </div>
                <div class="card-image waves-effect waves-block waves-light">
                    <a href="index.php?controller=blog&page=post&id=<?= $post->getId(); ?>"><img src="content/img/posts/<?= $post->getImage(); ?>" alt="<?= $post->getTitle(); ?>"/></a>
                </div>
                <div class="card-content">
                    <p><?=  substr(html_entity_decode($post->getContent(), ENT_HTML5 , 'UTF-8'), 0, 150);
                        ?>...</p>
                    <p><a href="index.php?controller=blog&page=post&id=<?= $post->getId(); ?>">Lire le chapitre complet </a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </aside>
</div>
