<?php
include_once('./Router.php');
include_once('./controllers/UsuarioController.php');
include_once('./controllers/PacienteController.php');
include_once('./controllers/RecetaController.php');

$router = new Router();

// Definir rutas USUARIOS
//  /admin/usuarios
$router->get('/usuarios', function() {
    $controller = new UsuarioController();
    $controller->inicio();
});

$router->get('/usuarios/crear', function() {
    $controller = new UsuarioController();
    $controller->crear();
});

$router->post('/usuarios/crear', function() {
    $controller = new UsuarioController();
    $controller->crear();
});

$router->get('/usuarios/editar', function() {
    $controller = new UsuarioController();
    $controller->editar();
});

$router->post('/usuarios/editar', function() {
    $controller = new UsuarioController();
    $controller->editar();
});

$router->get('/usuarios/borrar', function() {
    $controller = new UsuarioController();
    $controller->borrar();
});


// Definir rutas PACIENTES
$router->get('/pacientes', function() {
    $controller = new PacienteController();
    $controller->inicio();
});

$router->get('/pacientes/crear', function() {
    $controller = new PacienteController();
    $controller->crear();
});

$router->post('/pacientes/crear', function() {
    $controller = new PacienteController();
    $controller->crear();
});

$router->get('/pacientes/editar', function() {
    $controller = new PacienteController();
    $controller->editar();
});

$router->post('/pacientes/editar', function() {
    $controller = new PacienteController();
    $controller->editar();
});

$router->get('/pacientes/borrar', function() {
    $controller = new PacienteController();
    $controller->borrar();
});

$router->get('/pacientes/sugerencias', function() { 
    $controller = new PacienteController();
    $controller->sugerencias();
});


// Definir rutas RECETAS
$router->get('/recetas', function() {
    $controller = new RecetaController();
    $controller->inicio();
});

$router->get('/recetas/crear', function() {
    $controller = new RecetaController();
    $controller->crear();
});

$router->post('/recetas/crear', function() {
    $controller = new RecetaController();
    $controller->crear();
});

$router->get('/recetas/editar', function() {
    $controller = new RecetaController();
    $controller->editar();
});

$router->post('/recetas/editar', function() {
    $controller = new RecetaController();
    $controller->editar();
});

$router->get('/recetas/borrar', function() {
    $controller = new RecetaController();
    $controller->borrar();
});




// Comprobar rutas
$router->comprobarRutas();
?>