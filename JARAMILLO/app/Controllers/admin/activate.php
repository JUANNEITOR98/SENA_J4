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
$sta = $_GET['sta'];

$sql = "call u_usr_sta($id,$sta);";

$con->query($sql);

if ($con->affected_rows > 0) {
    $atribute = '?mss=changed';
} else {
    $atribute = '?mss=noChanged';
}

header('Location: ..\..\Views\admin\verPerfiles.php' . $atribute);