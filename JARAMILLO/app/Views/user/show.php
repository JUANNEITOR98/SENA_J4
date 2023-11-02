<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userId = $_REQUEST['Client_id'];
  $sql = "CALL sp_select_client_id(" . $userId . "); ";
  $sql .= "SELECT * FROM `document_type` WHERE 1;";
  $sql .= "SELECT * FROM `status` WHERE 1;";
  $sql .= "SELECT * FROM `country` WHERE 1;";
  $sql .= "SELECT * FROM `company` WHERE 1;";
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
  $resultClient = $resultArray[0];
  $resultDocumentType = $resultArray[1];
  $resultStatus = $resultArray[2];
  $resultCountry = $resultArray[3];
  $resultCompany = $resultArray[4];
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
  <link href="../../assets/css/formStyle.css" rel="stylesheet" />
</head>

<body>

  <div id="sectionOne" class="sectionOne" name="sectionOne">
    <h2>REGISTRAR CLIENTES</h2>

    <form name="formUser" method="GET" action="../../controller/client/insert.php" id="formUser" class="formUser">
      <input type="hidden" value="<?= $resultClient[0][0] ?>" id="Client_id" name="Client_id " />
      <table name="tableUser" id="tableUser" class="tableUser">
        <tr>
          <td>
            <input type="text" value="<?= $resultClient[0][1] ?>" placeholder="Digitar Nombre" id="Client_name" name="Client_name" required disabled />
          </td>

          <td>
            <input type="number" value="<?= $resultClient[0][2] ?>" placeholder="Digitar Documento" id="Client_identification" name="Client_identification" required disabled />

          </td>
          <td>
            <input type="email" value="<?= $resultClient[0][3] ?>" placeholder="Digitar Correo Electrónico" id="Client_email" name="Client_email" required disabled />
          </td>
        </tr>
        <tr>

          <td>
            <input type="number" value="<?= $resultClient[0][4] ?>" placeholder="Digitar Número de Celular" id="Client_phone" name="Client_phone" required disabled />

          </td>
          <td>
            <input type="text" value="<?= $resultClient[0][5] ?>" placeholder="Dirección " id="Client_address" name="Client_address" required disabled />
          </td>
          <td>
            <select name="Status_id" id="Status_id" required disabled>
              <?php
              for ($i = 0; $i < count($resultStatus); $i++) {

                if ($resultClient[0][7] == $resultStatus[$i][0]) {
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
          <td>
            <select name="DocumentType_id" id="DocumentType_id" required disabled>
              <?php
              for ($i = 0; $i < count($resultDocumentType); $i++) {

                if ($resultClient[0][6] == $resultDocumentType[$i][0]) {
                  echo '<option value="' . $resultDocumentType[$i][0] . '" selected="selected">' . $resultDocumentType[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultDocumentType[$i][0] . '">' . $resultDocumentType[$i][1] . '</option>';
                }
              };
              ?>
            </select>
          </td>
          <td>
            <select name="Comp_id" id="Comp_id" required disabled>
              <?php
              for ($i = 0; $i < count($resultCompany); $i++) {

                if ($resultClient[0][8] == $resultCompany[$i][0]) {
                  echo '<option value="' . $resultCompany[$i][0] . '" selected="selected">' . $resultCompany[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultCompany[$i][0] . '">' . $resultCompany[$i][1] . '</option>';
                }
              };
              ?>
            </select>
          </td>
          <td>
            <select name="Country_id" id="Country_id" required disabled>
              <?php
              for ($i = 0; $i < count($resultCountry); $i++) {

                if ($resultClient[0][9] == $resultCountry[$i][0]) {
                  echo '<option value="' . $resultCountry[$i][0] . '" selected="selected">' . $resultCountry[$i][1] . '</option>';
                } else {
                  echo '<option value="' . $resultCountry[$i][0] . '">' . $resultCountry[$i][1] . '</option>';
                }
              };
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="3">
          </td>
        </tr>

      </table>

    </form>
  </div>
  <script src="../assets/js/main.js" type="javascript"></script>
</body>

</html>
<?php
$connect->close();
?>