<?php
    $categoryList = array();
    $products = array();
    foreach($model as $key) {
        array_push($categoryList, $key);        
    }
    foreach($product as $index) {
        array_push($products, $index);
    }    
?>

<html>
    <div class="categoryPage">
        <div class='categoryList'>
        <h2>Brand List</h2>
            <?php 
                foreach($categoryList as $index) {
                    echo "<a href='?brand=$index'> $index </a><br>";
                }
            ?>
        </div>
        <div class="product_matrix" >
            <?php 
                foreach($products as $nindex) {
                   echo "<div class='product_item'>
                   <a href='#' >
                    <img src='./assets/$nindex[product_id].png'><br> $nindex[product_name] <br> $nindex[product_price]
                   </a>
                   </div>";
                   
                }
            ?>
        </div>
    </div>

</html>
