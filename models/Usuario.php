<?php
class Usuario{

    public $id;
    public $nombre;
    public $apellidos;
    public $usuario;
    public $password;
    public $correo;
    public $role_id;
    public $role_nombre;
    public $id_paciente;

    //constructor para crea un objeto
    public function __construct($id, $nombre, $apellidos, $usuario,$password,$correo,$role_id,$id_paciente)
    {
        //la asignacion a los atributos de la clase los valores pasados por el constructor
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->usuario=$usuario;
        $this->password=$password;
        $this->correo=$correo;
        $this->role_id=$role_id;
        $this->id_paciente=$id_paciente;
    }

        // Método mágico __set() para manejar la propiedad role_nombre de forma dinámica
        public function __set($name, $value) {
            if ($name == 'role_nombre') {
                $this->role_nombre = $value;  // Si se intenta acceder a 'role_nombre', la asignamos
            }
        }

    // public static function consultar(){
    //     //creamos un array vacio donde vamos a almacenar todos los empleados
    //     $listaUsuarios = [];
    //     $conexion = BD::crearInstancia();
    //     //hacemos select de todos los empleados
    //     $sql = $conexion->prepare("SELECT * FROM tbl_usuarios");
    //     $sql->execute();
    //     //nos traemos todos los empleados
    //     //iteramos sobre todos los empleados
    //     //como se nos devuelve un array asociativ
    //     //Cada fila es un array con claves que corresponden a los nombres de las columnas (id, nombre, correo).
    //     //foreach recorre cada fila y la guarda en $empleado
    //     foreach($sql->fetchAll() as $usuario){
    //         //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
    //         //agregamos ese objeto resultante, al arraya
    //         $listaUsuarios[]=new Usuario($usuario['ID'],$usuario['usuario'],$usuario['password'],$usuario['correo'],$usuario['role_id'],$usuario['id_paciente']);
    //     }
    //     return $listaUsuarios;
    // }


    public static function crear ($nombre, $apellidos, $usuario,$password,$correo,$role_id,$id_paciente){
        $conexion = BD::crearInstancia();
        $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario=:usuario OR correo=:correo");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->execute();

        if ($sentencia->rowCount() > 0) {
            return "Error: Ya existe un usuario con ese nombre o correo electrónico.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            //creamos la query
            $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`(`ID`, `nombre`, `apellidos`,`usuario`, `password`, `correo`, `role_id`, `id_paciente`) VALUES (NULL, :nombre, :apellidos, :usuario, :password, :correo, :role_id, :id_paciente);");

            //se reemplaza la palabra por el valor de la variable
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $passwordHash);
            $sentencia->bindParam(":correo", $correo);
            $sentencia->bindParam(":role_id", $role_id);
            $sentencia->bindParam(":id_paciente", $id_paciente);

            //ejecutamos la query
            $sentencia->execute();

    }
}

public static function consultar(){
    $listaUsuarios = [];
    $conexion = BD::crearInstancia();
    $sql = $conexion->prepare("SELECT u.ID, u.nombre, u.apellidos, u.usuario, u.password, u.correo, u.role_id, r.nombre AS role_nombre, u.id_paciente
                                FROM tbl_usuarios u
                                JOIN roles r ON u.role_id = r.id");
    $sql->execute();
    foreach($sql->fetchAll() as $usuario){
        $nuevoUsuario=new Usuario($usuario['ID'], $usuario['nombre'], $usuario['apellidos'], $usuario['usuario'],$usuario['password'],$usuario['correo'],$usuario['role_id'],$usuario['id_paciente']);
        $nuevoUsuario->role_nombre = $usuario['role_nombre'];
        $listaUsuarios[] = $nuevoUsuario;
    }
    return $listaUsuarios;
}


public static function buscar($id){
    $conexion = BD::crearInstancia();
    $sql = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE ID=:id");
    $sql->bindParam(":id",$id);
    $sql->execute();
    $usuario = $sql->fetch();
    return new Usuario($usuario['ID'],$usuario['nombre'], $usuario['apellidos'],$usuario['usuario'],$usuario['password'],$usuario['correo'],$usuario['role_id'],$usuario['id_paciente']);
}

public static function editar($id,$nombre, $apellidos, $usuario,$password,$correo,$role_id,$id_paciente){
    $conexion = BD::crearInstancia();
    $sql=$conexion->prepare("UPDATE tbl_usuarios SET nombre=:nombre, apellidos=:apellidos, usuario=:usuario, password=:password, correo=:correo, role_id=:role_id, id_paciente=:id_paciente WHERE id=:id");
    $sql->bindParam(":nombre",$nombre);
    $sql->bindParam(":apellidos",$apellidos);
    $sql->bindParam(":usuario",$usuario);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql->bindParam(":password",$passwordHash);
    $sql->bindParam(":correo",$correo);
    $sql->bindParam(":role_id",$role_id);
    $sql->bindParam(":id_paciente",$id_paciente);
    $sql->bindParam(":id",$id);
    $sql->execute();
}

public static function borrar($id){
    $conexion = BD::crearInstancia();
    $sql=$conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sql->bindParam(":id",$id);
    $sql->execute();

}

}