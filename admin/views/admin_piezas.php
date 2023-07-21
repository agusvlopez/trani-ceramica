<?PHP 

$piezas = (new Pieza())-> catalogo_completo();

?>
<div class="my-5 container">
<div class="mx-auto">
    <h1 class="color-panel text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 pb-4"><?= $titulo ?>
    </h1>
        <div class="row mb-5 d-flex align-items-center">
            
            <div>
                <?= (new Alerta())->get_alertas(); ?>
            </div>
            
            <div class="pt-3 p-1 col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Arte</th>
                        <th scope="col">Tamaño</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Color principal</th>
                        <th scope="col">Colores secundarios</th>
                        <th scope="col">Colección</th>
                        <th scope="col">Acc</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($piezas as $p) { ?>
                        <tr>
                            <td><img src="../img/covers/<?= $p->getImagen() ?>" alt="Imagen de <?= $p->getNombre(); ?>" class="img-fluid rounded shadow-sm"></td>
                            <td><?= $p->getNombre(); ?></td>
                            <td><?= $p->getDescripcion(); ?></td>
                            <td><?= $p->getTipo()->getNombre(); ?></td>
                            <td><?= $p->getArtistaId()->getNombre(); ?></td>
                            <td><?= $p->getTamaño()->getNombre(); ?></td>
                            <td><?= $p->getPublicacion(); ?></td>
                            <td>$<?= $p->getPrecio(); ?></td>
                            <td><?= $p->getColor()->getNombre(); ?></td>
                            <td><?PHP 
                            foreach ($p->getColoresDePiezas() as $c) {
                                echo "<p>" . $c->getNombre() . "</p>";
                            }
                            ?></td>
                            <td><?= $p->getColeccionId()->getNombre(); ?></td>
                            <td>
                                <a href="index.php?link=edit_pieza&id=<?= $p->getId() ?>" role="button" class=" btn btn-sm mb-1 img-fluid"><img src="../img/iconos/edit-icon.png" alt="Icono de editar"></a>
                                <a href="index.php?link=delete_pieza&id=<?= $p->getId() ?>" role="button" class=" btn btn-sm btn-danger img-fluid"><img src="../img/iconos/trash-icon.png" alt="Icono de tacho de basura"></a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            
            </table>
            </div>
            <a href="index.php?link=add_pieza" class="btn btn-dark d-block m-2"> Cargar nueva Pieza</a>
        </div>
</div>   
</div>
