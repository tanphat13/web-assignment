<?php
    $categoryList = array();
    $products = array();
    foreach($category as $key) {
        array_push($categoryList, $key);        
    }
    foreach($product as $index) {
        array_push($products, $index);
    }    
?>


    <div class="categoryPage">
        <div class='categoryList'>
        <h2>Brand List</h2>
            <?php
                echo '<ul>'; 
                foreach($categoryList as $index) {
                    echo "<li><a href='?brand=$index'> $index </a></li>";
                }
                echo '</ul>';
            ?>
        <h2>Price (in VND)</h2>
            <ul>
                <li> <a href="?low_bound=0&high_bound=5000000">0 - 5.000.000</a> </li>
                <li> <a href="?low_bound=5000000&high_bound=10000000">5000000 - 10.000.000</a> </li>
                <li> <a href="?low_bound=10000000&high_bound=15000000">10.000.000 - 15.000.000</a> </li>
                <li> <a href="?low_bound=15000000&high_bound=20000000">15.000.000 - 20.000.000</a> </li>
                <li> <a href="?low_bound=20000000&high_bound=25000000">20.000.000 - 25.000.000</a> </li>
                <li> <a href="?low_bound=20000000&high_bound=1000000000">> 25.000.000 </a> </li>
            </ul>
        </div>
        <div class="product_matrix" >
            <?php 
                foreach($products as $nindex) {
                   echo "<div class='product_item'>
                   <a href='product?id=$nindex[product_id]' >
                    <img src= ".$nindex['link']." ><br> $nindex[product_name] <br>" . number_format($nindex['product_price'], 0, '', '.' ) ."
                   </a>
                   </div>";
                   
                }
            ?>
        </div>
        
    </div>
