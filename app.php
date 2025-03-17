<?php
include_once('./Router.php');
include_once('./controllers/UsuarioController.php');
include_once('./controllers/PacienteController.php');
include_once('./controllers/RecetaController.php');

$router = new Router();

// Definir rutas USUARIOS
//  /admin/usuarios
$router->get('/admin/usuarios', function() {
    $controller = new UsuarioController();
    $controller->inicio();
});

$router->get('/admin/usuarios/crear', function() {
    $controller = new UsuarioController();
    $controller->crear();
});

$router->post('/admin/usuarios/crear', function() {
    $controller = new UsuarioController();
    $controller->crear();
});

$router->get('/admin/usuarios/editar', function() {
    $controller = new UsuarioController();
    $controller->editar();
});

$router->post('/admin/usuarios/editar', function() {
    $controller = new UsuarioController();
    $controller->editar();
});

$router->get('/admin/usuarios/borrar', function() {
    $controller = new UsuarioController();
    $controller->borrar();
});


// Definir rutas PACIENTES
$router->get('/admin/pacientes', function() {
    $controller = new PacienteController();
    $controller->inicio();
});

$router->get('/admin/pacientes/crear', function() {
    $controller = new PacienteController();
    $controller->crear();
});

$router->post('/admin/pacientes/crear', function() {
    $controller = new PacienteController();
    $controller->crear();
});

$router->get('/admin/pacientes/editar', function() {
    $controller = new PacienteController();
    $controller->editar();
});

$router->post('/admin/pacientes/editar', function() {
    $controller = new PacienteController();
    $controller->editar();
});

$router->get('/admin/pacientes/borrar', function() {
    $controller = new PacienteController();
    $controller->borrar();
});

$router->get('/admin/pacientes/sugerencias', function() { 
    $controller = new PacienteController();
    $controller->sugerencias();
});


// Definir rutas RECETAS
$router->get('/admin/recetas', function() {
    $controller = new RecetaController();
    $controller->inicio();
});

$router->get('/admin/recetas/crear', function() {
    $controller = new RecetaController();
    $controller->crear();
});

$router->post('/admin/recetas/crear', function() {
    $controller = new RecetaController();
    $controller->crear();
});

$router->get('/admin/recetas/editar', function() {
    $controller = new RecetaController();
    $controller->editar();
});

$router->post('/admin/recetas/editar', function() {
    $controller = new RecetaController();
    $controller->editar();
});

$router->get('/admin/recetas/borrar', function() {
    $controller = new RecetaController();
    $controller->borrar();
});




// Comprobar rutas
$router->comprobarRutas();
?>