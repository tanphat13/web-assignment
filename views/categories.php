<script>
        function setbounds($low, $high) {
            low_bound = $low;
            high_bound= $high;
            return 0;
        }
</script>
<?php
    $categoryList = array();
    $products = array();
    foreach($category as $key) {
        array_push($categoryList, $key);        
    }
    
    foreach($product as $index) {
        array_push($products, $index);
    }   
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    } 
    $pages = $total_page;    
?>
    

    <div class="categoryPage">
        
        <div class='categoryList'>
        <h2>Brand List</h2>
            <?php
                echo '<ul>'; 
                foreach($categoryList as $index) {
                    echo "<li><a href='?brand=$index&pageno=1'> $index </a></li>";
                }
                echo '</ul>';
            ?>
        <h2>Price (in VND)</h2>
            <ul>
                <li> 
                    <a href="?low_bound=0&high_bound=5000000&pageno=1">0 - 5.000.000</a> 
                </li>
                <li> 
                    <a href="?low_bound=5000000&high_bound=10000000&pageno=1">5.000.000 - 10.000.000</a> 
                </li>
                <li> 
                    <a href="?low_bound=10000000&high_bound=15000000&pageno=1">10.000.000 - 15.000.000</a> 
                </li>
                <li> 
                    <a href="?low_bound=15000000&high_bound=20000000&pageno=1">15.000.000 - 20.000.000</a> 
                </li>
                <li> 
                    <a href="?low_bound=20000000&high_bound=25000000&pageno=1">20.000.000 - 25.000.000</a> 
                </li>
                <li>  
                    <a href="?low_bound=25000000&high_bound=100000000&pageno=1"> 25.000.000 </a> 
                </li>
            </ul>
        </div>
        <!-- <div class="product_page"> -->
            <div class="product_matrix" >
                <?php
                    $array = "";
                    $array .= "<ul class='paging'>";
                    if (isset($low_bound) && isset($high_bound) && $pages > 1) {
                        for ($i = 1; $i <= $pages; $i++) {
                            $array .= "<li><a href=?low_bound=" .$low_bound ."&high_bound=" .$high_bound ."&pageno=" .$i ."> $i</a></li>";
                        }
                    }
                    else if (isset($brand) && $pages > 1) {
                        for ($i = 1; $i <= $pages; $i++) {
                            $array .= "<li><a href=?brand=" .$brand ."&pageno=" .$i ."> $i</a></li>";
                        }
                    }
                    $array .= "</ul>";
                    echo $array;
                ?>
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
        <!-- </div> -->
    </div>
    <!-- <?php
        $array = "";
        $array .= "<ul class='pagination'>";
        for ($i = 1; $i <= $pages; $i++) {
            $array .= "<li><a href=?low_bound=" .$low_bound ."&high_bound=" .$high_bound ."&pageno=" .$i ."> $i</a></li>";
        }
        $array .= "</ul>";
        echo $array;
    ?> -->
   
    <!-- <ul class="pagination">
    
        <li>
            <a href=".category?low_bound=<?php echo $low_bound?>&high_bound=<?php echo $high_bound?>&pageno=1">First</a>
        </li>
        <li>
            <a href="<?php echo ($pageno <= 1 ? '#' : '?low_bound='.$low_bound .'&high_bound=' .$high_bound .'&pageno=' .($pageno-1))?>" >Prev</a>
        </li>
        <li>
            <a href="<?php echo ($pageno >= $total_page ? '#' : '?low_bound='.$low_bound .'&high_bound=' .$high_bound .'&pageno=' .($pageno+1))?>" >Next</a>
            <?php echo $total_page?>
            
        </li>
    </ul> -->
    
  
    
    