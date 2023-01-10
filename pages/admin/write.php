<h2>Poster un article</h2>
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title" />
            <label for="title">Titre de l'article</label>
        </div>
        <div class="input-field col s12">
            <label for="content">Contenu de l'article</label>
            <br><br>
            <textarea name="content" id="content"></textarea>
        </div>
        <div class="col s12">
            <div class="input-field file-field">
                <div class="btn col s3">
                    <input type="file" name="image" class="col btn s3" />
                    <span>Image de l'article</span>
                </div>
                <input type="text" class="file-path col s9" readonly />
            </div>
        </div>
        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public">
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>
        <div class="col s6" right-align>
            <br /><br />
            <button class="btn" type="submit" name="post">Publier</button>
        </div>
    </div>
</form>