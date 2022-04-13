<?php

define('DS' , DIRECTORY_SEPARATOR);
define('PATH_ROOT', __DIR__. DS);

session_start();

$mysqli = mysqli_connect( 'database', 'lamp', 'lamp', 'lamp' );

require_once PATH_ROOT . 'app' . DS . 'pages' . DS . 'functions' . DS . 'global-functions.php';
require_once PATH_ROOT. 'app'. DS. 'router.php';

routerStart();

mysqli_close( $mysqli );