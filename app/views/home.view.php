<?php
class HomeView{


    public function showHome($verify){
        require_once("templates/home.phtml");
    }


    public function mostrar404($error){
        require_once("templates/error.phtml");
    }
}