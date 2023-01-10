</div>
        <figure>
            <div class="parallax-container">
                <div class="parallax">
                    <img class="" src="content/img/posts/<?= $post->getImage(); ?>" alt="<?= $post->getTitle(); ?>"/>
                </div>
            </div>
        </figure>
        <div class="container">
            <div class="row">
                <div class="col l8 m6 s12">
                    <article>
                        <h2><?= $post->getTitle(); ?></h2>
                        <h5>Par <?= $post->getAdmin()->getName(); ?> le <?= date("d/m/Y à H:i:s", strtotime($post->getDatePost())); ?></h5>
                        <p><?= html_entity_decode($post->getContent(), ENT_HTML5 , 'UTF-8'); ?></p>
                        <hr>
                    </article>
                </div>
                <div class="col l4 m6 s12">
                    <div class="collection">
                        <div class="card">Chapitres :</div>
                        <?php foreach ($posts as $post): ?>
                            <a href="index.php?controller=blog&page=post&id=<?= $post->getId(); ?>" class="collection-item"><?= $post->getTitle(); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <h4>Commentaires:</h4>
            <?php
            if(!empty($comments)){
                foreach ($comments as $comment){
                    ?>
                    <blockquote>
                        <strong>Par <?= $comment->getName(); ?> le <?= date("d/m/Y", strtotime($comment->getDateComment())); ?></strong>
                        <p><?= nl2br($comment->getComment()); ?></p>
                    </blockquote>
                    <?php
                }
            }else {
                echo "Aucun commentaire n'a été publié";
            }
            ?>
            <h4>Que pensez-vous de ce chapitre ?</h4>
            <form method="post">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="name" id="name" />
                        <label for="name">Nom</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" name="email" id="email" />
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                        <label for="comment">Commentaires:</label>
                    </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn waves-effect">
                            Poster
                        </button>
                    </div>
                </div>
            </form>
