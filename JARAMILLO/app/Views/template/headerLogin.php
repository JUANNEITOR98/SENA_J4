<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="../../assets/css/style.css" rel="stylesheet" />

<div class="header-content">
  <div class="top-bar container-fluid mx-3 d-flex justify-content-between align-items-center">
    <div>
      <a href="index.php" class="logo">
        <img src="../app/assets/img/icons/logo_temporal.png" alt="Bootstrap" width="90" height="72">
      </a>
    </div>  
    <nav class="navbar">
      <ul>
        <li><a href="../../../public/index.php">Inicio</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Registrarme</a></li>
      </ul>
    </nav>

    <!-- Carrito en construcción  -->
    <div id="carrito">
      <img src="/structure_project_crud_login/assets/img/images/car.svg" alt="car" id="img-carrito">
      <div id="lista-carrito">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
            </thead>
        </table>
        <a href="#" id="vaciar-carrito" class="btn-3">Vaciar Carrito</a>
      </div>
    </div>
  </div>
</div>

<?php
$mss = [
    'ok' => 'Usuario logueado correctamente',
    'inPass' => 'Contraseña Incorrecta',
    'inSta' => 'Usuario no validado en el sistema = no esta activo',
    'inUsr' => 'Usuario no esta registrado',
    'reg' => 'Registrado Con exito',
    'noReg' => 'No a podido ser registrado (error en el sistema)',
];
if ((isset($_GET['mss']))) :
    $message = $_GET['mss'];
?>
<div class="container-fluid">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><?= $mss[$message] ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<?php
    endif;
?>