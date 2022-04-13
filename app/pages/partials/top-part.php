<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/header.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/main-style.css" rel="stylesheet">

    <title><?php echo $html_title ?> - Toys R'Us </title>

</head>
<body>
    <div class="site-background">
        <img class="site-background-img" src="/media/background.jpg">
            <div class="site-container">

    <header>

        <div class="header-logo-container">
            <a href="/">
            <img class="header-logo-img" src="/media/logo.png" alt="logo">
            </a>
        </div>

        <nav class="navbar-menu">
            <ul class="ul-navbar">
               <li class="nav-li-main li-main-alltoys"><a href="/jouets"><p class="li-main-text">Tous nos jouets</p></a></li>
                <li class="nav-li-main li-main-brands"><a href=""><p class="li-main-text li-main-text-brands">Par marque</p></a>
                    <ul class="navbar-slide-ul">
                        <?php foreach($all_brands as $brand): ?>
                        <li class="nav-li">
                            <a href="/jouets?bid=<?php echo $brand['marque_id'] . '&tri=1'?>">
                                <p class="list-home-p"><?php echo $brand['name'] ?> (<?php echo $brand['b_quantity']?>)</p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

        </nav>


    </header>

                <main>



