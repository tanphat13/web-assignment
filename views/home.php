<?php

use app\models\Product;

$products_homepage = array();
    $brandlist = array();
    foreach ($product_home as $key) {
        array_push($products_homepage, $key);
    }
    foreach ($brands as $key) {
        array_push($brandlist, $key);
    }
    // echo var_dump($products_homepage);
    // echo var_dump($brands);
?>
<html>
    <div class="home_brand_matrix">
        <!-- <div class="home_brand_row"> -->
            <?php
                foreach($brands as $key) {
                    echo "<div class='home_brand_row'> 
                    <div class='home_brand_header'>
                    <h4 class='home_brand'> $key </h4>
                    <a class='seeall' href='/category?brand=$key'>See all
                    </a>
                    </div>
                    <div class='home_product_row'>";
                    foreach($product_home as $index) {
                        if ($index['product_brand'] == $key) {
                            echo "<div class='home_product_item'>
                                <a href='product?id=$index[product_id]' >
                                    <img src= ".$index['link']." ><br> $index[product_name] <br>" . number_format($index['product_price'], 0, '', '.' ) ."
                                </a>
                                </div>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        <!-- </div>         -->
    </div>

</html>