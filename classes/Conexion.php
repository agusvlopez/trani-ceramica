<?php

/**
 * Clase para proveer la conexión PDO del proyecto.
 */
class Conexion {

    private const DB_HOST = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private const DB_NAME = "tienda_ceramica";
    private const DB_DSN = "mysql:host=" . self::DB_HOST  . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";

    //quiero guardar un objeto PDO funcionando... le puedo definir el tipo de dato que va a tener, en este caso va a ser un tipo de dato PDO

    private static ?PDO $db = null;
    //metodo magico __construct: metodo que va a dispararse automaticamente cuando se instancie la clase...
    private static function conectar()
    {
        try {
            // codigo que vamos a tratar de ejecutar, si en algun momento en este bloque llegas a encontrar un exception, ejecuto el catch para intentar 'atrapar' ese error, si no me tira ninguna, salteo el catch y ejecuto lo siguiente// puede ser mas de una linea de codigo

            self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e){
        // en este caso cacho una Exception y tengo que guardarla en una variable, por convencion se suele guardar en una variable $e
        
        echo "<p>Encontramos un problema accediendo a la base de datos. Estamos trabajando para solucionarlo. Por favor intente más tarde.</p>";
        //para acceder a la información
        //     echo "<pre>";
        //     print_r($e);
        //     echo "</pre>";
        // //para acceder a la información de forma mas prolija
        //     echo "<p>Se genero un error en el siguiente archivo: </p>" . $e->getFile();
        //     echo "<p>El error esta en la siguiente linea: </p>" . $e->getLine();
        
            //hay que cortar manualmente la ejecucion del codigo porque si no puedo acceder a la base de datos, no puedo seguir. Esto lo hacemos con un die, se puede poner asi solo o con un parametro...
        
            die('<p>Hubo un error al conectarse con MySQL</p>');
        }
    }
/**
 * Método que devuelve la conexión PDO lista para usar 
 * @return PDO
 */
 public static function getConexion(): PDO 
 {
    if(self::$db === null){
        self::conectar();
    }
    return self::$db;
 }
    
 

}