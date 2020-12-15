<div class="manage-staff-container">
    <div class="box-confirm" id="box-confirm">
        <div class="message-header">
            <h6>Confirm Cancel Order</h6>
            <button type="button" class="close-btn" onclick="closeBox()">
            <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-x my-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            </button>
        </div>
        <div class="message" id="message">Do you want to cancel this order ?</div>
        <div class="button">
            <button type="button" class="btn btn-warning text-white" id="confirm_button" ><span class="realign">Yes</span></button>
            <button type="button" class="btn btn-danger text-white" onclick="closeBox()"><span class="realign">No</span></button>
        </div>
    </div>
    <div class="form-order staff-order">
        <div class="form-horizontal">

            <div class="order-head">
                <h3>Order #<?php echo "$order->order_id"; ?></h3>
                <?php if ($order->order_status !== 'CANCEL') :?>
                <select id="status" class="order-status">
                    <option value="PENDING" <?php if ($order->order_status === "PENDING") echo 'selected'  ?>>PENDING</option>
                    <option value="DELIVERING" <?php if ($order->order_status === "DELIVERING") echo 'selected'  ?>>DELIVERING</option>
                    <option value="CANCEL" <?php if ($order->order_status === "CANCEL") echo 'selected'  ?>>CANCEL</option>
                    <option value="DONE" <?php if ($order->order_status === "DONE") echo 'selected'  ?>>DONE</option>
                </select>
                <?php else : ?>
                <h6> CANCEL</h6>
                <?php endif; ?>
            </div>
            <div class="user-info">
                <?php
                    echo "<span class='row pl-2'>Full Name:  $user->fullname </span>
                    <div class='row'>
                        <span class='col-sm-6'> Phone: $user->phone</span>
                        <span class='col-sm-6'> Email: $user->email </span>
                    </div>";
                ?>
            </div>
            <div class="order-info">
                <span class='row pl-2'>Delivery date (Expected): 
                    <?php if ($order->order_status !== 'CANCEL' && $order->order_status !== 'DONE') 
                        echo "<input type='datetime-local' id='delivery-date' value='" . str_replace(' ', 'T', $order->delivery_date) . "'>";
                        else {
                            echo $order->delivery_date === NULL ? 
                                "N/A" : 
                                date_format(date_create($order->delivery_date), 'd/m/Y - h:m');
                        }
                    ?>
                </span>
                <span class='row pl-2'>Address: <?php echo $order->address ?></span>
                <span class='row pl-2'>Note: <?php echo $order->order_note ?></span>
            </div>
            <div class="info-product">
                <?php
                    $products_element = "";
                    $total_price = 0;
                    foreach ($listProducts as $product_obj) {
                        $product = $product_obj['product_info'];
                        $serial_number = $product_obj['product_sn'];
                        $total_price += $product->product_price;
                        $formatted_price = number_format($product->product_price, 0, '', '.');
                        $products_element .= "
                            <div class='product-item'>
                            <div class='product-image'>
                                <div class='img'><img src='$product->link' alt='$product->product_name' /></div>
                            </div>
                            <div class='product-info'>
                                <div class='product-spec'>
                                    <p class='info name'>$product->product_name ($product->product_ram GB/$product->product_rom GB) - SN: " .($serial_number ?? 'N/A'). "</p>
                                    <p class='info'>Color: $product->product_color</p>
                                </div>
                                <span id='price' class='price'> $formatted_price VND</span>
                            </div>
                            </div>
                        ";
                    }
                    echo $products_element;
                ?>
            </div>
            <div class="cart-summary">
                <div class="cart-format">
                    <div class="cart-label">Total</div>
                    <div class="price"><?php echo number_format($total_price, 0, '', '.') ?> VND</div>
                </div>
            </div>
            <div class="cancel-btn">
                <button type="button" onclick="updateOrder(<?php echo $order->order_id ?>)" class="btn btn-outline-success btn-block">
                    Update
                </button>
            </div>
    </div>
</div>