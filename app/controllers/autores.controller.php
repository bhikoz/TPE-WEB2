<?php
require_once './app/views/autores.view.php';
require_once './app/models/autores.model.php';
require_once("./app/helpers/auth.helper.php");

class AutoresController {

    private $view;
    private $model;

    function __construct() {
        $this->model = new AutoresModel();
        $this->view = new AutoresView();
    }

    public function showAutores() {
        $verify = AuthHelper::verify();
        $autores = $this->model->getAutores();  
    
        $this->view->mostrarAutores($autores, $verify);
    }

    public function agregarAutor(){
        $verify = AuthHelper::verify();
        if($verify){
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
            $nacionalidad = $_POST["nacionalidad"];
    
            if(empty($nombre) || empty($edad) || empty($nacionalidad)){
                $this->view->showError("Debe completar todos los campos");
                return;
            }
    
            $id = $this->model->agregarAutor($nombre, $edad, $nacionalidad);
    
            if($id){
                header("location: ". BASE_URL . "Autores" );
            } else {
                $this->view->showError("Los datos no pueden ser cargados");
            }
        } else {
            $this->view->showError("No tienes permisos suficientes");
        }
    }

    public function removeAutor($id_autor) {
        $verify = AuthHelper::verify();
        if ($verify) {
            try {
                $this->model->eliminarAutor($id_autor);
                header("location: " . BASE_URL . "Autores");
            } catch (Exception) { 
                $this->view->showError("No se puede eliminar autores");
            }
        }
    }

    public function formModificarAutor($id_autor) {
        $verify = AuthHelper::verify();
        if ($verify) {
          $autor = $this->model->getAutorById($id_autor);
          if ($autor) {
            $this->view->mostrarFormModAutor($autor);
          } else {
            header("location: " . BASE_URL . "Autores");
          }
        } else {
          $this->view->showError("No tienes permisos suficientes");
        }
      }
    
      public function modificarAutor($id_autor) {
        $verify = AuthHelper::verify();
        if ($verify) {
          $nombre = $_POST["nombre"];
          $edad = $_POST["edad"];
          $nacionalidad = $_POST["nacionalidad"];
    
          try {
            $this->model->modificarAutor($id_autor, $nombre, $edad, $nacionalidad);
            header("location: " . BASE_URL . "Autores");
          } catch (Exception $e) {
            $this->view->showError($e->getMessage());
          }
        } else {
          header("location: " . BASE_URL . "formModificarAutor/" . $id_autor);
        }
      }
}
