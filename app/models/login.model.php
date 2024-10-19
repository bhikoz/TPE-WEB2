<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_libros;charset=utf8', 'root', '');
    }

    public function getByUserName($user_name) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE user_name = ?');  
        $query->execute([$user_name]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}

?>