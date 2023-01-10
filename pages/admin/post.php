</div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="content/img/posts/<?= $post->getImage(); ?>" alt="<?= $post->getTitle(); ?>" />
        </div>
    </div>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col s12">
                    <div class="input-field file-field">
                        <div class="btn col s3">
                            <input type="file" name="image" class="col btn s3" value="<?= $post->getImage(); ?>"/>
                            <span>Modifier l'image</span>
                        </div>
                        <input type="text" class="file-path col s9" readonly />
                    </div>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="title" id="title" value="<?= $post->getTitle(); ?>"/>
                    <label for="title">Titre de l'article</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="content" name="content" class="materialize-textarea" ><?= $post->getContent(); ?></textarea>
                    <label for="content">Contenu de l'article</label>
                </div>
                <div class="col s6">
                    <p>Public</p>
                    <div class="switch">
                        <label>
                            Non
                            <input type="checkbox" name="public" <?= $post->getPosted(1) ? "checked" : "" ?> />
                            <span class="lever"></span>
                            Oui
                        </label>
                    </div>
                </div>
                <div class="col s6" right-align>
                    <br/><br>
                    <button type="submit" class="btn" name="submit">Enregistrer</button>
                </div>
            </div>
        </form>