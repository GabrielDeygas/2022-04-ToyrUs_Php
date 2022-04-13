<?php
function topPartRender() {
    global $html_title;
    $all_brands = getAllBrands();
    $all_stores = getAllStores();
    require_once PATH_ROOT .'app'. DS .'pages'. DS .'partials'. DS .'top-part.php';
}


function getAllBrands() {
    global $mysqli;

    $result = [];

    $q = 'SELECT brands.id as marque_id, brands.name, count(brands.id) as b_quantity
            FROM brands
            JOIN toys ON brands.id = toys.brand_id
            GROUP BY brands.id';

    $q_result = mysqli_query( $mysqli, $q );

    if($q_result) {
        while ($brand = mysqli_fetch_assoc($q_result)){
            $result[] = $brand;
        }
    }
    return $result;
}

function getMaxPages(  ) {
    global $mysqli;

    $q = 'SELECT count(toys.id) as nombre_jouets
            FROM toys';

    $q_result = mysqli_query($mysqli, $q);

    if ($q_result) {
        while ($toy = mysqli_fetch_assoc($q_result)) {
            $arr_result = $toy;
        }
    }
    $result = $arr_result['nombre_jouets'];

    return intval(ceil($result / 4));
}

function getAllStores() {
    global $mysqli;

    $result = [];

    $q = 'SELECT stores.id, stores.name
             FROM stores';

    $q_result = mysqli_query( $mysqli, $q );

    if($q_result) {
        while ($store = mysqli_fetch_assoc($q_result)){
            $result[] = $store;
        }
    }
    return $result;
}