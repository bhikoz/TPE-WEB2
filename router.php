<?php
require_once("app/controllers/autores.controller.php");
require_once("app/controllers/libros.controller.php");
require_once("app/controllers/login.controller.php");
require_once("app/controllers/home.controller.php");

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// el router va a leer la action desde el paramtro "action"
$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
//Instancio el homeController
$controladorHome = new HomeController();
//Instancio el AutoresController
$controladorAutores = new AutoresController();
//Instacio el LibroController
$controladorLibro = new LibrosController();
//Instancio el AutenticacionController
$controladorAutenticador = new LoginController();

switch ($params[0]) {
    case "home":
        $controladorHome->showHome();
        break;
    case "Autores":
        $controladorAutores->showAutores();
        break;
    case "agregarAutor":
        $controladorAutores->agregarAutor();
        break;
    case "eliminarAutor":
        $controladorAutores->removeAutor($params[1]);
        break;
    case "formModificarAutor":
        $controladorAutores->formModificarAutor($params[1]);
        break;
    case "modificarAutor":
        $controladorAutores->modificarAutor($params[1]);
        break;
    case "mostrarLibroXAutores":
        $controladorLibro->showLibroXAutor($params[1]);
        break;
    case "mostrarDetalleLibro":
        $controladorLibro->showDetalleLibro($params[1]);
        break;
    case "showLibros":
        $controladorLibro->showLibros();
        break;
    case "agregarLibro":
        $controladorLibro->addLibro();
        break;
    case "eliminarLibro":
        $controladorLibro->removeLibros($params[1]);
        break;
    case "formModificarLibro":
        $controladorLibro->formModificarLibro($params[1]);
         break;
    case "modificarLibro":
        $controladorLibro->editLibro($params[1]);
        break;
    case "login":
        $controladorAutenticador-> showLogin();
        break;
    case "autenticacion":
        $controladorAutenticador-> auth();
        break;
    case "logout":
        $controladorAutenticador-> logout();
        break;
    default:
        $controladorHome->mostrar404("error 404");
        break;
}  