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

    <div id="carouselIndicators" class="carousel slide event-slide" data-ride="carousel" data-pause="hover" data-interval=3000>
        <div class="carousel-inner">
            <?php
                $image_slide = ""; 
                foreach($events as $event) {
                    $image_slide .= "<div class='carousel-item ";
                    if (array_search($event, $events) === 0) $image_slide .= "active";
                    $image_slide .= "'>
                        <img src='$event[link]' class='d-block w-100'/>
                        </div>
                    ";
                } 
                echo $image_slide;
            ?>
        </div>
    </div>
    <div class="home_brand_matrix">
        <!-- <div class="home_brand_row"> -->
            <?php
                foreach($brands as $key) {
                    echo "<div class='home_brand_row'> 
                    <div class='home_brand_header'>
                    <h4 class='home_brand'> $key </h4>
                    <a class='seeall' href='/category?brand=$key&pageno=1'>See all
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

