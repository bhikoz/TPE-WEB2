<?php
require_once("app/views/home.view.php");
class HomeController{
    private $view;

    public function __construct() {
        $this->view = new HomeView;
    }

    public function showHome(){
        $verify = AuthHelper::verify();
        $this->view->showHome($verify);
    }

    public function mostrar404($error){
        $this->view->mostrar404($error);
    }
}