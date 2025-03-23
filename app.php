<?php
include_once('./Router.php');
include_once('./controllers/UsuarioController.php');
include_once('./controllers/PacienteController.php');
include_once('./controllers/RecetaController.php');
include_once('./controllers/LoginController.php');
include_once('./controllers/PacienteRecetaController.php');
include_once('./controllers/ConsultaFormularioController.php');
include_once('./controllers/TareaController.php');
include_once('./controllers/ServicioController.php');
include_once('./controllers/IndexController.php');
include_once('./controllers/EquipoController.php');
include_once('./controllers/ProductoController.php');


$serviciosActivos="";
$miembrosEquipo="";
$productosDisponibles="";

$router = new Router();

$router->get('/', function() use (&$serviciosActivos, &$miembrosEquipo, &$productosDisponibles) {
    $indexController = new IndexController();
    $serviciosActivos = $indexController->mostrarActivos();
    $miembrosEquipo = $indexController->mostrarEquipo();
    $productosDisponibles = $indexController->mostrarProductos();
});


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

//RUTAS SERVICIOS
$router->get('/admin/servicios', function() {
    $controller = new ServicioController();
    $controller->inicio();
});

$router->get('/admin/servicios/crear', function() {
    $controller = new ServicioController();
    $controller->crear();
});

$router->post('/admin/servicios/crear', function() {
    $controller = new ServicioController();
    $controller->crear();
});

$router->get('/admin/servicios/editar', function() {
    $controller = new ServicioController();
    $controller->editar();
});

$router->post('/admin/servicios/editar', function() {
    $controller = new ServicioController();
    $controller->editar();
});

$router->get('/admin/servicios/borrar', function() {
    $controller = new ServicioController();
    $controller->borrar();
});

$router->get('/admin/servicios/activar', function() {
    $controller = new ServicioController();
    $controller->activar();
});

$router->get('/admin/servicios/desactivar', function() {
    $controller = new ServicioController();
    $controller->desactivar();
});

//RUTAS EQUIPO
$router->get('/admin/equipo', function() {
    $controller = new EquipoController();
    $controller->inicio();
});

$router->get('/admin/equipo/crear', function() {
    $controller = new EquipoController();
    $controller->crear();
});

$router->post('/admin/equipo/crear', function() {
    $controller = new EquipoController();
    $controller->crear();
});

$router->get('/admin/equipo/editar', function() {
    $controller = new EquipoController();
    $controller->editar();
});

$router->post('/admin/equipo/editar', function() {
    $controller = new EquipoController();
    $controller->editar();
});

$router->get('/admin/equipo/borrar', function() {
    $controller = new EquipoController();
    $controller->borrar();
});


//RUTAS SERVICIOS
$router->get('/admin/productos', function() {
    $controller = new ProductoController();
    $controller->inicio();
});

$router->get('/admin/productos/crear', function() {
    $controller = new ProductoController();
    $controller->crear();
});

$router->post('/admin/productos/crear', function() {
    $controller = new ProductoController();
    $controller->crear();
});

$router->get('/admin/productos/editar', function() {
    $controller = new ProductoController();
    $controller->editar();
});

$router->post('/admin/productos/editar', function() {
    $controller = new ProductoController();
    $controller->editar();
});

$router->get('/admin/productos/borrar', function() {
    $controller = new ProductoController();
    $controller->borrar();
});

$router->get('/admin/productos/activar', function() {
    $controller = new ProductoController();
    $controller->activar();
});

$router->get('/admin/productos/desactivar', function() {
    $controller = new ProductoController();
    $controller->desactivar();
});

// Comprobar rutas
$router->comprobarRutas();
?>