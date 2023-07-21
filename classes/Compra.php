<?PHP 


class Compra {

    /**
     * Trae los datos principales de la compra, incluyendo codigo de compra, usuario, piezas compradas, precio total y cantidad
     */

     public function traer_datos_compra (): array {
        $result = [];

        $conexion = Conexion::getConexion();
        $query = "SELECT compras.* , GROUP_CONCAT(item_por_compra.id_compra) as codigo_compra, GROUP_CONCAT(item_por_compra.id_pieza) as pieza, GROUP_CONCAT(item_por_compra.cantidad) as cantidad FROM compras LEFT JOIN item_por_compra ON compras.id = item_por_compra.id_compra GROUP BY compras.id";  
    
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetchAll();
    
        return $result ?? null;
    }

     /**
     * Devuelve el importe total de las compras del dia de la fecha
     */
    public function importe_total(): float{

        $compras = (new Compra())->traer_datos_compra();
        $total = 0;

        foreach($compras as $c) {
            if((date("Y-m-d", time())) == $c->fecha){
            $total += $c->importe;

            }

        }

            return $total;
        }
    
}

    
