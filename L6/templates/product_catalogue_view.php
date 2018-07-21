<?php foreach ($products as $product):?>
    <a href="/L6/wwwroot/cart.php?id=<?=$product['id']?>">
        <div class="product_catalogue">
            <div class="image">
                <img src="<?=$product['thumbnail_url']?>" />
            </div>
            <div class="name">
                <p><?=$product['name']?></p>
            </div>
            </div>
            <div class="description">
                <p><?=$product['short_desc']?></p>
            </div>
            <div class="price">
                <p><?=$product['price']?></p>
            </div>
            <div class="btns">

            </div>
        </div>
    </a>
<?php endforeach;?>