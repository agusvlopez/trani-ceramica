<?PHP

class Pieza {

    private $id;
    private $titulo;
    private $tipo;
    private $artista;
    private $imagen;
    private $descripcion;
    private $tamanio;
    private $color;
    private $colores_de_piezas;
    private $precio;
    private $coleccion;
    private $publicacion;

    //propiedad estatica, independientemente de que instanciemos, esto va a ser siempre lo mismo..
    private static $createValue = ['id', 'titulo', 'imagen', 'descripcion', 'precio', 'publicacion'];


    /**
     * Inserta una nueva pieza a la base de datos
     * @param string $titulo
     * @param int $tipo_id
     * @param int $artista_id
     * @param string $descripcion
     * @param int $tamanio_id
     * @param int $color_id
     * @param float $precio 
     * @param int $coleccion 
     * @param string $publicacion El dia de publicación en formato YYYY-DD-MM 
     * @param string $imagen ruta a un archivo .jpg o .png 
     */
    public function insert($titulo, $tipo_id, $artista_id, $descripcion, $tamanio_id, $color_id, $precio, $coleccion_id, $publicacion, $imagen)
    {
       $conexion = Conexion::getConexion();
       $query = "INSERT INTO piezas VALUES (NULL, :titulo, :tipo_id, :artista_id, :tamanio_id, :publicacion, :descripcion, :imagen, :precio, :color_id, :coleccion_id)";

       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
            [
               'titulo' => $titulo,
               'tipo_id' => $tipo_id,
               'artista_id' => $artista_id,
               'descripcion' => $descripcion,
               'tamanio_id' => $tamanio_id,             
               'color_id' => $color_id,
               'precio' => $precio,
               'coleccion_id' => $coleccion_id,
               'publicacion' => $publicacion,
               'imagen' => $imagen,
            ] 
       );
       //devuelve el id de la ultima fila insertada
       return $conexion->lastInsertId();
    }
   
   /**
    * Edita una pieza en la base de datos 
    */
   public function edit($titulo, $tipo_id, $artista_id, $tamanio_id, $publicacion , $descripcion, $imagen, $precio, $color_id, $coleccion_id)
   {

      $conexion = Conexion::getConexion();
      $query = "UPDATE piezas SET
      titulo = :titulo,
      tipo_id = :tipo_id,
      artista_id = :artista_id,
      tamanio_id = :tamanio_id,
      publicacion = :publicacion,
      descripcion = :descripcion,
      imagen = :imagen,
      precio = :precio,
      color_id = :color_id,
      coleccion_id = :coleccion_id
    WHERE id = :id";

      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute(
          [
               'id' => $this->id,
               'titulo' => $titulo,
               'tipo_id' => $tipo_id,
               'artista_id' => $artista_id,
               'tamanio_id' => $tamanio_id,
               'publicacion' => $publicacion,
               'descripcion' => $descripcion,
               'imagen' => $imagen,
               'precio' => $precio,
               'color_id' => $color_id,
               'coleccion_id' => $coleccion_id,
          ]
         
      );
   }
   
    /**
    * Eliminar una pieza en la base de datos 
    */
   public function delete()
   {
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM piezas WHERE id = ?";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute([$this->id]);        
   
   }

    /**
     * Devuelve el catálogo completo..
    * 
    * @return array Un array de objetos Pieza 
    */
    public function catalogo_completo(): array {
    $catalogo = [];
    $conexion = (new Conexion())->getConexion();
    $query = "SELECT piezas.*, GROUP_CONCAT(colores_de_piezas.color_id) as colores_de_piezas FROM `piezas` LEFT JOIN colores_de_piezas ON piezas.id = colores_de_piezas.pieza_id GROUP BY piezas.id";
    
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);

    $PDOStatement->execute();

    while ($result = $PDOStatement->fetch()) {
        $catalogo[] = $this->createPieza($result);
    }
    
    return $catalogo;
    }

    /**
    * Devuelve el catalogo de productos de una Pieza en particular
    * @param int $tipo_id Un string con el nombre de la pieza a buscar
    * 
    * @return Pieza[] Un array con instancias del objeto Pieza
    */
    public function catalogo_por_pieza(int $tipo_id): array {

    $catalogo_por_pieza = [];

    $conexion = Conexion::getConexion();
    $query = "SELECT piezas.*, GROUP_CONCAT(colores_de_piezas.color_id) as colores_de_piezas FROM piezas LEFT JOIN colores_de_piezas ON colores_de_piezas.pieza_id = piezas.id WHERE piezas.tipo_id = ? GROUP BY piezas.id";

    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);

    $PDOStatement->execute([$tipo_id]);

    while ($result = $PDOStatement->fetch()){
        $catalogo_por_pieza[] = $this->createPieza($result);
    } 

    return $catalogo_por_pieza;
    }

    /**
    * Devuelve una instancia del objeto Pieza, con todas sus propiedades configuradas
    */
    private function createPieza($piezaData): Pieza {

    $pieza = new self();
    //hay que configurar el objeto...
    foreach(self::$createValue as $value){
        $pieza->{$value} = $piezaData[$value];
    }

    //guardamos los datos correspondientes de las propiedades
    $pieza->tipo = (new Tipo())->get_por_id($piezaData['tipo_id']);
    $pieza->artista = (new Artista())->get_por_id($piezaData['artista_id']);
    $pieza->tamanio = (new Tamanio())->get_por_id($piezaData['tamanio_id']);
    $pieza->color = (new Color())->get_por_id($piezaData['color_id']);
    $coloresIds = !empty($piezaData['colores_de_piezas']) ? (explode(",", $piezaData['colores_de_piezas'])) : [];
    $colores_de_piezas = [];
    if(!empty($coloresIds[0])){
        foreach($coloresIds as $colorId){
            $colores_de_piezas[] = (new Color())->get_por_id(intval($colorId));
        }
    }
    $pieza->colores_de_piezas = $colores_de_piezas;
    $pieza->coleccion = (new Coleccion())->get_por_id($piezaData['coleccion_id']);

    return $pieza;
    }


