<div class="manage-staff-container">
    <div class="box-confirm" id="box-confirm">
        <div class="message-header">
            <h6>Confirm Removing Product</h6>
            <button type="button" class="close-btn" onclick="closeBox()">
            <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-x my-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            </button>
        </div>
        <div class="message" id="message"></div>
        <div class="button">
            <button type="button" class="btn btn-warning text-white" id="confirm_button" ><span class="realign">Yes</span></button>
            <button type="button" class="btn btn-danger text-white" onclick="closeBox()">No</button>
        </div>
    </div>
    <div class="form-order">
        <form class="form-horizontal" method="POST" action="/staff/ordering">
            <div class="order-head">
                <div class="heading-cart"><strong id="number-in-cart"><?php echo count($listProducts) ?></strong> products in cart</div>
            </div>
            <div class="info-product">
                <?php
                    $products_element = "";
                    $total_price = 0;
                    foreach ($listProducts as $product_obj) {
                        $product = $product_obj["product_info"];
                        $total_price += $product->product_price;
                        $formatted_price = number_format($product->product_price, 0, '', '.');
                        $products_element .= "
                            <div class='product-item' id='product-item-$product->product_id'>
                                <div class='product-image'>
                                    <div class='img'><img src='$product->link' alt='$product->product_name' /></div>
                                </div>
                                <div class='product-info'>
                                    <div class='product-spec'>
                                        <p class='info name' id='product-$product->product_id'>$product->product_name ($product->product_ram GB/$product->product_rom GB)</p>
                                        <p class='info'>Color: $product->product_color</p>
                                    </div>
                                    <span id='price' class='price'> $formatted_price VND</span>
                                </div>
                                <button type='button' class='delete-btn' onclick='confirmRemoveProduct($product->product_id)'>Remove</button>
                            </div>
                        ";
                    }
                    echo $products_element;
                ?>
            </div>
            <div class="cart-summary">
                <div class="cart-format">
                    <div class="cart-label">Total</div>
                    <div class="price" id="total-price"><?php echo number_format($total_price, 0, '', '.') ?> VND
                    </div>
                </div>
                <div class="cart-format">
                    <div class="cart-label">Total charge</div>
                    <div class="price" id="total-charge"><?php echo number_format($total_price, 0, '', '.') ?> VND</div>
                </div>
            </div>
            <div class="form-group">
                <div class="personal-info">
                    <div class="row pl-3">
                        <label>Full Name: </label>
                        <input type="text" class="ml-2 mb-2 pl-2 w-75 h-75" name="name" placeholder="Customer Name" />
                    </div>
                    <div class="row pl-3 w-100">
                        <div class="col-sm-6">
                            <div class="row">
                                <label>Email: </label>
                                <input type="text" class="ml-2 pl-2 w-75 h-75" name="email" placeholder="Email"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <label>Phone Number: </label>
                                <input type="text" class="ml-2 pl-2 w-50 h-75" name="phone" placeholder="Phone Number" />
                            </div>
                        </div>
                    </div>
                    <div class="row-input">
                        <label for="note" class="input-label">Note: </label>
                        <textarea type="text" name="note" class="form-control" placeholder="Note" row="2"></textarea>
                    </div>
                </div>
                <div class='order-method'>
                    <label>Choose place to get your products: </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="method" id="branch" value="2" checked>
                        <label class="form-check-label" for="branch">At Closest Store </label>
                    </div>
                </div>
                <div id="address" class='address-opt'><?php echo $storeAddress ?></div>
                <button type="submit" class='btn order-btn' <?php if (count($listProducts) === 0) : ?> disabled <?php endif; ?> >Order</button>
            </div>
        </form>
    </div>
</div>