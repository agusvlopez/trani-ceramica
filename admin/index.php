<?PHP

require_once "../functions/autoload.php";

$secciones_validas = [
  "login" => [
    "titulo" => "Iniciar sesión",
    "restringido" => FALSE
  ],
  "dashboard" => [
    "titulo" => "Panel de control",
    "restringido" => TRUE
  ],
  "admin_piezas" => [
    "titulo" => "Administración de Piezas",
    "restringido" => TRUE
  ],
  "admin_artistas" => [
    "titulo" => "Administración de Artistas",
    "restringido" => TRUE
  ],
  "admin_coleccion" => [
    "titulo" => "Administración de Colecciones",
    "restringido" => TRUE
  ],
  "admin_color" => [
    "titulo" => "Administración de Colores",
    "restringido" => TRUE
  ],
  "admin_tamanio" => [
    "titulo" => "Administración de Tamaños",
    "restringido" => TRUE
  ],
  "admin_tipo" => [
    "titulo" => "Administración de los Tipos de piezas",
    "restringido" => TRUE
  ],
  "add_pieza" => [
    "titulo" => "Agregar Pieza",
    "restringido" => TRUE
  ],
  "add_artistas" => [
    "titulo" => "Agregar Artista",
    "restringido" => TRUE
  ],
  "add_coleccion" => [
    "titulo" => "Agregar Colección",
    "restringido" => TRUE
  ],
  "add_color" => [
    "titulo" => "Agregar Color",
    "restringido" => TRUE
  ],
  "add_tamanio" => [
    "titulo" => "Agregar Tamaño",
    "restringido" => TRUE
  ],
  "add_tipo" => [
    "titulo" => "Agregar Tipo",
    "restringido" => TRUE
  ],
  "edit_pieza" => [
    "titulo" => "Editar Pieza",
    "restringido" => TRUE
  ],
  "edit_artistas" => [
    "titulo" => "Editar Artista",
    "restringido" => TRUE
  ],
  "edit_coleccion" => [
    "titulo" => "Editar Colección",
    "restringido" => TRUE
  ],
  "edit_color" => [
    "titulo" => "Editar Color",
    "restringido" => TRUE
  ],
  "edit_tamanio" => [
    "titulo" => "Editar Tamaño",
    "restringido" => TRUE
  ],
  "edit_tipo" => [
    "titulo" => "Editar Tipo",
    "restringido" => TRUE
  ],
  "delete_pieza" => [
    "titulo" => "Eliminar Pieza",
    "restringido" => TRUE
],
  "delete_artista" => [
      "titulo" => "Eliminar Artista",
      "restringido" => TRUE
  ],
  "delete_coleccion" => [
    "titulo" => "Eliminar Colección",
    "restringido" => TRUE
  ],
  "delete_color" => [
    "titulo" => "Eliminar Color",
    "restringido" => TRUE
  ],
  "delete_tamanio" => [
    "titulo" => "Eliminar Tamaño",
    "restringido" => TRUE
  ],
  "delete_tipo" => [
    "titulo" => "Eliminar Tipo",
    "restringido" => TRUE
  ]
];

//null coalesce(solo en php 7+)
$link = $_GET['link'] ?? "dashboard";

if (!array_key_exists($link, $secciones_validas)) {
  $vista = "404";
  $titulo = "404 - Página no encontrada";
} else {
  $vista = $link;

  /*VERIFICO SI SE REQUIERE AUTENTICACIÓN */
  if($secciones_validas[$link]['restringido']){
      (new Autenticacion())->verify();        
  };

  $titulo = $secciones_validas[$link]['titulo'];
}


$tipos = (new Pieza())->listar_tipos_piezas();

$userData = $_SESSION['loggedIn'] ?? FALSE;

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trani Cerámica - <?= $titulo ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <!--FAVICON-->
  <link rel="apple-touch-icon" sizes="152x152" href="../fav/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../fav/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../fav/favicon-16x16.png">
<link rel="manifest" href="fav/site.webmanifest">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

  <link href="../css/style.css" rel="stylesheet">

</head>
<body>
<h1 class="d-none">Trani Cerámica</h1>

<!-- NAV -->
<nav class="navbar navbar-expand-lg shadow-nav nav-fixed p-0">
  <div class="container-fluid no-gutters nav100">
    <a class="navbar-brand" href="index.php"> <img src="../img/logo/logo-trani.png" alt="Logo de Trani Ceramica" class="img-fluid logo"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=dashboard"> <span lang="en">Dashboard</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_artistas"> <span lang="en">Admin de artistas</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_coleccion"> <span lang="en">Admin de coleccion</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_color"> <span lang="en">Admin de colores</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_tamanio"> <span lang="en">Admin de tamaños</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_tipo"> <span lang="en">Admin de tipos</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font <?= $userData ? "" : "d-none" ?>" aria-current="page" href="?link=admin_piezas"> <span lang="en">Admin de piezas</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-uppercase nav-font bg-dark text-light ms-lg-5 p-2 nav-item <?= $userData ? "d-none" : "" ?>" href="index.php?link=login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-font bg-dark text-light ms-lg-3 p-2 nav-item <?= $userData ? "" : "d-none" ?>" href="actions/auth_logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
<main>

<?PHP

  require_once file_exists("views/$link.php") ? "views/$link.php" : "views/404.php";
  
?>

</main>

<footer class="p-3 bg-panel text-light border-top border-light">
  <div class="container">
    <div class="row border-footer">
      <div class="col-12 d-flex justify-content-center">
          <img src="../img/iconos/facebook.png" alt="Icono de facebook" class="img-fluid col-2 p-2 icono">
          <img src="../img/iconos/instagram.png" alt="Icono de Instagram" class="img-fluid col-2 p-2 icono">    
      </div>
      <div class="col-12 d-flex">
        <p class="pFooter col-md-8 align-self-end mb-0">@ Copyright Trani Cerámica 2023.</p>
          <div class="col-md-4 justify-items-center">
            <img src="../img/iconos/locacion.png" alt="Icono de locacion" class="img-fluid col-2 p-2 icono ">
            <span>Villa Urquiza, CABA</span>
        </div>
        
      </div>
    </div> 
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>