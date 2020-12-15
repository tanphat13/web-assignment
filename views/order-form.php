<?php

$PageTitle="Order form". ' | ' . "smartphone.com";

include_once('layout/header.php');
?>

<div class="manage-staff-container">

    <a href="review-cart" class="btn btn-success next-btn">Next</a>

    <p class="quantity-notification"><span id="quantity" class="font-weight-bold"><?php echo count($session->get('cart')) ?: 0?></span> products in order</p>

    <form id="search">
        <div class="search-bar">
            <input type="text" placeholder="Input name" onkeyup="suggest(this.value)" id="input"/>
        </div>
    </form>

    <div class="info-product" id="product-search-list">
    <?php
        $products_element = "";
        foreach ($products_list as $product) {
            $formatted_price = number_format($product['product_price'], 0, '', '.');
            $products_element .= "
                <div class='product-item' id='product-item-$product[product_id]'>
                    <div class='product-image'>
                        <div class='img'><img src='$product[link]' alt='$product[product_name]' /></div>
                    </div>
                    <div class='product-info'>
                        <div class='product-spec'>
                            <p class='info name' id='product-$product[product_id]'>$product[product_name] ($product[product_ram] GB/$product[product_rom] GB)</p>
                            <p class='info'>Color: $product[product_color]</p>
                        </div>
                        <span id='price' class='price'> $formatted_price VND</span>
                    </div>
                    <button type='button' class='delete-btn' onclick='addProduct($product[product_id])'>Add</button>
                </div>
            ";
        }
        echo $products_element;
    ?>
    </div>
</div>