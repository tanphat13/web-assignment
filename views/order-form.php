<div class="manage-staff-container">
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
                <button type='button' class='delete-btn' onclick='confirmRemoveProduct($product[product_id])'>Remove</button>
            </div>
        ";
    }
    echo $products_element;
?>
</div>