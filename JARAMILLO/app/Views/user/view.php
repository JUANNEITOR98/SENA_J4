<?php
include("../../config/config.php");

$sql = "CALL sp_select_all_client(); ";

if (!$result = $connect->query($sql)) {
  echo "Error consult: (" . $connect->errno . ") " . $connect->error;
} else {
  $resultClient = $result->fetch_all(MYSQLI_NUM);
}


?>

<?php
  include('../assets/view/nav.php');
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

  <div id="sectionTwo" class="sectionTwo">
    <h2 style="text-align: center;">LISTA DE CLIENTES</h2>
    <div>
      <form>
        <table name="tableViewUserSearch" id="tableViewUserSearch" class="tableViewUserSearch">
          <tr>
            <td>
              <select name="typeSearch" id="typeSearch" required>

            
                <option value="0">DOCUMENTO</option>
                <option value="1">NOMBRE</option>
                <option value="2">APELLIDO</option>
                <option value="3">CORREO</option>
              </select>

            </td>
            <td> <input type="search" value="" placeholder="Digitar busqueda" required /> </td>
            <td style="text-align: center;"> <button> <img src="../../assets/img/icons/search.png" /> </button></td>
          </tr>

        </table>
      </form>
    </div>

    <table name="tableViewUser" id="tableViewUser" class="tableViewUser">

      <thead>
        <tr>

          <th>#</th>
          <th>NOMBRE</th>
          <th>DOCUMENTO</th>
          <th>CORREO</th>
          <th>CELULAR</th>
          <th>DIRECCIÓN</th>
          <th>TIPO DE DOCUMENTO</th>
          <th>ESTADO</th>
          <th>ACCIONES</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $row= $resultClient;
        for ($i = 0; $i < count($row); $i++) {
          echo '<tr class="checkTr">';
          echo '<td>' . ($i + 1) . '</td>';
          echo '<td>' . $row[$i][1] . '</td>';
          echo '<td>' . $row[$i][2] . '</td>';
          echo '<td>' . $row[$i][3] . '</td>';
          echo '<td>' . $row[$i][4] . '</td>';
          echo '<td>' . $row[$i][5] . '</td>';
          echo '<td>' . $row[$i][9] . '</td>';
          echo '<td>' . $row[$i][8] . '</td>';
          echo '
        <td class="btnsActions" style="text-align: center;">
        <!--This route is to send a GET type which has the id-->
          <button class="btnWarning"> <a href="show.php?Client_id=' . $row[$i][0] . '"><img src="../../assets/img/icons/visibility.png" /><a> </button>
          <button class="btnInfo"><a href="edit.php?Client_id=' . $row[$i][0] . '"><img src="../../assets/img/icons/edit.png" /><a></button>
          <button class="btnSuccess"><a href="../../controller/client/delete.php?Delete_id=0&Client_id=' . $row[$i][0] . '"><img src="../../assets/img/icons/lock.png" /></a></button>
          <button class="btnDelete"><a href="../../controller/client/delete.php?Delete_id=1&Client_id=' . $row[$i][0] . '"><img src="../../assets/img/icons/remove.png" /></a></button>
        </td>
      </tr>';
        }
        ?>

      </tbody>
      <tfoot>
        <tr>
        <th>#</th>
          <th>NOMBRE</th>
          <th>DOCUMENTO</th>
          <th>CORREO</th>
          <th>CELULAR</th>
          <th>DIRECCIÓN</th>
          <th>TIPO DE DOCUMENTO</th>
          <th>ESTADO</th>
          <th>ACCIONES</th>
        </tr>

      </tfoot>
    </table>

  </div>
  <script src="../assets/js/main.js" type="javascript"></script>
</body>

</html>