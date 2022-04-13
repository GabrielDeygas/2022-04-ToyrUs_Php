<?php
$GLOBALS['html_title'] = 'Détail';

function toysDetailRender() {
    topPartRender();
    $all_stores = getAllStores();
    $toy = getThisToy();

    require_once PATH_ROOT .'app'. DS .'pages'. DS .'detail.php';
    require_once PATH_ROOT .'app'. DS .'pages'. DS .'partials'. DS .'bottom-part.php';
}

function getThisToy() {
    global $mysqli;

    if(empty($_GET['id'])){
        return null; #TODO: Rediriger vers page 403
    }

    if(empty($_GET['magasin'])){
        $q_prep = 'SELECT toys.id, toys.description, toys.image, toys.name, toys.price,
                          brands.name as marque, sum(quantity)
            FROM toys
            JOIN stock  ON stock.toy_id = toys.id
            JOIN stores ON stores.id = stock.store_id
            JOIN brands ON toys.brand_id = brands.id
            WHERE toys.id = ?
            GROUP BY toys.id';

        if( $stmt = mysqli_prepare( $mysqli, $q_prep)){
            $id_toys = $_GET['id'];

           if( mysqli_stmt_bind_param( $stmt, 'i', $id_toys) ) {
               mysqli_stmt_execute( $stmt );

               $result = mysqli_stmt_get_result( $stmt );

               mysqli_stmt_close( $stmt );

               if( !$result  ) return null;

               return mysqli_fetch_assoc( $result );
           }
        }

    } else {
        $q_prep = 'SELECT toys.id, toys.description, toys.image, toys.name, toys.price,
                          brands.name as marque, sum(quantity)
        FROM toys
        JOIN stock  ON stock.toy_id = toys.id AND store_id= ?
        JOIN stores ON stores.id = stock.store_id
        JOIN brands ON toys.brand_id = brands.id
        WHERE toys.id = ?
        GROUP BY toys.id';

        if( $stmt = mysqli_prepare( $mysqli, $q_prep)){
            $id_store = $_GET['magasin'];
            $id_toys = $_GET['id'];

            if( mysqli_stmt_bind_param( $stmt, 'ii', $id_store,$id_toys ) ) {
                mysqli_stmt_execute( $stmt );

                $result = mysqli_stmt_get_result( $stmt );

                mysqli_stmt_close( $stmt );

                if( !$result  ) return null;
                return mysqli_fetch_assoc( $result );
            }
        }
    }
}

