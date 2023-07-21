<?PHP

$tipos = (new Tipo())->listado_completo();
$tamanios = (new Tamanio())->listado_completo();
$artistas = (new Artista())->listado_completo();
$colecciones = (new Coleccion())->listado_completo();
$colores = (new Color())->listado_completo();

?>

<div class="row my-5">
	<div class="col">

		<h1 class="text-center pt-5 fw-bold h1Espaciado text-uppercase fs-3 color-panel"><?= $titulo ?></h1>
		<div class="row mb-5 d-flex align-items-center">

			<form class="row g-3" action="actions/add_pieza_acc.php" method="POST" enctype="multipart/form-data">

				<div class="col-md-6 mb-3">
					<label for="titulo" class="form-label">Titulo</label>
					<input type="text" class="form-control" id="titulo" name="titulo" required>
				</div>

				<div class="col-md-6 mb-3">
					<label for="tipo_id" class="form-label">Tipo</label>
					<select class="form-select" name="tipo_id" id="tipo_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($tipos as $t) { ?>
							<option value="<?= $t->getId() ?>"><?= $t->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

                <div class="col-md-6 mb-3">
					<label for="artista_id" class="form-label">Artista</label>
					<select class="form-select" name="artista_id" id="artista_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($artistas as $A) { ?>
							<option value="<?= $A->getId() ?>"><?= $A->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

                <div class="col-md-6 mb-3">
					<label for="imagen" class="form-label">Imagen</label>
					<input class="form-control" type="file" id="imagen" name="imagen" required multiple>
				</div>

                <div class="col-md-12 mb-3">
					<label for="descripcion" class="form-label">Descripción</label>
					<textarea class="form-control" id="descripcion" name="descripcion" rows="7"></textarea>
				</div>

				<div class="col-md-4 mb-3">
					<label for="tamanio_id" class="form-label">Tamaño</label>
					<select class="form-select" name="tamanio_id" id="tamanio_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($tamanios as $tamanio) { ?>
							<option value="<?= $tamanio->getId() ?>"><?= $tamanio->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>
				<div class="col-md-4 mb-3">
					<label for="color_id" class="form-label">Color principal</label>
					<select class="form-select" name="color_id" id="color_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($colores as $C) { ?>
							<option value="<?= $C->getId() ?>"><?= $C->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-12 mb-3">
					<label class="form-label d-block">Colores secundarios</label>
					<?PHP foreach ($colores as $color) {?>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" name="colores_de_piezas[]" id="colores_de_piezas_<?=$color->getId() ?>" value="<?= $color->getId() ?>" >
							<label class="form-check-label mb-2" for="colores_de_piezas_<?= $color->getId() ?>"><?= $color->getNombre() ?></label>
						</div>
					<?PHP } ?>
				</div>

                <div class="col-md-4 mb-3">
					<label for="precio" class="form-label">Precio</label>
					<input type="number" class="form-control" id="precio" name="precio" required>
				</div>

				<div class="col-md-6 mb-3">
					<label for="coleccion_id" class="form-label">Coleccion</label>
					<select class="form-select" name="coleccion_id" id="coleccion_id" required>
						<option value="" selected disabled>Elija una opción</option>
						<?PHP foreach ($colecciones as $C) { ?>
							<option value="<?= $C->getId() ?>"><?= $C->getNombre() ?></option>
						<?PHP } ?>
					</select>
				</div>

				<div class="col-md-6 mb-3">
					<label for="publicacion" class="form-label">Publicacion</label>
					<input type="date" class="form-control" id="publicacion" name="publicacion" required>
				</div>

				<button type="submit" class="btn btn-dark d-block m-2 mt-4">Cargar</button>
			</form>
		</div>
	</div>
</div>