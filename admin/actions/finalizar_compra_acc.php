<?PHP
require_once "../../functions/autoload.php";

$items = (new Carrito())-> get_carrito();
$usuarioId = $_SESSION['loggedIn']['id'] ?? FALSE;

echo "<pre>";
print_r($usuarioId);
echo "</pre>";

try {
if($usuarioId){
    $datosCompra = [
        "id_usuario" => $usuarioId, //el id de usuario lo tengo que sacar del login
        "fecha" => date("Y-m-d", time()),
        "importe" => (new Carrito())->precio_total()
    ];

    $detalleCompra = [];

    foreach($items as $key => $value) {
        $detalleCompra[$key] = $value['cantidad'];
    }


    (new Carrito())->insertar_data($datosCompra, $detalleCompra);
    (new Carrito())->vaciar_carrito();
    // (new Alerta())->add_alerta('success', "Compra realizada con éxito! Ya te enviamos un mail con el detalle de compra.");
    header('location: ../../index.php?link=resumen_pago');

}else {
    (new Alerta())->add_alerta('danger', "Su sesión exipró, por favor ingrese nuevamente");
    header('location: ../index.php?link=login');
}
} catch(Exception $e) {

    echo "<pre>";
print_r($e);
echo "</pre>";
    (new Alerta())->add_alerta('danger', "No se pudo finalizar la compra");

}