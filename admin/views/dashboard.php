<?PHP


$compras = (new Compra())->traer_datos_compra();



?>

<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
        <h1 class="text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 color-panel"><?= $titulo ?></h1>

    <div class="pt-3 p-2 row">
        <div>
            <h2 class="fs-4 p-2">Las compras realizadas hoy: <span><?= (date("Y-m-d", time())) ?></span> </h2>

    <div class="pt-3 p-2">
        
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Usuario</th>
                <th scope="col">Pieza</th>
                <th scope="col">Cantidad de items</th>
                <th scope="col">Importe</th>
            </tr>
        </thead>

    <tbody>
    
    <?PHP foreach($compras as $key) { ?>

        <?PHP if((date("Y-m-d", time())) == $key->fecha){ ?>

            
    <tr>
        <td><?= $key->fecha; ?></td>
        <td><?= (new Usuario())-> usuario_x_id(intval($key->id_usuario))->getNombreUsuario(); ?></td>
        <td><?= (new Pieza())-> pieza_por_id(intval($key->pieza))->getNombre(); ?></td>
        <td class="text-center"><?= $key->cantidad; ?></td>
        <td>$<?= $key->importe; ?></td>
    </tr>
    <?PHP } ?>
    <?PHP } ?>
        
        <tr>
            <td colspan="4" class="text-end">
                <h2 class="h5 py-3">Total:</h2>
            </td>
            <td class="text-end">
                <p class="h5 py-3">$<?= number_format((new Compra())->importe_total(), 2, ",", ".") ?></p>
            </td>
                        
        </tr>
    </tbody> 
    
    </table>
    </div>
    </div>
</div>

