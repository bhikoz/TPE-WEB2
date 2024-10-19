<?php
require_once './app/views/libros.view.php';
require_once './app/models/libros.model.php';

class LibrosController {

    private $model;
    private $view;
    private $autoresModel;
    public function __construct() {
        $this->view = new LibrosView();
        $this->model = new LibrosModel();
        $this->autoresModel = new AutoresModel();
    }

    public function showLibros(){
        $verify = AuthHelper::verify();
        $libros = $this->model->getLibros();
        $autores = $this->autoresModel->getAutores();
        $this->view->ShowLibros($libros, $autores, $verify);
    }

    public function showLibroXAutor($Autor_id) {
        $Libros = $this->model->getLibrosXAutor($Autor_id);
        $this->view->showLibroXAutor($Libros);
    }

    public function showDetalleLibro($Libro_id) {
        $libro = $this->model->mostrarDetalleLibro($Libro_id);
        $this->view->mostrarDetalle($libro);
    }

    public function addLibro() {
      $verify = AuthHelper::verify();
    
      if ($verify) {
        $titulo = $_POST['Titulo'];
        $saga = $_POST['Saga'];
        $genero = $_POST['Genero'];
        $id_autor = $_POST['id_autor'];
        $imagen = $_POST['imagen'];
    
        foreach ($_POST as $item) {
          if (empty($item)) {
            $this->view->showError("Debe completar todos los campos");
            return;
          }
        }
    
        if (!filter_var($imagen, FILTER_VALIDATE_URL)) {
          $this->view->showError("El link de la imagen no es válido");
          return;
        }
    
        $id_libro = $this->model->agregarLibro($titulo, $saga, $genero, $id_autor, $imagen);
    
        if ($id_libro) {
          header('Location: ' . BASE_URL . 'showLibros');
        } else {
          $this->view->showError("Error al insertar el libro");
        }
      } else {
        header('Location: ' . BASE_URL . 'showLibros');
      }
    }
  

    function removeLibros($Libro_id) {
        $this->model->eliminarLibro($Libro_id);
        header('Location: ' . BASE_URL . 'showLibros');
    }


    public function formModificarLibro($id_libro) {
      $verify = AuthHelper::verify();
    
      if ($verify) {
        $libro = $this->model->getLibroById($id_libro);
        $autores = $this->autoresModel->getAutores();
        if ($libro) {
          $this->view->mostrarFormModLibro($libro, $autores, $verify);
        } else {
          header('Location: ' . BASE_URL . 'showLibros');
        }
      } else {
        $this->view->showError("No tienes permisos suficientes");
      }
    }    
    public function editLibro($id_libro) {
        $verify = AuthHelper::verify();
    
        if ($verify) {
            $titulo = $_POST["titulo"];
            $saga = $_POST["saga"];
            $genero = $_POST["genero"];
            $id_autor = $_POST["id_autor"];
    
            try {
              $this->model->editLibro($id_libro, $titulo, $saga, $genero, $id_autor);
                header('Location: ' . BASE_URL . 'showLibros');
              } catch (Exception $e) {
                $this->view->showError($e->getMessage());
              }
            } else {
              header("location: " . BASE_URL . "formModificarLibro/" . $id_libro);
            }
    }
  

}