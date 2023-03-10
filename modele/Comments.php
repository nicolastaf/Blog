<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 14/08/2017
 * Time: 14:17
 */

class Comments
{
    private $_id;
    private $_name;
    private $_email;
    private $_comment;
    private $_post;
    private $_date_comment;

    /**
     * Comment constructor.
     * @param $_name
     * @param $_email
     * @param $_comment
     * @param $_post_id
     * @param $_date_comment
     * @param $_seen
     */
    public function __construct($_id, $_name, $_email, $_comment, Posts $post, $_date_comment, $_seen)
    {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_email = $_email;
        $this->_comment = $_comment;
        $this->_post = $post;
        $this->_date_comment = $_date_comment;
        $this->_seen = $_seen;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->_comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->_post;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId(Posts $post)
    {
        $this->_post = $post;
    }

    /**
     * @return mixed
     */
    public function getDateComment()
    {
        return $this->_date_comment;
    }

    /**
     * @param mixed $date_comment
     */
    public function setDateComment($date_comment)
    {
        $this->_date_comment = $date_comment;
    }

    /**
     * @return mixed
     */
    public function getSeen()
    {
        return $this->_seen;
    }

    /**
     * @param mixed $seen
     */
    public function setSeen($seen)
    {
        $this->_seen = $seen;
    }
    private $_seen;

    /**
     * Fonction permettant de recuperer un commentaire selon l'id de l'article et sa visibilité
     * @param $id
     * @param $seen
     * @return array
     */
    public static function getCommentsByPostAndSeen($id, $seen){
        // Recuperation du post associe
        $post = Posts::getPostById($id);

        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM comments WHERE post_id = :id AND seen = :seen ORDER BY date_comment DESC");

        // Execution de la requête
        $req->bindValue(':id', $id);
        $req->bindValue(':seen', $seen);
        $req->execute();
        $databaseReuslt = $req->fetchAll(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $finalResult = [];
        foreach ($databaseReuslt as $val){
            $commentTemp = new Comments($val['id'],$val['name'], $val['email'], $val['comment'], $post, $val['date_comment'], $val['seen']);
            $finalResult[] = $commentTemp;
        }
        return $finalResult;
    }

    /**
     * Fonction permettant de recuperer les commentaires selon la validation
     * @param $id
     * @param $seen
     * @return array
     */
    public static function getCommentsBySeen($seen){
        // Recuperation du post associe

        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM comments WHERE seen = :seen ORDER BY date_comment DESC");

        // Execution de la requête
        $req->bindValue(':seen', $seen);
        $req->execute();
        $databaseReuslt = $req->fetchAll(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $finalResult = [];
        foreach ($databaseReuslt as $val){
            $post = Posts::getPostById($val['post_id']);
            $commentTemp = new Comments($val['id'],$val['name'], $val['email'], $val['comment'], $post, $val['date_comment'], $val['seen']);
            $finalResult[] = $commentTemp;
        }
        return $finalResult;
    }

    /**
     * Fonction permettant de recupere un commentaire avec son id
     * @param $id
     * @return array
     */
    public static function getCommentsById($id){
        // Recuperation du post associe

        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM comments WHERE id = :id ORDER BY date_comment DESC");

        // Execution de la requête
        $req->bindValue(':id', $id);
        $req->execute();
        $val = $req->fetch(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $post = Posts::getPostById($val['post_id']);
        return new Comments($val['id'],$val['name'], $val['email'], $val['comment'], $post, $val['date_comment'], $val['seen']);

    }

    /**
     * Fonction permettant d'ajouter un commentaire
     */
    public function addComment(){
        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("INSERT INTO comments(name, email, comment, post_id, date_comment) VALUES(:name, :email, :comment, :post_id, NOW())");
        $req->bindValue(':name', $this->_name);
        $req->bindValue(':email', $this->_email);
        $req->bindValue(':comment', $this->_comment);
        $req->bindValue(':post_id', $this->_post->getId());
        $req->execute();
    }

    /**
     * Fonction permettant de modifier un commentaire
     */
    public function updateComment(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("UPDATE comments SET name = :name, email = :email, comment = :comment, seen = :seen WHERE id = :id");

        // Execution de la requête
        $req->bindValue(':name', $this->_name);
        $req->bindValue(':email', $this->_email);
        $req->bindValue(':comment', $this->_comment);
        $req->bindValue(':seen', $this->_seen);
        $req->bindValue(':id', $this->_id);
        $req->execute();
    }

    /**
     * Fonction permettant de valider un commentaire em BO
     */
    public function updateCommentSeen(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("UPDATE comments SET seen = '1' WHERE id = :id");

        // Execution de la requête
        $req->bindValue(':name', $this->_name);
        $req->bindValue(':email', $this->_email);
        $req->bindValue(':comment', $this->_comment);
        $req->bindValue(':seen', $this->_seen);
        $req->bindValue(':id', $this->_id);
        $req->execute();
    }

    /**
     * Fonction permettant de supprimer un commentaire
     * @param $id
     */
    public static function deleteComment($id){
        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("DELETE FROM comments WHERE id = :id");

        // Execution de la requete
        $req->bindValue(':id', $id);
        $req->execute();
        echo "toto";
    }

    /**
     * Fonction permettant de compter les commentaires
     * @return mixed
     */
    public static function countComments(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('root','root.mysql.db', 'root','password');

        $req = $bdd->getDb()->query("SELECT COUNT(id) FROM comments");
        return $req->fetch();
    }
}