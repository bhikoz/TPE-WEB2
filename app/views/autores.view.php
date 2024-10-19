<?php

class AutoresView {
     
    public function mostrarAutores($autor, $verify = false){
        require_once("templates/autores.phtml");
    }

       public function mostrarFormModAutor($autor){
        require_once "templates/formEditAutor.phtml";
    }

    function showError($error){
        require_once("templates/error.phtml");
    }
}