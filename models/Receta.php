<?php
class Receta
{
    public $id_receta;
    public $paciente_id;
    public $imagen_receta;
    public $nombre;
    public $fecha;
    public $estado;
    public $codigo_nacional;
    public $observaciones;
    public $nombre_completo_paciente;

    public function __construct($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones)
    {
        $this->id_receta = $id_receta;
        $this->paciente_id = $paciente_id;
        $this->imagen_receta = $imagen_receta;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->codigo_nacional = $codigo_nacional;
        $this->observaciones = $observaciones;
    }

    //metodo original
    // public static function crear($paciente_id, $imagen_receta,$nombre,$fecha,$codigo_nacional,$observaciones){
    //     $conexion = BD::crearInstancia();
    //     $sql = $conexion->prepare("INSERT INTO `tbl_recetas`(`id_receta`, `paciente_id`, `imagen_receta`, `nombre`, `fecha`, `estado`, `codigo_nacional`, `observaciones`)
    //     VALUES (NULL, :paciente_id, :imagen_receta, :nombre, :fecha, 'Enviada', :codigo_nacional, :observaciones);");
        
    //     $sql->bindParam(":paciente_id",$paciente_id);
    //     $sql->bindParam(":imagen_receta",$imagen_receta);
    //     $sql->bindParam(":nombre",$nombre);
    //     $sql->bindParam(":fecha",$fecha);
    //     $sql->bindParam(":codigo_nacional",$codigo_nacional);
    //     $sql->bindParam(":observaciones",$observaciones);
    //     $sql->execute();
    // }

