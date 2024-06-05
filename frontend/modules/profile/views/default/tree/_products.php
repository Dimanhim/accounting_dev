<?php if($products) : ?>
    <ul>
        <?php foreach($products as $product) : ?>
            <li>
                <?= $product['name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;  ?>
