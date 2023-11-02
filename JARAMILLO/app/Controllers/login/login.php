<?php
class validateData
{
    private $typeData;
    private $dataIn;

    public function __construct($str) {
        $this->dataIn = $str;
        $this->typeData = null;
    }

    private static $expReg = [
        "num" => '/^(3[0-9]{9})$/',
        "ema" => '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'
    ];

    public static function isTel($str) : bool {
        return preg_match(self::$expReg['num'], $str) && ctype_digit($str);
    }

    public static function isEmail($str) : bool {
        return preg_match(self::$expReg['ema'], $str);
    }

    public static function isUsrNm($str) : bool {
        return !(self::isEmail($str) || self::isTel($str)); 
    }

    public function validateTypeData() : string {
        if(self::isUsrNm($this->dataIn)) {
            $this->typeData = 'usr_nm';
        } elseif (self::isEmail($this->dataIn)) {
            $this->typeData = 'usr_ema';
        } else {
            $this->typeData = 'usr_tel';
        }
        return $this->typeData;
    }
}

require_once('../../config/Constants.php');
$host = HOST;
$pass = PASS;
$db = DB;
$user = USER;
try {
    $conn = new mysqli( $host, $user, $pass, $db );
} catch (Exception $e) {
    die('Error en la conexión.');
    $conn = $e->getMessage();
}

$modelUsr = [
  'usr_nm' => $_REQUEST['usr_nm'],
  'remember' => (empty($_REQUEST['remember'])) ? false : true ,
  'usr_pass' => $_REQUEST['usr_pass'],
];

$userEmail = $modelUsr['usr_nm'];
$userPassword = $modelUsr['usr_pass'];

$type = (new validateData($userEmail))->validateTypeData();
$sql = "Call login('$type','$userEmail');";
$consult = $conn->query($sql);
$result = $consult->fetch_all(MYSQLI_ASSOC);



if (count($result) > 0) {
  if ($result[0]['sta_id'] == 1) {
    if (password_verify($userPassword, $result[0]["usr_pass"])) {

      $data = $result[0];
      $data['timeLine'] = (isset($modelUsr['remember'])) ? 0 : 30;

      session_start();
      $dataAuxiliar = ['usr_id' => $data['usr_id'], 'rol_id' => $data['rol_id']];
      session_set_cookie_params($data['timeLine'] * 60 , null);
      $_SESSION['session'] = $dataAuxiliar;
      var_dump($_SESSION['session']);
      // var_dump($_SESSION['session']);
      header("Location: ../../../../public/index.php?mss=ok");

    } else {
      header("Location: ../../../Views/login/login.php?mss=inPass");
    }
  } else {  
      header("Location: ../../../Views/login/login.php?mss=inSta");

  }
} else {
  header("Location: ../../../Views/login/login.php?mss=inUsr");
}
?>