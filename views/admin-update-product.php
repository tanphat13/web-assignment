<div class="product-update-table-container">
    <?php
        // echo "<pre>";
        // echo var_dump($product_item);
        // echo "</pre>";
        $regex = "/^(?=.*errors)|(?=.*created)|(?=.*deleted)|(?=.*updated)/";
        foreach($product_item as $key =>$value){
            if(preg_match($regex,$key)===0){
                echo
                '<div class="product-update-table-row">
                    <div class="table-cell-label">'.
                        $key .
                    '</div>
                    <div class="table-cell-value" data-content="'.$key.'" id="table-cell-product-name" contenteditable data>'. 
                        $value.
                    '</div>
                </div>';
            }
        }
    ?>

 

    <button type="submit" onclick="testEditCell()">
        Save
    </button>

</div>