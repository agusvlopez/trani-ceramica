<?php 
<?PHP
require_once "functions/autoload.php";
$secciones_validas = [
  "home" => [
    "titulo" => "Trani Cerámica",
    "restringido" => FALSE
  ],
  
  "contacto" => [
    "titulo" => "¡Contactanos!",
    "restringido" => FALSE
  ],

  "nosotras" => [
    "titulo" => "Nosotras",
    "restringido" => FALSE
  ],

  "pieza" => [
    "titulo" => "Detalles del producto",
    "restringido" => FALSE
  ],

  "piezas" => [
    "titulo" => "Productos",
    "restringido" => FALSE
  ],

  "personalizado" => [
    "titulo" => "Productos personalizados",
    "restringido" => FALSE
  ],

  "alumna" => [
  "titulo" => "Datos de la alumna",
  "restringido" => FALSE
  ],

  "login" => [
    "titulo" => "Iniciar sesión",
    "restringido" => FALSE
  ],

  "carrito" => [
    "titulo" => "Carrito de compras",
    "restringido" => TRUE
  ],
  "panel_usuario" => [
    "titulo" => "Panel del usuario",
    "restringido" => TRUE
  ],
  "resumen_pago" => [
    "titulo" => "¡Gracias por comprar en Trani Cerámica!",
    "restringido" => TRUE
  ]
];

//null coalesce(solo en php 7+)
$link = $_GET['link'] ?? "home";


if (!array_key_exists($link, $secciones_validas)) {
  $vista = "404";
  $titulo = "404 - Página no encontrada";
} else {
  $vista = $link;

  /*VERIFICO SI SE REQUIERE AUTENTICACIÓN */
  if($secciones_validas[$link]['restringido']){
      (new Autenticacion())->verify(FALSE);        
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
    <a class="navbar-brand" href="index.php"> <img src="img/logo/logo-trani.png" alt="Logo de Trani Ceramica" class="img-fluid logo"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        
        <li class="nav-item me-2">
          <a class="nav-link active text-uppercase nav-font" aria-current="page" href="?link=home"> <span lang="en">Home</span></a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link text-uppercase nav-font" href="?link=nosotras">Nosotras</a>
        </li>
        
        <li class="nav-item dropdown me-2">
          <a class="nav-link dropdown-toggle text-uppercase nav-font" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
          </a>
          <ul class="dropdown-menu rounded-0 p-2 ">
          <li><a class="dropdown-item textoDorado text-uppercase nav-font p-2" href="?link=piezas&tipo=">Ver todos los productos</a></li>
          <?PHP foreach ($tipos as $tipo) { ?>

            <li><a class="dropdown-item textoDorado text-uppercase nav-font p-2" href="?link=piezas&tipo=<?= $tipo['id']; ?>"><?= $tipo['nombre']; ?></a></li>

            <?PHP } ?>
          </ul>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link  text-uppercase nav-font" href="?link=personalizado">Productos personalizados</a>
        </li>

        <li class="nav-item me-2">
          <a class="nav-link text-uppercase nav-font" href="?link=contacto">Contacto</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-uppercase nav-font" href="?link=alumna">Alumna</a>
        </li>
       
        <li class="nav-item ms-3">
          <a class="nav-link text-uppercase nav-font bgDorado text-light ms-lg-3 p-2" href="admin">Admin</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-uppercase nav-font bg-dark text-light ms-lg-3 nav-item rounded-1 <?= $userData ? "d-none" : "" ?>" href="index.php?link=login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-uppercase nav-font bg-dark text-light ms-lg-3 nav-item rounded-1 <?= $userData ? "" : "d-none" ?>" href="admin/actions/auth_logout.php">Logout</a>
        </li>
       
        <li class="nav-item ms-3">
          <a class="nav-link nav-font p-2 me-2 text-center" href="?link=carrito"><img src="./img/iconos/carrito-icon.png" alt="Icono de carrito"></a>
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

<footer class="p-3 bg-negro text-light border-top border-light">
  <div class="container">
    <div class="row border-footer">
      <div class="col-12 d-flex justify-content-center">
          <img src="img/iconos/facebook.png" alt="Icono de facebook" class="img-fluid col-2 p-2 icono">
          <img src="img/iconos/instagram.png" alt="Icono de Instagram" class="img-fluid col-2 p-2 icono">    
      </div>
      <div class="col-12 d-flex">
        <p class="pFooter col-md-8 align-self-end mb-0">@ Copyright Trani Cerámica 2023.</p>
          <div class="col-md-4 justify-items-center">
            <img src="img/iconos/locacion.png" alt="Icono de locacion" class="img-fluid col-2 p-2 icono ">
            <span>Villa Urquiza, CABA</span>
        </div>
        
      </div>
    </div> 
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>