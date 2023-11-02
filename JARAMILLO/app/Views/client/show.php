<?php
include("../../config/config.php");

$sql = "CALL sp_select_all_products(); ";

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
  <link href="../../assets/css/asdstyle.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
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
        $row= $addProduct;
        for ($i = cont($row) = addProduct) {
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
</body>

</html>