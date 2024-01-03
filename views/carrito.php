<?PHP 

$productos = (new Carrito())->get_carrito();

?>
<h1 class="text-center mb-3 fs-3 text-uppercase fw-bold pb-4 pt-5 card-title btn-espaciado mt-5"><?= $titulo ?></h1>
<div class="container my-4">
    <?PHP if (count($productos)) { ?>
        <form action="admin/actions/update_productos_acc.php" method="POST">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col" width="35%"></th>
                        <th scope="col" width="25%">Producto</th>
                        <th scope="col" width="15%">Cantidad</th>
                        <th class="text-end" scope=" col" width="15%">Precio Unitario</th>
                        <th class="text-end" scope="col" width="15%">Subtotal</th>
                        <th class="text-end" scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($productos as $key => $item) { ?>
                        <tr>
                            <td><img src="img/covers/<?= $item['imagen'] ?>" alt="Imagen de <?= $item['producto'] ?>" class="img-fluid rounded shadow-sm"></td>

                            <td class="align-middle">
                                <h2 class="h5"><?= $item['producto'] ?></h2>
                            </td>
                            <td class="align-middle">
                                <label for="c_<?= $key ?>" class="visually-hidden">Cantidad</label>
                                <input type="number" class="form-control" value="<?= $item['cantidad'] ?>" id="c_<?= $key ?>" name="c[<?= $key ?>]">
                            </td>
                            <td class="text-end align-middle">
                                <p class="h5 py-3">$<?= number_format($item['precio'], 2, ",", ".") ?></p>
                            </td>
                            <td class="text-end align-middle">
                                <p class="h5 py-3"> $<?= number_format($item['cantidad'] * $item['precio'], 2, ",", ".") ?></p>
                            </td>
                            <td class="text-end align-middle">
                                <a href="admin/actions/remove_producto_acc.php?id=<?= $key ?>" class="btn btn-sm btn-danger rounded-50 m-3 p-2"><img src="img/iconos/trash-icon.png" alt="Icono de tacho de basura"></a>
                            </td>
                        </tr>
                    <?PHP } ?>

                    <tr>
                        <td colspan="4" class="text-end">
                            <h2 class="h5 py-3">Total:</h2>
                        </td>
                        <td class="text-end">
                            <p class="h5 py-3">$<?= number_format((new Carrito())->precio_total(), 2, ",", ".") ?></p>
                        </td>
                        <td></td>
                    </tr>
                </tbody>

            </table>

            <div class="d-flex justify-content-end gap-2">
                <a href="admin/actions/vaciar_carrito_acc.php" role="button" class="btn btn-secondary"> <img src="img/iconos/trash-icon.png" alt="Icono de tacho de basura"> </a>
                <input type="submit" value="Actualizar Carrito" class="btn bgDorado">
                <a href="index.php?link=piezas" role="button" class="btn btn-outline-dark rounded-0">Ver más productos</a>
                <a href="index.php?link=panel_usuario" role="button" class="btn bg-dark p-2 text-light text-uppercase rounded-0">Iniciar Compra</a>
            </div>

        </form>
    <?PHP } else { ?>
        <h2 class="text-center mb-5 text-danger text-uppercase fs-5">El carrito esta vacio</h2>
    <?PHP } ?>


</div>