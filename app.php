<?php
include_once('./Router.php');
include_once('./controllers/UsuarioController.php');
include_once('./controllers/PacienteController.php');
include_once('./controllers/RecetaController.php');
include_once('./controllers/LoginController.php');
include_once('./controllers/PacienteRecetaController.php');
include_once('./controllers/ConsultaFormularioController.php');
include_once('./controllers/TareaController.php');

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

//Rutas de Login y autenticacion
$router->get('/login', function() {
    $controller = new LoginController();
    $controller->login();
});

$router->post('/login', function() {
    $controller = new LoginController();
    $controller->login();
});

$router->get('/logout', function() {
    $controller = new LoginController();
    $controller->cerrarSesion();
});

//RUTAS PACIENTE - RECETAS
$router->get('/paciente/recetas', function() {
    $controller = new PacienteRecetaController();
    $controller->inicio();
});

$router->get('/paciente/recetas/crear', function() {
    $controller = new PacienteRecetaController();
    $controller->crear();
});

$router->post('/paciente/recetas/crear', function() {
    $controller = new PacienteRecetaController();
    $controller->crear();
});

$router->get('/paciente/recetas/borrar', function() {
    $controller = new PacienteRecetaController();
    $controller->borrar();
});

//RUTAS CONSULTAS FORMULARIO

$router->get('/consulta/crear', function() {
    $controller = new ConsultaFormularioController();
    $controller->crear();
});

$router->post('/consulta/crear', function() {
    $controller = new ConsultaFormularioController();
    $controller->crear();
});

$router->get('/admin/consultas-formulario', function() {
    $controller = new ConsultaFormularioController();
    $controller->inicio();
});

$router->get('/admin/consultas-formulario/borrar', function() {
    $controller = new ConsultaFormularioController();
    $controller->borrar();
});


//RUTAS TAREAS
$router->get('/admin/tareas', function() {
    $controller = new TareaController();
    $controller->inicio();
});

$router->get('/admin/tareas/crear', function() {
    $controller = new TareaController();
    $controller->crear();
});

$router->post('/admin/tareas/crear', function() {
    $controller = new TareaController();
    $controller->crear();
});

$router->get('/admin/tareas/editar', function() {
    $controller = new TareaController();
    $controller->editar();
});

$router->post('/admin/tareas/editar', function() {
    $controller = new TareaController();
    $controller->editar();
});

$router->get('/admin/tareas/borrar', function() {
    $controller = new TareaController();
    $controller->borrar();
});

// Comprobar rutas
$router->comprobarRutas();
?>