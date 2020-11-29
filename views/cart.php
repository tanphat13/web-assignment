<?php
    use app\core\Application;
?>

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
    <form class="form-horizontal" method="POST" action="/ordering">
        <div class="order-head">
            <div class="heading-cart">You have <strong id="number-in-cart"><?php echo count($listProducts) ?></strong> products in your cart</div>
            <div class="more-buy">
                <a href="/category">Buy more</a>
            </div>
        </div>
        <div class="info-product">
            <?php
                $products_element = "";
                $total_price = 0;
                foreach ($listProducts as $product) {
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
                <div class="row-input">
                    <label class="input-label" for="name" >Full Name: </label>
                    <input type="text" name="name" class="form-control" placeholder="Your full name" value="<?php if (isset($user->fullname)) echo $user->fullname; ?>" />
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row-input">
                            <label class="input-label" for="email" >Email: </label>
                            <input type="text" name='email' class="form-control" placeholder="Your email" value="<?php if (isset($user->email)) echo $user->email; ?>" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row-input">
                            <label class="input-label" for="phone" >Phone Number: </label>
                            <input type="text" name='phone' class="form-control" placeholder="Your phone number" value="<?php if (isset($user->phone)) echo $user->phone; ?>" />
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
                    <input class="form-check-input" type="radio" name="method" id="home" value="1" onchange="handleOrderMethod('home', <?php echo $user->id ?>)">
                    <label class="form-check-label" for="home">At Home</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="method" id="branch" value="2" onchange="handleOrderMethod('store')">
                    <label class="form-check-label" for="branch">At Closest Store </label>
                </div>
            </div>
            <div id="address" class='address-opt'></div>
            <button type="submit" class='btn order-btn'>Order</button>
        </div>
    </form>
</div>