/**
 * Devuelve los datos de un producto en particular
 * @param int $idProducto El ID del producto a mostrar
 * 
 * @return ?Pieza dedevuelve un objeto Pieza o null
 */
public function pieza_por_id(int $idProducto): ?Pieza {

    $conexion = Conexion::getConexion();
    $query = "SELECT piezas.*, GROUP_CONCAT(colores_de_piezas.color_id) AS colores_de_piezas FROM piezas LEFT JOIN colores_de_piezas ON colores_de_piezas.pieza_id = piezas.id WHERE piezas.id = ? GROUP BY piezas.id";

    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute([$idProducto]);

    $result = $this->createPieza($PDOStatement->fetch());

    return $result ?? null;
}


/**
 * Devuelve el precio de la unidad con el formato argentino
 */
public function number_format(): string{
    return number_format($this->getPrecio(), 2, ",", ".");
}

/**
 * Esta funcion devuelve las primeras x palabras de un parrafo
 * @param int $cantidad Esta es la cantidad de palabras a reducir (opcional)
 * @return string La cantidad de palabras solicitadas con ... al final
 */
public function recortar_descripcion(int $cantidad = 10):string {
    $texto = $this->getDescripcion();

    $array = explode(" ",$texto);
    if(count($array)<= $cantidad) {
        $resultado = $texto;
    }else {
        array_splice($array, $cantidad);
        $resultado = implode(" ", $array)."...";
    }
    return $resultado;
   
   }

    /**
     * Devuelve los datos las piezas segun el color seleccionado
     * @param int $color_id El color de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con las instancias de objeto Pieza que corresponden al filtro por color
     */
     public function pieza_por_color(int $color_id):array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM piezas WHERE color_id = $color_id";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $color_por_pieza = $PDOStatement->fetchAll();
    
        return $color_por_pieza;        
     }

     /**
     * Devuelve los datos las piezas segun el precio seleccionado
     * @param int $precio El precio de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con las instancias de objeto Pieza que corresponden al filtro por precio
     */

     public function pieza_por_precio(int $precio):array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM `piezas` WHERE precio <= $precio";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $precio_por_pieza = $PDOStatement->fetchAll();

         foreach ($precio_por_pieza as $pm) {      
             
                 $resultadoPrecio[] = $pm;     
         }
     
        return $resultadoPrecio;
        
     }


    /**
     * Devuelve los datos de las piezas segun el tipo y el color seleccionado
     * @param int $tipo_id El tipo de la pieza que se va a mostrar
     * @param int $color_id El color de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con instancias de objeto Pieza con los datos encontrados o un null si no se encontró ninguna pieza de ese color y tipo
     */

     public function pieza_por_(int $tipo_id, int $color_id):array{
        
        $resultadoTipo = [];
        $resultadoColorTipo = [];

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM `piezas` WHERE color_id = $color_id AND tipo_id = $tipo_id";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $tipo_color_pieza = $PDOStatement->fetchAll();
       
        foreach ($tipo_color_pieza as $p) {
            
                $resultadoTipo[] = $p;             
            }
        foreach($resultadoTipo as $p){
             
                    $resultadoColorTipo[] = $p; 
            } 
            
           return $resultadoColorTipo;
        }

        /**
     * Devuelve los datos de las piezas segun el tipo y el color seleccionado
     * @param int $tipo_id El tipo de la pieza que se va a mostrar
     * @param int $precio El precio de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con instancias de objeto Pieza con los datos encontrados o un null si no se encontró ninguna pieza de ese color y tipo
     */

     public function pieza_por_tipo_precio(int $tipo_id, int $precio):array{
        
    
        $resultadoTipo = [];
        $resultadoTipoPrecio = [];

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM `piezas` WHERE tipo_id = $tipo_id AND precio <= $precio";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $tipo_precio_piezas = $PDOStatement->fetchAll();
       
       
        foreach ($tipo_precio_piezas as $t) {       

                $resultadoTipo[] = $t;
                 
            }
            foreach($resultadoTipo as $p){
                
                    $resultadoTipoPrecio[] = $p;  
     
            } 
            
           return $resultadoTipoPrecio;
        }

        /**
     * Devuelve los datos de las piezas segun el color y el rango de precio seleccionado
     * @param int $color_id El color de la pieza que se va a mostrar
     * @param int $precio El rango de precio de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con instancias de objeto Pieza con los datos encontrados o un null si no se encontró ninguna pieza de ese color y rango de precio
     */

     public function pieza_por_color_precio(int $color_id, int $precio):array{
        
        $resultadoColor = [];
        $resultadoColorPrecio = [];

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM `piezas` WHERE color_id = $color_id AND precio <= $precio";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $color_precio_piezas = $PDOStatement->fetchAll();
       
       
        foreach ($color_precio_piezas as $c) {
            
                $resultadoColor[] = $c; 
                 
            }  
        foreach($resultadoColor as $p){

                $resultadoColorPrecio[] = $p; 
                
                }

            return $resultadoColorPrecio;  
           
        }

    /**
     * Devuelve los datos de las piezas segun el tipo y el color seleccionado
     * @param int $tipo_id El tipo de la pieza que se va a mostrar
     * @param int $color_id El color de la pieza que se va a mostrar
     * @param int $precio El precio de la pieza que se va a mostrar
     * 
     * @return Pieza[] devuelve un array con instancias de objeto Pieza con los datos encontrados o un null si no se encontró ninguna pieza de ese color y tipo
     */

     public function pieza_por_tipo_color_precio(int $tipo_id, int $color_id,int $precio):array{
        
        $resultadoTipo = [];
        $resultadoColorTipo = [];
        $resultadoColorTipoPrecio = [];

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM `piezas` WHERE tipo_id = $tipo_id AND color_id = $color_id AND precio <= $precio";
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    
        $PDOStatement->execute();
    
        $tipo_color_precio_piezas = $PDOStatement->fetchAll();
       
       
        foreach ($tipo_color_precio_piezas as $p) {

                $resultadoTipo[] = $p;   
                
            }
            foreach($resultadoTipo as $p){

                    $resultadoColorTipo[] = $p; 

            } 
            foreach($resultadoColorTipo as $p){

                    $resultadoColorTipoPrecio[] = $p; 
     
            } 

           return $resultadoColorTipoPrecio;
        }

    /**
     * Devuelve los nombres de los tipos de piezas que existen
     * @return array Devuelve un array con la lista de nombres de los tipos de piezas que hay 
     */

    public function listar_tipos_piezas(): array {

     $conexion = Conexion::getConexion();
     $query = "SELECT DISTINCT
        tipo.id,
        tipo.nombre
      
        FROM piezas 
        JOIN tipo ON piezas.tipo_id = tipo.id;";

     $PDOStatement = $conexion->prepare($query);
     $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
     $PDOStatement->execute();

     $lista = $PDOStatement->fetchAll();

     return $lista;
 }

 
    /**
     * Crea un vinculo entre una pieza y los colores
     * @param int $pieza_id
     * @param int $tipo_id
     * @param int $color_id
     */
    public function add_colores(int $pieza_id, int $tipo_id, int $color_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO colores_de_piezas VALUES (NULL, :pieza_id, :tipo_id, :color_id)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'pieza_id' => $pieza_id,
                'tipo_id' => $tipo_id,
                'color_id' => $color_id,      
            ]
        );
    }

        /**
     * Vaciar lista de colores secundarios
     * @param int $pieza_id
     */
    public function vaciar_colores_secundarios()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM colores_de_piezas WHERE pieza_id = :pieza_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'pieza_id' => $this->id
            ]
        );
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->titulo;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the value of tama
     */
    public function getTamaño()
    {
        return $this->tamanio;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the value of artista_id
     */
    public function getArtistaId()
    {
        return $this->artista;
    }

    /**
     * Get the value of coleccion_id
     */
    public function getColeccionId()
    {
        return $this->coleccion;
    }

    /**
     * Get the value of publicacion
     */
    public function getPublicacion()
    {
        return $this->publicacion;
    }

    /**
     * Get the value of colores_de_piezas
     */
    public function getColoresDePiezas()
    {
        return $this->colores_de_piezas;
    }

    /**
     * Devuelve un array con los IDs de los colores secundarios
     */
    public function get_ids_colores_secundarios() :array {

        $resultado = [];

        foreach($this->colores_de_piezas as $value) {
            $resultado[] = intval($value->getId());
        }
        return $resultado;
    }
}