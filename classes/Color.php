<?PHP

class Color 
{
    private $id;
    private $nombre;
    
    
    /**
    * Devuelve el listado completo de colores
     * 
     * @return Color[] Devuelve un array de objetos Color
    */
    public function listado_completo(): array {
    
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM colores";
        
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

     public function get_por_id(int $id): ?Color
     {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM colores WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);

        $result = $PDOStatement->fetch();

        return $result ?? null;
     }

    /**
     * Inserta un nuevo color en la base de datos 
     * @param string $nombre
     */
    public function insert(string $nombre)
    {
       $conexion = Conexion::getConexion();
       $query = "INSERT INTO `colores` (`id`, `nombre`) VALUES (NULL, :nombre)";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
               'nombre' => $nombre,
           ] 
       );
    }
   
   /**
    * Edita un color en la base de datos 
    * @param string $nombre
    */
   public function edit($nombre)
   {
      $conexion = Conexion::getConexion();
      $query = "UPDATE colores SET nombre = :nombre WHERE id = :id";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute(
          [
               'id' => $this->id,
              'nombre' => $nombre
          ]
         
      );
   }
   
    /**
    * Eliminar un color en la base de datos 
    */
   public function delete()
   {
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM colores WHERE id = ?";
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
}