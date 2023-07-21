<div class="row my-5 justify-content-center">
    <div class="col col-md-5">

        <h1 class="text-center mb-5 fw-bold mt-5"><?= $titulo ?></h1>
        <div>
			<?= (new Alerta())-> get_alertas();?>
		</div>

		<form class="row-lg g-lg-3 container" action="admin/actions/auth_login.php" method="POST">
		<div class="col-12 mb-3">
			<label for="username" class="form-label">Nombre de Usuario</label>
			<input type="text" class="form-control rounded-0" id="username" name="username">
		</div>

		<div class="col-12 mb-3">
			<label for="pass" class="form-label">Contraseña</label>
			<input type="password" class="form-control rounded-0" id="pass" name="pass">
		</div>

			<button type="submit" class="btn bg-dark p-2 shadow d-block mx-auto m-2 text-light text-uppercase rounded-0">Iniciar sesión</button>
		</form>
            

        </div>


    </div>
</div>

<!-- CAMBIAR ESTILO -->