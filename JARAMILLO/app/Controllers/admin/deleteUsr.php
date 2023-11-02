<?php
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
$id = $_GET['id'];
$sql = "call d_usr($id);";

$con->query($sql);

if ($con->affected_rows > 0) {
    $atribute = '?mss=erased';
} else {
    $atribute = '?mss=noErased';
}

header('Location: ..\..\Views\admin\verPerfiles.php' . $atribute);