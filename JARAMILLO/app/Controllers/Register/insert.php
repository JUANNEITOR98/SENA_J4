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

$data = $_POST;

$data = array_filter($data, function($value) {
    return !empty($value);
});

$data = array_map(function($value) {
    return filter_var($value, FILTER_SANITIZE_STRING);
}, $data);
function getValuesForSql(array $data) : string {
    return '"'. implode('", "', $data) . '"';
}

$data['usr_pass'] = password_hash($data['usr_pass'],PASSWORD_DEFAULT);
$data = getValuesForSql($data);
print"call i_client ($data);";
try {
    $con->query("call i_client ($data);");

    if ($con->affected_rows > 0) {
        header("Location: ../../../public/index.php?mss=reg");
    } else {
        header('Location: ../../Views/login/register.php?mss=noReg');
    }
}    catch (\Throwable $th) {
    header('Location: ../../Views/login/register.php?mss=noReg');
}


$data['message'] = 'Debes verificar tu cuenta por medio de correo electronico, se envio al correo que registraste en la página';