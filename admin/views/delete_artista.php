<?PHP
$id = $_GET['id'] ?? FALSE;
$artista = (new Artista())->get_por_id($id);
?>

<div class="container">
<div class="row my-5 g-3 ">
	<h1 class="text-center mb-5 fw-bold mt-5">¿Está seguro/a que desea eliminar este artista?</h1>
	<div class="col-12 col-md-6">
		<img src="../img/artistas/<?= $artista->getImagen() ?>" alt="Imagen de <?= $artista->getNombre() ?>" class="img-fluid shadow-sm d-block mx-auto mb-1">
	</div>

	<div class="col-12 col-md-6">


		<h2 class="fs-6">Nombre</h2>
		<p><?= $artista->getNombre() ?></p>

		<h2 class="fs-6">Descripción</h2>
		<p><?= $artista->getDescripcion() ?></p>
		

		<a href="actions/delete_artista_acc.php?id=<?= $artista->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>



</div>
</div>