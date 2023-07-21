<?PHP
$tipos = (new Tipo())->listado_completo();

?>
<section>
<div class="pt-4 pb-4 mt-5 m-0 mx-auto">
    <h1 class="color-panel text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 pb-4"><?= $titulo ?>
    </h1>
</div>
<div class="container">

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
            <?PHP foreach($tipos as $tipo) { ?>
            <tr>

                <td> <?= $tipo->getNombre() ?> </td>
                <td> <?= $tipo->getDescripcion() ?> </td>
                <td>
                    <a href="index.php?link=edit_tipo&id=<?=$tipo->getId()?>" role="button
                    " class="btn mb-2"><img src="../img/iconos/edit-icon.png" alt="Icono de editar" class="img-fluid icono-admin"></a>
                    <a href="index.php?link=delete_tipo&id=<?=$tipo->getId()?>" role="button
                    " class="btn btn-danger mb-2"><img src="../img/iconos/trash-icon.png" alt="Icono de tacho de basura" class="img-fluid icono-admin"></a>
                </td>
            </tr>

            <?PHP } ?>
        </tbody>
    </table>
    <a href="?link=add_tipo" role="button" class="btn btn-dark d-block m-2">Agregar Tipo</a>
    </div>
   
</div>

</section>