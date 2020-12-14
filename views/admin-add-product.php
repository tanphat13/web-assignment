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
    <form method='post' class=" create-staff-form">
        <div class="form-group row product-update-table-row">
            <div class="col-md table-cell-label">
                <label for="product_name">Product Name</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_name" class="form-control
                                    <?php
                                    echo $model->hasError('product_name') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_name">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_name');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_brand">Product Brand</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_brand" class="form-control
                                    <?php
                                    echo $model->hasError('product_brand') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_brand">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_brand');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_price">Price</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_price" class="form-control
                                    <?php
                                    echo $model->hasError('product_price') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_price">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_price');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_color">Color</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_color" class="form-control
                                    <?php
                                    echo $model->hasError('product_color') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_color">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_color');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_ram">RAM</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_ram" class="form-control
                                    <?php
                                    echo $model->hasError('product_ram') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_ram">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_ram');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_rom">ROM</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="product_rom" class="form-control
                                    <?php
                                    echo $model->hasError('product_rom') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_rom">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_rom');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="product_spec">Specification</label>
            </div>
            <div class="col-md table-cell-value">
                <textarea type="text" name="product_spec" class="form-control table-cell-value
                                    <?php
                                    echo $model->hasError('product_spec') ? ' is-invalid' : '';
                                    ?>
                                    " id="product_spec"></textarea>
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('product_spec');
                    ?>
                </div>
            </div>

        </div>

        <div class="row product-update-table-row form-group">
            <div class="col-md table-cell-label">
                <label for="warranty">Warranty</label>
            </div>
            <div class="col-md table-cell-value">
                <input type="text" name="warranty" class="form-control
                                    <?php
                                    echo $model->hasError('warranty') ? ' is-invalid' : '';
                                    ?>
                                    " id="warranty">
                <div class="invalid-feedback">
                    <?php
                    echo $model->getFirstError('warranty');
                    ?>
                </div>
            </div>

        </div>
        <button class="product-save-update" type="submit" >
            Add new product
        </button>
    </form>


</div>