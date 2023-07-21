<?PHP
$id = $_GET['id'] ?? FALSE;
$coleccion = (new Coleccion())->get_por_id($id);
?>

<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
        <h1 class="text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 color-panel"><?= $titulo ?></h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_coleccion_acc.php?id=<?= $coleccion->getId() ?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-3">
                    <label for="nombre_coleccion" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_coleccion" name="nombre_coleccion" required value="<?= $coleccion->getNombre()?>">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion_coleccion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion_coleccion" name="descripcion_coleccion"><?= $coleccion->getDescripcionColeccion()?></textarea>
                </div>

                <button type="submit" class="btn btn-dark d-block m-2 mt-3">Editar</button>

            </form>
        </div>
    </div>
</div>

