<?PHP


class Personalizado {

private $img_1;
private $img_2;
private $img_3;
private $alt_1;
private $alt_2;
private $alt_3;

/**
 * Devuelve el catálogo completo
 * 
 * @return array Un array de objetos Carrusel Personalizado
 */

 public function carrusel_completo(): array {


    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM personalizado";

    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();

    $personalizados = $PDOStatement->fetchAll();
    
    foreach($personalizados as $value){
        $img = new self();
        $img->img_1 = $value->img_1;
        $img->img_2 = $value->img_2;
        $img->img_3 = $value->img_3;
        $img->alt_1 = $value->alt_1;
        $img->alt_2 = $value->alt_2;
        $img->alt_3 = $value->alt_3;
        

        $carrusel[] = $img;
    }
    return $carrusel;
    }


/**
 * Get the value of img1Personalizado
 */
public function getImg1Personalizado()
{
return $this->img_1;
}

/**
 * Get the value of img2Personalizado
 */
public function getImg2Personalizado()
{
return $this->img_2;
}

/**
 * Get the value of img3Personalizado
 */
public function getImg3Personalizado()
{
return $this->img_3;
}

/**
 * Get the value of alt1Personalizado
 */
public function getAlt1Personalizado()
{
return $this->alt_1;
}

/**
 * Get the value of alt2Personalizado
 */
public function getAlt2Personalizado()
{
return $this->alt_2;
}

/**
 * Get the value of alt3Personalizado
 */
public function getAlt3Personalizado()
{
return $this->alt_3;
}

}