<div class="product-update-page-header">
    Update products information
</div>
<div class="product-update-table-container">
    <div class="row product-update-table-head">
        <div class="col-md">
            Properties
        </div>
        <div class="col-md">
            Value
        </div>
        
    </div>
    <?php
    $regex = "/^(?=.*errors)|(?=.*created)|(?=.*deleted)|(?=.*updated)/";
    foreach ($product_item as $key => $value) {
        if (preg_match($regex, $key) === 0) {
            echo
                '<div class=" row product-update-table-row">
                    <div class="col-md table-cell-label">' .
                    $key .
            '</div>
                    <div class="col-md table-cell-value" data-content="' . $key . '" id="table-cell-product-name" contenteditable="true" data>' .
                    $value .
                    '</div>
                </div>';
        }
    }
    ?>



    <button class="product-save-update" type="submit" onclick="EditCell()">
        Save
    </button>

</div>