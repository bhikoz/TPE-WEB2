<?php
require_once './app/views/login.view.php';
require_once './app/models/login.model.php';
require_once './app/helpers/auth.helper.php';

class LoginController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new LoginView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (empty($user_name) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = $this->model->getByUserName($user_name);

        if ($user && password_verify($password, $user->password)) {
            AuthHelper::login($user);
            header("Location: " . BASE_URL. "home");
        } else {
            $this->view->showLogin('Usuario o contraseña inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . "home");
    }
}