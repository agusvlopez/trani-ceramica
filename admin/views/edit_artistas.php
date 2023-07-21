<?PHP
$id = $_GET['id'] ?? FALSE;
$artista = (new Artista())->get_por_id($id);
?>

<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
        <h1 class="text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 color-panel"><?= $titulo ?></h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_artista_acc.php?id=<?= $artista->getId() ?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= $artista->getNombre()?>">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="imagen" class="form-label">Imagen actual</label>
                    <img src="../img/artistas/<?= $artista->getImagen()?>" alt="Imagen de <?= $artista->getNombre()?>" class="edit-img">
                    <input class="form-control" type="hidden" id="imagen_original" name="imagen_original" value="<?= $artista->getImagen()?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="imagen" class="form-label">Reemplazar imagen</label>
                    <input class="form-control" type="file" id="imagen" name="imagen">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"><?= $artista->getDescripcion()?></textarea>
                </div>

                <button type="submit" class="btn btn-dark d-block m-2 mt-3">Editar</button>

            </form>
        </div>
    </div>
</div>

