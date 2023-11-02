<?php
include("../../config/config.php");

$sql = "SELECT * FROM `document_type` WHERE 1;";
$sql .= "SELECT * FROM `gendertype` WHERE 1;";
$sql .= "SELECT * FROM `status` WHERE 1;";
$resultArray = array();
if (!$connect->multi_query($sql)) {
  echo "Falló la multiconsulta: (" . $connect->errno . ") " . $connect->error;
}

do {
  if ($result = $connect->store_result()) {


    $resultQuery = $result->fetch_all(MYSQLI_NUM);
    array_push($resultArray, $resultQuery);

    $result->free();
  }
} while ($connect->more_results() && $connect->next_result());
$resultDocumentType = $resultArray[0];
$resultGenderType = $resultArray[1];
$resultStatus = $resultArray[2];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name of My Form One</title>
  <link href="../../assets/css/formStyle.css" rel="stylesheet" />
  <?php
  include('../assets/css/css.php');
  ?>
</head>

<body>
  <?php
  include('../assets/view/nav.php');
  ?>
  <div class="container">
    <div id="sectionOne" class="sectionOne" name="sectionOne">
      <h2>REGISTRAR USUARIO</h2>

      <form name="formUser" method="GET" action="../../controller/user/insert.php" id="formUser" class="row">
        <input type="hidden" value="" id="User_id" name="User_id" />

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="text" class="form-control form-control-sm" id="User_name" name="User_name"
              placeholder="Digitar Nombre" required>
            <label for="User_name">Digitar Nombre</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="text" class="form-control form-control-sm" id="User_lastName" name="User_lastName"
              placeholder="Digitar Apellido" required>
            <label for="User_lastName">Digitar Apellido</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="number" class="form-control form-control-sm" id="User_document" name="User_document"
              placeholder="Digitar Documento" required>
            <label for="User_document">Digitar Documento</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="email" class="form-control form-control-sm" id="User_email" name="User_email"
              placeholder="Digitar Correo Electrónico" required>
            <label for="User_email">Digitar Correo Electrónico</label>
          </div>
        </div>


        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="number" class="form-control form-control-sm" id="User_cellphone" name="User_cellphone"
              placeholder="Digitar Número de Celular" required>
            <label for="User_cellphone">Digitar Número de Celular</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="date" class="form-control form-control-sm" id="User_birthdate" name="User_birthdate"
              placeholder="Fecha de Nacimiento" required>
            <label for="User_birthdate">Fecha de Nacimiento</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating">
            <select class="form-select" id="DocumentType_id" name="DocumentType_id" aria-label="Floating label select example">
              <option selected>Open this select menu</option>

              <?php
                for ($i = 0; $i < count($resultDocumentType); $i++) {
                  echo '<option value="' . $resultDocumentType[$i][0] . '">' . $resultDocumentType[$i][1] . '</option>';
                }
                ;
                ?>
            </select>
            <label for="DocumentType_id">Tipo de Documento</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating">
            <select class="form-select" id="GenderType_id" name="GenderType_id" aria-label="Floating label select example">
              <option selected>Open this select menu</option>

              <?php
                 
                 for ($i = 0; $i < count($resultGenderType); $i++) {
                   echo '<option value="' . $resultGenderType[$i][0] . '">' . $resultGenderType[$i][1] . '</option>';
                 };
                ?>
            </select>
            <label for="GenderType_id">Genero</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating">
            <select class="form-select" id="Status_id" name="Status_id" aria-label="Floating label select example">
              <option selected>Open this select menu</option>
              <?php
                for ($i = 0; $i < count($resultStatus); $i++) {
                  echo '<option value="' . $resultStatus[$i][0] . '">' . $resultStatus[$i][1] . '</option>';
                }
                ;
                ?>
            </select>
            <label for="Status_id">Estado</label>
          </div>
        </div>


        <h3>SEGURIDAD</h3>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="email" class="form-control form-control-sm" id="User_user" name="User_user"
              placeholder="Digitar Usuario - Electrónico" required>
            <label for="User_user">Digitar Usuario - Correo Electrónico</label>
          </div>
        </div>


        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="password" class="form-control form-control-sm" id="User_password" name="User_password"
              placeholder="Digitar Contraseña" required>
            <label for="User_password">Digitar Contraseña</label>
          </div>
        </div>

        <div class="col-4">
          <div class="form-floating mb-1">
            <input type="password" class="form-control form-control-sm" id="passwordRepeat" name="passwordRepeat"
              placeholder="Repetir Contraseña" required>
            <label for="passwordRepeat">Repetir Contraseña</label>
          </div>
        </div>
        <button type="submit" value="" id="btnSubmit" name="btnSubmit" class="btn btn-success">CREAR USUARIO
              </button>
      </form>
    </div>
  </div>
  <div class="bottom-0 end-0 w-100" style="background: #e2e6e9; text-align: center;">
    <a href="#">www.miempresa.com</a>
  </div>
  <?php
  include('../assets/js/js.php');
  ?>
</body>

</html>
<?php
$connect->close();
?>