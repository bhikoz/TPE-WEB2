<?php

class LibrosView {
    public function ShowLibros($libros, $autores , $verify = false){
        require_once("templates/libros.phtml");
    }

    
    public function showLibroXAutor($libros){
        require_once("templates/LibroXAutor.phtml");
    }

    
    public function mostrarDetalle($libro){
        require_once("templates/detalleLibro.phtml");
    }

    
    public function mostrarFormModLibro($libro, $autores, $verify) {
        require_once "templates/formEditLibro.phtml";
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}