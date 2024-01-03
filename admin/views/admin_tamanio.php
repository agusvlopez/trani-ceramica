<?PHP
$tamanios = (new Tamanio())->listado_completo();

?>
<section>
<div class="pt-4 pb-4 mt-5 m-0 mx-auto">
    <h1 class="color-panel text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 pb-4"><?= $titulo ?>
    </h1>
</div>
<div class="container">
    <div>
        <?= (new Alerta())->get_alertas(); ?>
    </div>
    <div class="pt-3 p-2">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?PHP foreach($tamanios as $t) { ?>
            <tr>

                <td> <?= $t->getNombre() ?> </td>
                <td> <?= $t->getDescripcionMedida() ?> </td>
                <td>
                    <a href="index.php?link=edit_tamanio&id=<?=$t->getId()?>" role="button
                    " class="btn mb-2 img-fluid"><img src="../img/iconos/edit-icon.png" alt="Icono de editar"></a>
                    <a href="index.php?link=delete_tamanio&id=<?=$t->getId()?>" role="button
                    " class="btn btn-danger mb-2 img-fluid"><img src="../img/iconos/trash-icon.png" alt="Icono de tacho de basura"></a>
                </td>
            </tr>

            <?PHP } ?>
        </tbody>
    </table>
    <a href="?link=add_tamanio" role="button" class="btn btn-dark d-block m-2">Agregar Tamaño</a>
    </div>
   
</div>

</section>