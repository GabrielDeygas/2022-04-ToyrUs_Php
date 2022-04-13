<h1> Tous nos jouets </h1>

<?php if(is_null($toy)): ?>
<div>
    <p>Cette requête ne renvoie rien.</p>
</div>
<?php http_response_code( 403 ); return; endif; ?>

<h2 class="details-h2"><?php echo $toy['name']?></h2>
<div class="details-li-global-container">
    <div class="details-li-container1">
        <div class="details-container-img">
            <img class="details-img" src="/media/<?php echo $toy['image']?>" />
        </div>
        <p class="detail-price"><?php echo $toy['price'] ?> €</p>
            <form class="detail-form" action="" method="get">
                <input type="hidden" name="id" value="<?php echo $toy['id'] ?>">
                <select name="magasin" id="yes">

                    <option name="magasin">Choisissez votre magasin</option>
                    <?php foreach($all_stores as $store): ?>
                    <option name="magasin" value="<?php echo $store['id']?>"><?php echo $store['name']?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">OK</button>
            </form>
            <p class="details-stock"><span class="blue">Stock :</span>  <?php echo " " . $toy['sum(quantity)']?></p>
    </div>

    <div class="details-li-container2">
        <p><span class="blue">Marque :</span> <?php echo $toy['marque']?></p>
        <?php echo $toy['description']?>
    </div>
</div>
