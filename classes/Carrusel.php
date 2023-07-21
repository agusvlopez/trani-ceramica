<?PHP

class Carrusel {

    private $id;

private $img1;
private $img2;
private $img3;
private $alt1;
private $alt2;
private $alt3;

/**
 * Devuelve el catálogo completo
 * 
 * @return array Un array de objetos Carrusel 
 */

 public function carrusel_completo(): array {

    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM carrusel";
    
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);

    $PDOStatement->execute();

    $carrusel = $PDOStatement->fetchAll();

    foreach($carrusel as $value){
        $img = new self();
         $img->img1 = $value->img1;
         $img->img2 = $value->img2;
         $img->img3 = $value->img3;
         $img->alt1 = $value->alt1;
         $img->alt2 = $value->alt2;
         $img->alt3 = $value->alt3;
        

         $result [] = $img;
    }
    return $result;
    }

    /**
     * Devuelve los datos de un carrusel
     * @param int id único del artista
     */
    public function get_por_id(int $id): ?Carrusel
    {
       $conexion = Conexion::getConexion();
       $query = "SELECT * FROM carrusel WHERE id = ?";

       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
       $PDOStatement->execute(
           [$id]
       );

       $result = $PDOStatement->fetch();

       return $result ?? null;
    }


    /**
     * Edita el carrusel en la base de datos
     * @param string $img1
     * @param string $img2
     * @param string $img3
     * @param string $alt1
     * @param string $alt2
     * @param string $alt3
     */
    public function edit(string $img1, string $img2,string $img3, string $alt1, string $alt2, string $alt3)
    {
       $conexion = Conexion::getConexion();
       $query = "UPDATE carrusel SET img1 = :img1, img2 = :img2, img3 = :img3, alt1 = :alt1, alt2 = :alt2, alt3 = :alt3 WHERE id = :id";
       $PDOStatement = $conexion->prepare($query);
       $PDOStatement->execute(
           [
                'id' => $this->id,
                'img1' => $img1,
                'img2' => $img2,
                'img3' => $img3,
                'alt1' => $alt1,
                'alt2' => $alt2,
                'alt3' => $alt3
           ]
          
       );
    }
    
/**
 * Get the value of img1
 */
public function getImg1()
{
return $this->img1;
}

/**
 * Get the value of img2
 */
public function getImg2()
{
return $this->img2;
}

/**
 * Get the value of img3
 */
public function getImg3()
{
return $this->img3;
}

/**
 * Get the value of alt1
 */
public function getAlt1()
{
return $this->alt1;
}

/**
 * Get the value of alt2
 */
public function getAlt2()
{
return $this->alt2;
}

/**
 * Get the value of alt3
 */
public function getAlt3()
{
return $this->alt3;
}

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}