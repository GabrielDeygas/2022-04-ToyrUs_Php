<h1> Les 3 meilleures ventes </h1>

    <ul class="container-li-home">

    <?php foreach($best_sales as $sale): ?>

            <li class="list-home-li">
                <a href="detail?id=<?php echo $sale['id']?>">
                <h2 class="list-home-h2"><?php echo $sale['name'] ?></h2>
                <img class="main-li-img" src="/media/<?php echo $sale['image']?>" />
                <p class="li-home-price"><?php echo $sale['price'] ?> €</p>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>
