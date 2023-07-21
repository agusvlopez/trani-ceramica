<?PHP

class Coleccion 
{
    private $id;
    private $nombre_coleccion;
    private $descripcion_coleccion;

    /**
    * Devuelve el listado completo de coleccion
     * 
     * @return Coleccion[] Devuelve un array de objetos Coleccion
    */
    public function listado_completo(): array {
    
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM coleccion";
        
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

     public function get_por_id(int $id): ?Coleccion
     {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM coleccion WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ?? null;
     }

    /**
     * Inserta un/a nuevo/a artista en la base de datos 
     * @param string $nombre_coleccion
     * @param string $descripcion_coleccion
     */
    public function insert(string $nombre_coleccion, string $descripcion_coleccion)
    {
       $conexion = Conexion::getConexion();
       $query = "INSERT INTO `coleccion` (`id`, `nombre_coleccion`, `descripcion_coleccion`) VALUES (NULL, :nombre_coleccion, :descripcion_coleccion)";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
               'nombre_coleccion' => $nombre_coleccion,
               'descripcion_coleccion' => $descripcion_coleccion,
           ] 
       );
    }
   
   /**
    * Edita una colección en la base de datos 
    * @param string $nombre_coleccion
    * @param string $descripcion_coleccion
    */
   public function edit($nombre_coleccion, $descripcion_coleccion)
   {
      $conexion = Conexion::getConexion();
      $query = "UPDATE coleccion SET nombre_coleccion = :nombre_coleccion, descripcion_coleccion = :descripcion_coleccion WHERE id = :id";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute(
          [
               'id' => $this->id,
              'nombre_coleccion' => $nombre_coleccion,
              'descripcion_coleccion' => $descripcion_coleccion
          ]
         
      );
   }
   
    /**
    * Eliminar una coleccion en la base de datos 
    */
   public function delete()
   {
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM coleccion WHERE id = ?";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute([$this->id]);        
   
   }

    /**
     * Get the value of nombre_coleccion
     */
    public function getNombre()
    {
        return $this->nombre_coleccion;
    }

    /**
     * Get the value of descripcion_coleccion
     */
    public function getDescripcionColeccion()
    {
        return $this->descripcion_coleccion;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}