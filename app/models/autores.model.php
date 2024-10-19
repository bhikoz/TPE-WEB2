<?php
include 'config.php';

class AutoresModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    }

    function getAutores(){
        $query = $this->db->prepare("SELECT * FROM autores");
        $query->execute();
        $autores = $query->fetchAll(PDO::FETCH_OBJ);
        return $autores;
    }

    public function getAutorById($autorId){
        $query = $this->db->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $query->execute(array($autorId));
        $autor = $query->fetch(PDO::FETCH_OBJ);
        if ($autor) {
            return $autor;
          } else {
            return false;
          }
    }

    public function agregarAutor($nombre, $edad, $nacionalidad){
        $query = $this->db->prepare("INSERT INTO autores (Nombre, Edad, Nacionalidad) VALUES (?, ?, ?)");
        $query->execute([$nombre, $edad, $nacionalidad]);
    
        return $this->db->lastInsertId();
    }

    public function eliminarAutor($id){
        $query = $this->db->prepare("DELETE FROM autores WHERE id_autor = ?");
        $query->execute([$id]);
    }

    public function modificarAutor($id_autor, $nombre, $edad, $nacionalidad) {
        $query = $this->db->prepare("UPDATE autores SET nombre = ?, edad = ?, nacionalidad = ? WHERE id_autor = ?");
        $query->execute([$nombre, $edad, $nacionalidad, $id_autor]);
      }
}