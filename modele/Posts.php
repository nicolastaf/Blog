<?php

class Posts
{
    private $_id;
    private $_title;
    private $_content;
    private $_admin;
    private $_image;
    private $_date_post;
    private $_posted;

    /**
     * Article constructor.
     * @param $_title
     * @param $_content
     * @param $_write
     * @param $_image
     * @param $_date_post
     * @param $_posted
     */
    public function __construct($id, $title, $content, Admins $admin, $image, $date_post, $posted)
    {
        $this->_id = $id;
        $this->_title = $title;
        $this->_content = $content;
        $this->_admin = new Admins($admin->getId(), $admin->getName(), $admin->getEmail(),$admin->getPassword(), $admin->getCodeUser(), $admin->getRole());
        $this->_image = $image;
        $this->_date_post = $date_post;
        $this->_posted = $posted;

    }

    /**
     * Getter de l'attribut $_id
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Setter de l'attribut $_id
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * Getter de l'attribut $_title
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Setter de l'attribut $_title
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * Getter de l'attribut $_content
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Setter de l'attribut $_content
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Getter de l'attribut $_admin
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->_admin;
    }

    /**
     * Setter de l'attribut $_admin
     * @param Admins $admin
     */
    public function setAdmin(Admins $admin)
    {
        $this->_admin = $admin;
    }

    /**
     * Getter de l'attribut $_image
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * Setter de l'attribut $_image
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }

    /**
     * Getter de l'attribut $_date_post
     * @return mixed
     */
    public function getDatePost() {
        return $this->_date_post;
    }

    /**
     * Setter de l'attribut $_date_post
     * @param mixed $date_post
     */
    public function setDatePost($date_post) {
        $this->_date_post = $date_post;
    }

    /**
     * Getter de l'attribut $_posted
     * @return mixed
     */
    public function getPosted() {
        return $this->_posted;
    }

    /**
     * Setter de l'attribut $_posted
     * @param mixed $posted
     */
    public function setPosted($posted) {
        $this->_posted = $posted;
    }

    /**
     * Fonction permettant de recuperer tous les articles
     * @return array
     */
    public static function getAllPosts(){
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("
			SELECT posts.id as idPost, posts.title, posts.content, posts.writer, posts.image, posts.date_post, posts.posted,
				   admins.id as idAdmin, admins.name, admins.email, admins.password, admins.code_user, admins.role
			FROM posts
			JOIN admins
			ON posts.writer = admins.email
			ORDER BY date_post DESC
		");

        // Execution de la requête
        $req->execute();
        $databaseReuslt = $req->fetchAll(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $finalResult = [];
        foreach ($databaseReuslt as $val){
            $adminTemp = new Admins($val['idAdmin'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
            $postTemp = new Posts($val['idPost'], $val['title'], $val['content'],$adminTemp,  $val['image'], $val['date_post'], $val['posted']);
            $finalResult[] = $postTemp;
        }
        return $finalResult;
    }

    /**
     * Fonction permettant de récuperer un post grace à son identifiant
     * @param $id
     * @return array
     */
    public static function getPostById($id) {
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("
			SELECT posts.id as idPost, posts.title, posts.content, posts.writer, posts.image, posts.date_post, posts.posted,
				   admins.id as idAdmin, admins.name, admins.email, admins.password, admins.code_user, admins.role
			FROM posts
			INNER JOIN admins
			ON posts.writer = admins.email
			WHERE posts.id = :id
			ORDER BY date_post DESC
		");

        // Execution de la requête
        $req->bindValue(':id', $id);
        $req->execute();
        $val = $req->fetch(PDO::FETCH_ASSOC);

        // Préparation du résultat

            $adminTemp = new Admins($val['idAdmin'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
            return $post = new Posts($val['idPost'], $val['title'], $val['content'],$adminTemp,  $val['image'], $val['date_post'], $val['posted']);

    }

    /**
     * Fonction permettant de recuperer une liste d'article selon la visibilité
     * @param $visibility
     * @return array
     */
    public static function getPostsByPosted($visibility){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("
			SELECT posts.id as idPost, posts.title, posts.content, posts.writer, posts.image, posts.date_post, posts.posted,
				   admins.id as idAdmin, admins.name, admins.email, admins.password, admins.code_user, admins.role
			FROM posts
			JOIN admins
			ON posts.writer = admins.email
			WHERE posted = :visibility
			ORDER BY date_post DESC
		");

        // Execution de la requête
        $req->bindValue(':visibility', $visibility);
        $req->execute();
        $databaseReuslt = $req->fetchAll(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $finalResult = [];
        foreach ($databaseReuslt as $val){
            $adminTemp = new Admins($val['idAdmin'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
            $postTemp = new Posts($val['idPost'], $val['title'], $val['content'],$adminTemp,  $val['image'], $val['date_post'], $val['posted']);
            $finalResult[] = $postTemp;
        }
        return $finalResult;
    }


    /**
     * Fonction permettant d'ajouter un article
     *
     */
    public function addPost() {
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("INSERT INTO posts(title,content,writer,image,date_post,posted) VALUES(:title,:content,:admin,:image,NOW(),:posted)");

        // Execution de la requête
        $req->bindValue(':title', $this->_title);
        $req->bindValue(':content', $this->_content);
        $req->bindValue(':admin', $this->_admin->getEmail());
        $req->bindValue(':image', $this->_image);
        $req->bindValue(':posted', $this->_posted);
        $req->execute();
    }

    /**
     * Fonction permettant de modifier un article
     */
    public function updatePost() {
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("UPDATE posts SET title = :title,content = :content,image = :image, date_post = NOW(),posted = :posted WHERE id = :id");

        // Execution de la requête
        $req->bindValue(':title', $this->_title);
        $req->bindValue(':content', $this->_content);
        $req->bindValue(':image', $this->_image);
        $req->bindValue(':posted', $this->_posted);
        $req->bindValue(':id', $this->_id);
        $req->execute();
    }

    /**
     * Fonction permettant de supprimer un post
     * @param id
     */
    public static function deletePost($id){
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("DELETE FROM posts WHERE id = :id");

        // Execution de la requete
        $req->bindValue(':id', $id);
        $req->execute();
    }

    /**
     * Fonction permettant de compter le nom d'article
     */
    public static function countArticles(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        $req =  $req = $bdd->getDb()->query("SELECT COUNT(id) FROM posts");
        return $req->fetch();
    }

}