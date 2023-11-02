<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userId = $_REQUEST['User_id'];
  $sql = "CALL sp_select_user_id(" . $userId . "); ";
  $sql .= "SELECT * FROM `document_type` WHERE 1;";
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
  $resultUser = $resultArray[0];
  $resultDocumentType = $resultArray[1];
  $resultGenderType = $resultArray[2];
  $resultStatus = $resultArray[3];
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name of My Form One</title>
  <link href="../../assets/css/formStyle.css" rel="stylesheet" />
</head>

<body>
  <div id="sectionOne" class="sectionOne" name="sectionOne">
    <h2>ACTUALIZAR USUARIOS</h2>

    <form name="formUser" method="GET" action="../../controller/user/update.php" id="formUser" class="formUser">
      <input type="hidden" value="<?= $resultUser[0][0] ?>" id="User_id" name="User_id" />
      <table name="tableUser" id="tableUser" class="tableUser">
        <tr>
          <td>
            <input type="text" value="<?= $resultUser[0][1] ?>" placeholder="Digitar Nombre" id="User_name" name="User_name" required />
          </td>
          <td>
            <input type="text" value="<?= $resultUser[0][2] ?>" placeholder="Digitar Apellido" id="User_lastName" name="User_lastName" required />
          </td>
          <td>
       
            <input type="number" value="<?= $resultUser[0][4] ?>" placeholder="Digitar Documento" id="User_document" name="User_document" required/>

          </td>

        </tr>

        <tr>

          <td>
            <input type="email" value="<?= $resultUser[0][5] ?>" placeholder="Digitar Correo Electrónico" id="User_email" name="User_email" required />
          </td>

          <td>
            <input type="number" value="<?= $resultUser[0][6]?>" placeholder="Digitar Número de Celular" id="User_cellphone" name="User_cellphone" required />
          </td>
          <td>
            <input type="date" value="<?= $resultUser[0][9] ?>" placeholder="Fecha de Nacimiento" id="User_birthdate" name="User_birthdate" required />
          </td>

        </tr>

        <tr>
          <td>
            <select name="DocumentType_id" id="DocumentType_id" required>
              <?php

              for ($i = 0; $i < count($resultDocumentType); $i++) {
                if ($resultUser[0][11] == $resultDocumentType[$i][0]) {
                  echo '<option value="' . $resultDocumentType[$i][0] . '" selected="selected">' . $resultDocumentType[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultDocumentType[$i][0] . '">' . $resultDocumentType[$i][1] . '</option>';
                }
              };
              ?>
            </select>
          </td>
          <td>
            <select name="GenderType_id" id="GenderType_id" required>
              <?php
              for ($i = 0; $i < count($resultGenderType); $i++) {


                if ($resultUser[0][12] == $resultGenderType[$i][0]) {
                  echo '<option value="' . $resultGenderType[$i][0] . '" selected="selected">' . $resultGenderType[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultGenderType[$i][0] . '">' . $resultGenderType[$i][1] . '</option>';
                }
              };

              ?>

            </select>
          </td>
          <td>
            <select name="Status_id" id="Status_id" required>
              <?php
              for ($i = 0; $i < count($resultStatus); $i++) {

                if ($resultUser[0][13] == $resultStatus[$i][0]) {
                  echo '<option value="' . $resultStatus[$i][0] . '" selected="selected">' . $resultStatus[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultStatus[$i][0] . '">' . $resultStatus[$i][1] . '</option>';
                }
              };
              ?>
            </select>

          </td>
        </tr>

        <tr>
          <td colspan="3">
            <button type="submit" value="" id="btnSubmit" name="btnSubmit" class="btnSubmit"><img src="../../assets/img/icons/edit.png">
            </button>

          </td>
        </tr>

      </table>
      <h3>SEGURIDAD</h3>
      <table class="tableUser">
        <tr>
          <td>
            <input type="email" value="<?= $resultUser[0][14] ?>" placeholder="Digitar Usuario" id="User_user" name="User_user" required  disabled/>
          </td>
          <td>
            <input type="password" value="<?= $resultUser[0][14] ?>" placeholder="Digitar Contraseña" id="User_password" name="User_password" required disabled/>
          </td>
     
        </tr>
      </table>

    </form>
  </div>
  <script src="../assets/js/main.js" type="javascript"></script>
</body>

</html>