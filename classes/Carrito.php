<?PHP 

class Carrito {


    /**
     * Agrega un producto al carrito de compras
     * @param int $productoId El ID del producto que se va a agregar
     * @param int $cantidad La cantidad de productos que se van a agregar
     */
    public function agregar_producto(int $productoId, int $cantidad) {

        $productoData = (new Pieza())->pieza_por_id($productoId);
        
        if($productoData) {
            $_SESSION['carrito'][$productoId] = [
                'producto' => $productoData->getNombre(),
                'imagen' => $productoData->getImagen(),
                'precio' => $productoData->getPrecio(),
                'cantidad' => $cantidad
            ];
        }
    }

    /**
     * Devuelve el contenido del carrito de compras
     */
    public function get_carrito(): array {
        if(!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        }else {
            return [];
        }
    }

    /**
     * Elimina un producto del carrito
     * @param int $productoId El ID del producto a eliminar
     */
    public function eliminar_producto(int $productoId) {

        if(isset($_SESSION['carrito'][$productoId])){
            unset($_SESSION['carrito'][$productoId]);
        }
    }

    /**
     * Vacia todo lo que hay cargado en el carrito
     */
    public function vaciar_carrito() {

        $_SESSION['carrito'] = [];
    }

    /**
     * Actualizar la cantidad de los IDs
     * @param array $cantidades Array asociativo con la cantidad de cada ID
     */

    public function actualizar_cantidades(array $cantidades){

        foreach($cantidades as $key => $value){

            if(isset($_SESSION['carrito'][$key])){
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }

    }

    /**
     * Devuelve el importe total del carrito
     */
    public function precio_total(): float{

        $total = 0;

        if(!empty($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $p){
                $total += $p['precio'] * $p['cantidad'];
            }

            return $total;
        }
    }

    /**
     * Inserta los datos de una compra en la base de datos
     */
    public function insertar_data(array $data, array $detalleData) {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :id_usuario, :fecha, :importe)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "id_usuario" => $data['id_usuario'], 
            "fecha" => $data['fecha'], 
            "importe" => $data['importe']
        ]);

        $isertedID = $conexion->lastInsertId();


        foreach ($detalleData as $key => $value) {
            $query = "INSERT INTO item_por_compra VALUES (NULL, :id_compra, :id_pieza, :cantidad)";
        
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "id_compra" => $isertedID, 
                "id_pieza" => $key, 
                "cantidad" => $value
            ]);
        }

    } 
}