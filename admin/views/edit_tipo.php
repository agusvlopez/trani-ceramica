<?PHP
$id = $_GET['id'] ?? FALSE;
$tipo = (new Tipo())->get_por_id($id);
?>

<div class="p-4 mt-5 m-0 mx-auto">
    <div class="container">
        <h1 class="text-center fs-3 text-uppercase fw-bold h1Espaciado pt-5 color-panel"><?= $titulo ?></h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_tipo_acc.php?id=<?= $tipo->getId() ?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= $tipo->getNombre()?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?= $tipo->getDescripcion()?>">
                </div>

                <button type="submit" class="btn btn-dark d-block m-2 mt-3">Editar</button>

            </form>
        </div>
    </div>
</div>