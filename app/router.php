<?php

function routerStart(): void
{
    $route = $_SERVER['REDIRECT_URL'] ?? '/';

    switch( $route ) {
        case '/':
            require_once PATH_ROOT .'app'. DS .'pages'. DS .'functions'. DS .'home-functions.php';
            homeRender();
            break;

        case '/jouets':
            require_once PATH_ROOT . 'app' . DS . 'pages' . DS . 'functions' . DS . 'toys-list-functions.php';
            toysListRender();
            break;

        case '/detail':
            require_once PATH_ROOT .'app'. DS. 'pages'. DS. 'functions'. DS. 'detail-functions.php';
            toysDetailRender();
            break;

        default:
            http_response_code( 404 );
            echo '404 - Cette page n\'existe pas';
            break;
    }

}