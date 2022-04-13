<h1> Tous nos jouets </h1>
<form class="list-form" action="" method="get">
    <select name="bid" id="yes">

        <?php if($bid == 0): ?>
        <option name="marque_id" value="">Choisissez votre marque</option>
        <?php endif; ?>
        <?php foreach ($all_brands as $brand): ?>
        <option name="marque_id" value="<?php echo $brand['marque_id']?>"><?php echo $brand['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <select name="tri" id="agaagaagniih">
        <option value="1">Croissant</option>
        <option value="2">Décroissant</option>
    </select>
    <button type="submit">OK</button>
</form>
<ul class="ul-toyslist">

<?php foreach($all_toys as $toy): ?>

        <li class="list-home-li">
            <a href="/detail?id=<?php echo $toy['id']?>">
            <h2 class="list-home-h2"><?php echo $toy['name'] ?></h2>
            <img class="main-li-img" src="/media/<?php echo $toy['image']?>" />
            <p class="toyslist-p"><?php echo $toy['price'] ?> €</p>
            </a>
        </li>

    <?php endforeach; ?>

</ul>

<?php if ( $bid == 0 ): ?>
<div class="container-prev-next">
    <div class="boxes-a">
<?php if( !empty( $url_prev ) ): ?>
    <a class="a-change-page" href="<?php echo $url_prev?>">⇦ Précédent</a>
<?php endif; ?>
</div>

<div class="boxes-a">
    <span><?php printf( '%s / %s', $page_number, $max_page) ?></span>
</div>

<div class="boxes-a">
<?php if( !empty( $url_next ) ): ?>
    <a class="a-change-page" href="<?php echo $url_next?>">Suivant ⇨</a>
<?php endif; ?>
</div>
</div>
<?php endif; ?>