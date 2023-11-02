<?php

/* Default Data Database*/
define('HOST','LocalHost');
define('DB','juanDa');
define('USER','root');
define('PASS','');

/* Default time zone options */
date_default_timezone_set("America/Bogota");

$mss = [
    'ok' => 'logueado',
    'inPass' => 'Contraseña Incorrecta',
    'inSta' => 'No esta validado en el sistema = no esta activo',
    'inUsr' => 'No esta registrado',
    'reg' => 'Registrado Con exito',
    'noReg' => 'No a podido ser registrado (error en el sistema)',
];