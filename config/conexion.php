<?php
class BD
{
    private static $instancia = NULL;
    public static function crearInstancia()
    {
        if (!isset(self::$instancia)) {
            $opcionesPDO = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            try {
                self::$instancia = new PDO('mysql:host=localhost;dbname=farma', 'root', '', $opcionesPDO);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
?>