<?PHP

class Artista 
{
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;

    /**
    * Devuelve el listado completo de artistas
     * 
     * @return Artista[] Devuelve un array de objetos Artista
    */
    public function listado_completo(): array {
    
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM artistas";
        
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $listado = $PDOStatement->fetchAll();
    

        return $listado;
    }
    /**
     * Devuelve los datos de un artista en particular
     * @param int id único del artista
     */
     public function get_por_id(int $id): ?Artista
     {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM artistas WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [$id]
        );

        $result = $PDOStatement->fetch();

        return $result ?? null;
     }

    /**
     * Inserta un/a nuevo/a artista en la base de datos 
     * @param string $nombre
     * @param string $descripcion
     * @param string $imagen
     */
     public function insert(string $nombre, string $descripcion, string $imagen)
     {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `artistas` (`id`, `nombre`, `descripcion`, `imagen`) VALUES (NULL, :nombre, :descripcion, :imagen)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'imagen' => $imagen,
            ]
           
        );
     }
    
    /**
     * Edita un/a artista en la base de datos 
     * @param string $nombre
     * @param string $descripcion
     * @param string $imagen ruta a un archivo jpg, webp o png
     */
    public function edit($nombre, $descripcion, $imagen)
    {
       $conexion = Conexion::getConexion();
       $query = "UPDATE artistas SET nombre = :nombre, descripcion = :descripcion, imagen = :imagen WHERE id = :id";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
                'id' => $this->id,
               'nombre' => $nombre,
               'descripcion' => $descripcion,
               'imagen' => $imagen
           ]
          
       );
    }
    
     /**
     * Eliminar un/a artista en la base de datos 
     */
    public function delete()
    {
       $conexion = Conexion::getConexion();
       $query = "DELETE FROM artistas WHERE id = ?";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute([$this->id]);        
    
    }

     /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }
}