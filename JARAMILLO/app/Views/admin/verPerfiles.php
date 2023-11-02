<?php

require_once('../template/headerPerfiles.php');
require_once('../../config/Constants.php');

require_once('../../config/Constants.php');
$host = HOST;
$pass = PASS;
$db = DB;
$user = USER;
try {
    $con = new mysqli( $host, $user, $pass, $db );
} catch (Exception $e) {
    die('Error en la conexión.');
    $con = $e->getMessage();
}
$sql = 'call v_usrs;'. 
'call v_sexs;'. 
'call v_tyDocs;'. 
'call v_stas;';

$result = $con -> multi_query($sql);
$resultArray = [];
do {
    if ($result = $con->store_result()) {
      $resultQuery = $result->fetch_all(MYSQLI_ASSOC);
      array_push($resultArray, $resultQuery);
      $result->free();
    }
  } while ($con->more_results() && $con->next_result());
  $data['usr'] = $resultArray[0];
  $data['sex'] = $resultArray[1];
  $data['sex'] = $resultArray[2];
  $data['sta'] = $resultArray[3];

//   var_dump($data);

?>

<table >
    <tr>
        <?php
            foreach ($data['usr'][0] as $key => $value) :
        ?>
        <th>
            <?= $key ?>
        </th>
        <?php
            endforeach;
        ?>
    </tr>
    
    <?php 
        for ($i=0; $i < count($data['usr']) ; $i++) :
    ?>
    <tr>

        <?php
            foreach($data['usr'][$i] as $key => $value):
        ?>
        <td>
            <?= $value ?>
        </td>
        <?php 
            endforeach;
        ?>

        <td>
            <ul>
                <li>
                    <a href="../../Controllers/admin/deleteUsr.php?id=<?= $data['usr'][$i]['usr_id'] ?>">eliminar</a>
                </li>
                <li>
                    <a href="../../Controllers/admin/activate.php?id=<?= $data['usr'][$i]['usr_id'] ?>&sta=1">activar</a>                        
                </li>
                <li>
                    <a href="../../Controllers/admin/activate.php?id=<?= $data['usr'][$i]['usr_id'] ?>&sta=2">inActivar</a>                        
                </li>
                <li>
                    <a href="../../Controllers/admin/activate.php?id=<?= $data['usr'][$i]['usr_id'] ?>&sta=4">inHabilite</a>                        
                </li>
                    
            </ul>
        
        </td>
    </tr>
    
    <?php
        endfor;
    ?>
</table>