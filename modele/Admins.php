<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 21/08/2017
 * Time: 14:38
 */

class Admins
{
    private $_id;
    private $_name;
    private $_email;
    private $_password;
    private $_code_user;
    private $_role;

    /**
     * Admins constructor.
     * @param $_id
     * @param $_name
     * @param $_email
     * @param $_password
     * @param $_code_user
     * @param $_role
     */
    public function __construct($_id, $_name, $_email, $_password, $_code_user, $_role)
    {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_email = $_email;
        $this->_password = $_password;
        $this->_code_user = $_code_user;
        $this->_role = $_role;
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id){
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
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getCodeUser()
    {
        return $this->_code_user;
    }

    /**
     * @param mixed $code_user
     */
    public function setCodeUser($code_user)
    {
        $this->_code_usercode_user = $code_user;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }

    /**
     * Fonction permettant de récuperer tous les admins
     * @return array
     */
    public static function getAllAdmins(){
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("
          SELECT * FROM admins
        ");
        // Execution de la requête
        $req->execute();
        $databaseReuslt = $req->fetchAll(PDO::FETCH_ASSOC);

        // Préparation du résultat
        $finalResult = [];
        foreach ($databaseReuslt as $val){
            $admin = new Admins($val['id'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
            $finalResult[] = $admin;
        }
        return $finalResult;

    }

    /**
     * Fonction permetant de recuperer un admin selon son email et son mot de passe
     * @param $email
     * @param $password
     * @return int
     */
    public static function getAdminByEmailAndPassword($email, $password) {
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");

        // Execution de la requête
        $req->bindValue(':email', $email);
        $req->bindValue(':password', $password);
        $req->execute();
        $val = $req->fetch(PDO::FETCH_ASSOC);

        return $admin = new Admins($val['id'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
    }

    /**
     * Fonction permettant d'appeler un admin par son email
     * @param $email
     * @return Admins
     */
    public static function getAdminByEmail($email) {
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM admins WHERE email = :email");

        // Execution de la requête
        $req->bindValue(':email', $email);
        $req->execute();
        $val = $req->fetch(PDO::FETCH_ASSOC);

        return $admin = new Admins($val['id'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
    }

    /**
     * Fonction permettant de recuperer un admin selon son id
     * @param $id
     * @return Admins
     */
    public static function getAdminById($id) {
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Preparation de la requete
        $req = $bdd->getDb()->prepare("SELECT * FROM admins WHERE id = :id");

        // Execution de la requête
        $req->bindValue(':id', $id);
        $req->execute();
        $val = $req->fetch(PDO::FETCH_ASSOC);

        return $admin = new Admins($val['id'], $val['name'], $val['email'], $val['password'], $val['code_user'], $val['role']);
    }

    /**
     * Fontion permettant d'ajouter un admin
     */
    public function addAdmin()
    {

        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        $req = $bdd->getDb()->prepare("INSERT INTO admins(name,email,password,role) VALUES(:name,:email, :password, :role)");

        // Execution de la requête
        $req->bindValue(':name', $this->_name);
        $req->bindValue(':email', $this->_email);
        $req->bindValue(':password', $this->_password);
        $req->bindValue(':role', $this->_role);
        $req->execute();
    }

    /**
     * Fonction permettant de recuperer le nombre d'admin
     * @return mixed
     */
    public static function countUsers(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        $req =  $req = $bdd->getDb()->query("SELECT COUNT(id) FROM admins");
        return $req->fetch();
    }

    /**
     * Fonction permettant la creation d'un utilisateur et genere un mot de passe
     */
    public function updateAdmins(){
        // Connection à la base de donnees
        $bdd = new DatabaseConnector('nicolassjcwpopen','nicolassjcwpopen.mysql.db', 'nicolassjcwpopen','Tomlea23');

        // Préparation de la requête
        $req = $bdd->getDb()->prepare("UPDATE admins SET name = :name, email = :email, password = :password, code_user = :code_user, role = :role WHERE id = :id");

        // Execution de la requête
        $req->bindValue(':name', $this->_name);
        $req->bindValue(':email', $this->_email);
        $req->bindValue(':password', $this->_password);
        $req->bindValue(':code_user', $this->_code_user);
        $req->bindValue(':role', $this->_role);
        $req->bindValue(':id', $this->_id);
        $req->execute();
    }

}