    //metodo crear mas flexible depend si le pasan param como CN u observaciones
    public static function crear($paciente_id, $imagen_receta, $nombre, $fecha, $codigo_nacional = null, $observaciones = null) {
        $conexion = BD::crearInstancia();
        
        // Si el código nacional y observaciones están disponibles (caso admin)
        if ($codigo_nacional !== null && $observaciones !== null) {
            $sql = $conexion->prepare("INSERT INTO `tbl_recetas`(`id_receta`, `paciente_id`, `imagen_receta`, `nombre`, `fecha`, `estado`, `codigo_nacional`, `observaciones`)
                VALUES (NULL, :paciente_id, :imagen_receta, :nombre, :fecha, 'Enviada', :codigo_nacional, :observaciones);");
            $sql->bindParam(":codigo_nacional", $codigo_nacional);
            $sql->bindParam(":observaciones", $observaciones);
        } else {
            // Solo para paciente: el admin completará los campos luego
            $sql = $conexion->prepare("INSERT INTO `tbl_recetas`(`id_receta`, `paciente_id`, `imagen_receta`, `nombre`, `fecha`, `estado`, `codigo_nacional`, `observaciones`)
                VALUES (NULL, :paciente_id, :imagen_receta, :nombre, :fecha, 'Enviada', NULL, NULL);");
        }
    
        // Bind de los parámetros comunes
        $sql->bindParam(":paciente_id", $paciente_id);
        $sql->bindParam(":imagen_receta", $imagen_receta);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":fecha", $fecha);
    
        // Ejecutar la consulta
        $sql->execute();
    }
    

    public static function consultar()
    {
        $listaRecetas = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT 
            r.id_receta, 
            r.paciente_id, 
            r.imagen_receta,
            r.nombre AS nombre_receta, 
            r.estado, 
            r.fecha, 
            r.codigo_nacional, 
            r.observaciones, 
            CONCAT(p.nombre, ' ', p.apellidos) AS nombre_completo_paciente
            FROM tbl_recetas r
            JOIN tbl_pacientes p 
            ON r.paciente_id = p.id_paciente;");

        $sql->execute();

        foreach ($sql->fetchAll() as $receta) {
            //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
            //agregamos ese objeto resultante, al arraya
            $nuevaReceta = new Receta(
                $receta['id_receta'],
                $receta['paciente_id'],
                $receta['imagen_receta'],
                $receta['nombre_receta'],
                $receta['fecha'],
                $receta['estado'],
                $receta['codigo_nacional'],
                $receta['observaciones'],
            );
            $nuevaReceta->nombre_completo_paciente = $receta['nombre_completo_paciente'];
            $listaRecetas[] = $nuevaReceta;
        }
        return $listaRecetas;
    }


    public static function buscar($id)
    {
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM tbl_recetas WHERE id_receta=:id_receta");
        $sql->bindParam(":id_receta", $id);
        $sql->execute();
        $receta = $sql->fetch();
        return new Receta(
            $receta['id_receta'],
            $receta['paciente_id'],
            $receta['imagen_receta'],
            $receta['nombre'],
            $receta['fecha'],
            $receta['estado'],
            $receta['codigo_nacional'],
            $receta['observaciones']
        );
    }

    public static function obtenerImagen($id_receta)
    {
        $conexion = BD::crearInstancia();
        //buscamos la imagen del registro con ese ID
        $sql = $conexion->prepare("SELECT imagen_receta FROM tbl_recetas WHERE id_receta=:id_receta");
        $sql->bindParam(":id_receta", $id_receta);
        $sql->execute();
        $imagen = $sql->fetch();
        return $imagen['imagen_receta'] ?? null;
        }

        //funciona correctamente

    public static function borraImagenReceta($imagen)
    {
        $ruta_imagen = "assets/img/recetas/" . $imagen;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
    }

    public static function actualizarImagen($id_receta, $imagen_receta)
    {
        $conexion = BD::crearInstancia();
            $sql = $conexion->prepare("UPDATE tbl_recetas SET imagen_receta = :imagen_receta WHERE id_receta = :id_receta");
            $sql->bindParam(":imagen_receta", $imagen_receta);
            $sql->bindParam(":id_receta", $id_receta);
            $sql->execute();
        }
    


    public static function editar($id_receta, $paciente_id, $imagen_receta, $nombre, $fecha, $estado, $codigo_nacional, $observaciones)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen de la receta a actualizar
        if ($imagen_receta != "") {
            //obtenemos la img actual de la receta
            $imagen_actual = self::obtenerImagen($id_receta);
            //si existe uma img 
            // if ($imagen_actual) {
            //     self::borraImagenReceta($imagen_actual);
            // }

            //cambio
            if ($imagen_actual && $imagen_receta != $imagen_actual) {
                self::borraImagenReceta($imagen_actual);
            }
        }

        $sql = $conexion->prepare("UPDATE tbl_recetas 
        SET paciente_id = :paciente_id, 
            imagen_receta = :imagen_receta, 
            nombre = :nombre, 
            fecha = :fecha, 
            estado = :estado, 
            codigo_nacional = :codigo_nacional, 
            observaciones = :observaciones 
        WHERE id_receta = :id_receta");

        $sql->bindParam(":paciente_id", $paciente_id);
        $sql->bindParam(":imagen_receta", $imagen_receta);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":fecha", $fecha);
        $sql->bindParam(":estado", $estado);
        $sql->bindParam(":codigo_nacional", $codigo_nacional);
        $sql->bindParam(":observaciones", $observaciones);
        $sql->bindParam(":id_receta", $id_receta);

        // Ejecutamos la consulta
        $sql->execute();
    }

    
    //funciona correctamente
    public static function borrar($id_receta)
    {
        $conexion = BD::crearInstancia();
        //obtenemos la imagen del registro a borrar
        $imagen = self::obtenerImagen($id_receta);

        if ($imagen) {
            self::borraImagenReceta($imagen);
        }

        $sql = $conexion->prepare("DELETE FROM tbl_recetas WHERE id_receta = :id_receta");
        $sql->bindParam(":id_receta", $id_receta);
        return $sql->execute();
    }




    public static function buscarRecetaPaciente($paciente_id){
        $listaRecetasPaciente = [];
        $conexion = BD::crearInstancia();
        $sql = $conexion->prepare("SELECT * FROM `tbl_recetas` WHERE paciente_id=:paciente_id");
        $sql->bindParam(":paciente_id", $paciente_id);
        $sql->execute();

        foreach ($sql->fetchAll() as $recetaPaciente) {
            //por cada fila recorrida, se usa el constructor para crear un objeto con los datos de esa fila
            //agregamos ese objeto resultante, al arraya
            $nuevaReceta = new Receta(
                $recetaPaciente['id_receta'],
                $recetaPaciente['paciente_id'],
                $recetaPaciente['imagen_receta'],
                $recetaPaciente['nombre'],
                $recetaPaciente['fecha'],
                $recetaPaciente['estado'],
                $recetaPaciente['codigo_nacional'],
                $recetaPaciente['observaciones'],
            );
            $listaRecetasPaciente[] = $nuevaReceta;
        }
        return $listaRecetasPaciente;
    }

    }

