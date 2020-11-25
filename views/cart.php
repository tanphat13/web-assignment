<?php
    use app\core\Application;
?>

<div class="form-order">
    <form class="form-horizontal">
        <div class="order-head">
            <div class="heading-cart">You have <?php echo count($listProducts) ?> products in your cart</div>
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
                    echo var_dump($formatted_price);
                    $products_element .= "
                        <div class='product-image'>
                            <div class='img'><img src='$product->link' alt='$product->product_name' /></div>
                        </div>
                        <div class='product-info'>
                            <div class='product-spec'>
                                <h3 class='product-name'>$product->product_name ($product->product_ram GB/$product->product_rom GB)</h3>
                                <h5 class='product-color'>Color: $product->product_color</h5>
                            </div>
                        </div>
                        <span id='price'> $formatted_price VND</span>
                    ";
                }
                echo $products_element;
            ?>
        </div>
        <div class="cart-summary">
            <div class="grand-cart">
                <div class="cart-label">Total</div>
                <div class="price"><?php echo number_format($total_price, 0, '', '.') ?> VND</div>
            </div>
            <div class="charge-cart">
                <div class="cart-label">Total charge</div>
                <div class="price"><?php echo number_format($total_price, 0, '', '.') ?> VND</div>
            </div>
        </div>
        <div class="group-form-group">
            <div class="row-input">
                <label class="input-label" for="name" >Full Name: </label>
                <input type="text" name="name" class="form-control" placeholder="Your full name" value="<?php echo $user->fullname; ?>" />
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row-input">
                        <label class="input-label" for="email" >Email: </label>
                        <input type="text" class="form-control" placeholder="Your email" value="<?php echo $user->email; ?>" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row-input">
                        <label class="input-label" for="phone" >Phone Number: </label>
                        <input type="text" class="form-control" placeholder="Your phone number" value="<?php echo $user->phone; ?>" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>