<?PHP

class Tamanio 
{
    private $id;
    private $nombre_medida;
    private $descripcion_medida;


    /**
    * Devuelve el listado completo de tamaños
    * 
    * @return Tamanio[] Devuelve un array de objetos Tamaño
    */
    public function listado_completo(): array {
    
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM tamanio";
        
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

     public function get_por_id(int $id): ?Tamanio
     {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM tamanio WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ?? null;
     }

     /**
     * Inserta un nuevo tamaño en la base de datos 
     * @param string $nombre_medida
     * @param string $descripcion_medida
     */
    public function insert(string $nombre_medida, string $descripcion_medida)
    {
       $conexion = Conexion::getConexion();
       $query = "INSERT INTO `tamanio` (`id`, `nombre_medida`, `descripcion_medida`) VALUES (NULL, :nombre_medida, :descripcion_medida)";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
               'nombre_medida' => $nombre_medida,
               'descripcion_medida' => $descripcion_medida
           ] 
       );
    }
   
   /**
    * Edita un tamaño en la base de datos 
    * @param string $nombre_medida   
    * @param string $descripcion_medida 
    */
    public function edit($nombre_medida, $descripcion_medida) 
        {
      $conexion = Conexion::getConexion();
      $query = "UPDATE tamanio SET nombre_medida = :nombre_medida, descripcion_medida = :descripcion_medida WHERE id = :id";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute(
          [
               'id' => $this->id,
              'nombre_medida' => $nombre_medida,
              'descripcion_medida' => $descripcion_medida
          ]   
      );
    }
   
    /**
    * Eliminar un tamaño en la base de datos 
    */
    public function delete()
    {
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM tamanio WHERE id = ?";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute([$this->id]);        
   
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre_medida;
    }

    /**
     * Get the value of descripcion_medida
     */
    public function getDescripcionMedida()
    {
        return $this->descripcion_medida;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}