<?php
    class DatabaseConnector
{
    private $_database;
    private $_IPAddress;
    private $_user;
    private $_password;
    private $db;

    /**
     * databaseConnector constructor.
     * @param $_database
     * @param $_IPAdresse
     * @param $_user
     * @param $_password
     * @param $db
     */
    public function __construct($database, $IPAddress, $user, $password) {
        $this->_database = $database;
        $this->_IPAddress = $IPAddress;
        $this->_user = $user;
        $this->_password = $password;
        $this->login();
    }

    public function login(){
        $this->db = new PDO("mysql:dbname=$this->_database;host=$this->_IPAddress;charset=utf8",
            $this->_user, $this->_password);
    }

    public function logOut(){
        $this->db = null;
    }

    public function getDb(){
        return $this->db;
    }

}



