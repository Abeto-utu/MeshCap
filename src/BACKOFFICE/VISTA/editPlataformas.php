<?php
require('../../db.php');

if (isset($_GET['id_plataforma'])) {
  $id = $_GET['id_plataforma'];
  $query = "SELECT * FROM plataforma WHERE id_plataforma = $id";
  $resultado = mysqli_query($conn, $query);
  if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_array($resultado);
    $departamento = $fila['nombre'];
    $ubicacion = $fila['ubicacion'];
  }
}
if (isset($_POST['editado'])) {
  $id = $_GET['id_plataforma'];
  $departamento = $_POST['departamento'];
  $localidad = $_POST['localidad'];
  $calle = $_POST['calle'];
  $numero = $_POST['numero'];
  $ubicacion = "$numero  $calle,  $localidad";

  $query = "UPDATE plataforma SET ubicacion = '$ubicacion', nombre = '$departamento' WHERE id_plataforma = $id";
  mysqli_query($conn, $query);
  header("Location: ../VISTA/crudPlataformas.php");
}

if (isset($_POST["editadoLinea"])) {
  $id = $_GET['id_plataforma'];
  $linea = $_POST['localidad'];
  $posicion = $_POST['calle'];

  $query = "INSERT INTO `plataforma_linea`(`id_plataforma`, `id_linea`, `posicion`) 
  VALUES ($id, $linea, $posicion) 
  ON DUPLICATE KEY UPDATE
  id_linea = VALUES(id_linea),
  posicion = VALUES(posicion);";
  mysqli_query($conn, $query);
  header("Location: ../VISTA/crudPlataformas.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../CSS/stylesCrudEdit.css">
  <title>Editar Plataforma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-dark bg-dark p-4 ">
    <div class="container-fluid">
      <a class="navbar-brand" href="backoffice.html" id="logo"><img src="../../IMAGES/gorraBlanca.png" height="40"
          alt="">MeshCap</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel">Menu del Backoffice</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../VISTA/backoffice.html">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Menus
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="../VISTA/crudPaquetes.php"> <i class="fas fa-thin fa-box"></i>
                    Paquetes</a></li>
                <li><a class="dropdown-item" href="../VISTA/crudLotes.php"> <i class="fas fa-thin fa-dolly"></i>
                    Lotes</a></li>
                <li><a class="dropdown-item" href="../VISTA/crudVehiculos.php"> <i class="fas fa-thin fa-truck"></i>
                    Vehiculos</a></li>
                <li><a class="dropdown-item" href="../VISTA/crudUsuarios.php"> <i class="fas fa-thin fa-user"></i>
                    Usuarios</a></li>
                <li><a class="dropdown-item" href="../VISTA/crudPlataformas.php"> <i
                      class="fas fa-thin fa-warehouse"></i> Plataformas</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../VISTA/inicioSesion.php">Log out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="container-fluid row" $id="container-total">
    <form action="editPlataformas.php?id_plataforma=<?php echo $id ?>" method="POST"
      class="col-3 p-5 m-3 bg-dark text-light">
      <div class="mb-3">
        <h3 class="text-light text-center">Editar Plataformas</h3>

        <label for="exampleInputEmail1" class="form-label mb-3">Departamento:</label>
        <select class="form-select mb-3" aria-label="Default select example" name="departamento">
          <option value="Artigas">Artigas</option>
          <option value="Canelones">Canelones</option>
          <option value="Cerro Largo">Cerro Largo</option>
          <option value="Colonia">Colonia</option>
          <option value="Durazno">Durazno</option>
          <option value="Flores">Flores</option>
          <option value="Florida">Florida</option>
          <option value="Lavalleja">Lavalleja</option>
          <option value="Maldonado">Maldonado</option>
          <option value="Montevideo" selected>Montevideo</option>
          <option value="Paysandu">Paysandú</option>
          <option value="Rio negro">Rio Negro</option>
          <option value="Rivera">Rivera</option>
          <option value="Rocha">Rocha</option>
          <option value="Salto">Salto</option>
          <option value="San jose">San José</option>
          <option value="Soriano">Soriano</option>
          <option value="Tacuarembo">Tacuarembó</option>
          <option value="Treinta y Tres">Treinta y tres</option>
        </select>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Localidad:</label>
          <input type="text" class="form-control" id="exampleInputPassword1" name="localidad">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Calle:</label>
          <input type="text" class="form-control" id="exampleInputPassword1" name="calle">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Numero:</label>
          <input type="text" class="form-control" id="exampleInputPassword1" name="numero">
        </div>

        <button type="submit" class="btn btn-secondary " name="editado">Guardar</button>
    </form>
  </div>
  <div class="container-fluid row" $id="container-total">
    <form action="editPlataformas.php?id_plataforma=<?php echo $id ?>" method="POST"
      class="col-3 p-5 m-3 bg-dark text-light">
      <div class="mb-3">
        <h3 class="text-light text-center">Editar Linea</h3>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Linea:</label>
          <input type="text" class="form-control" id="exampleInputPassword1" name="localidad">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Posicion:</label>
          <input type="text" class="form-control" id="exampleInputPassword1" name="calle">
        </div>

        <button type="submit" class="btn btn-secondary " name="editadoLinea">Guardar</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
    crossorigin="anonymous"></script>
</body>

</html>