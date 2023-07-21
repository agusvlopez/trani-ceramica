<?PHP

class Tipo 
{
    private $id;
    private $nombre;
    private $descripcion;
    
    /**
    * Devuelve el listado completo de tipos
     * 
     * @return Tipo[] Devuelve un array de objetos Tipo
    */
    public function listado_completo(): array {
    
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM tipo";
        
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $listado = $PDOStatement->fetchAll();

        return $listado;
    }

    /**
    * Devuelve el catálogo completo
     * 
     * @return array Devuelve un array de objeto Pieza 
    */
    public function tipo_completo(): array {
    
    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM tipo";
    
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);

    $PDOStatement->execute();

    $catalogo = $PDOStatement->fetchAll();

    // echo "<pre>";
    // print_r($catalogo);
    // echo "</pre>";
    
    return $catalogo;
    }

    /**
     * Devuelve los datos de un tipo de pieza en particular
     * @param int id único del tipo
     */
    public function get_por_id(int $id): ?Tipo
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM tipo WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        return $result ?? null;
    }

    /**
     * Inserta un nuevo tipo en la base de datos 
     * @param string $nombre
     * @param string $descripcion
     */
    public function insert(string $nombre, string $descripcion)
    {
       $conexion = Conexion::getConexion();
       $query = "INSERT INTO `tipo` (`id`, `nombre`, `descripcion`) VALUES (NULL, :nombre, :descripcion)";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
               'nombre' => $nombre,
               'descripcion' => $descripcion,
           ] 
       );
    }
   
   /**
    * Edita un tipo en la base de datos 
    * @param string $nombre
    * @param string $descripcion
    */
    public function edit($nombre, $descripcion)
    {
      $conexion = Conexion::getConexion();
      $query = "UPDATE tipo SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute(
          [
               'id' => $this->id,
              'nombre' => $nombre,
              'descripcion' => $descripcion
          ]
         
      );
    }
   
    /**
    * Eliminar un tipo en la base de datos 
    */
    public function delete()
    {
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM tipo WHERE id = ?";
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
}