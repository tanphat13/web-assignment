<?php
    use app\core\Application;
?>

<link rel="stylesheet" href="./styles/product.css" />
<h3><?php echo $model['product']->product_name . "(" . $model['product']->product_ram . "GB/" . $model['product']->product_rom . "GB)" ?></h3>
<div class="product">
    <img class="product-image" src="./assets/iphone6s.jpg"/>
    <div class="product-info">
        <h4><?php echo $model['product']->product_price ?>$</h4>
        <?php 
            $list_alternative = "<div class='alternative'>";
                foreach ($model['same_model'] as $product) {
                    $list_alternative .= "
                        <a href='product?id=$product[product_id]' class='model'>
                            <p class='font-weight-bold'>$product[product_ram]GB/$product[product_rom]GB</p>
                            <p class='text-danger'>$product[product_price]$</p>
                        </a>
                    ";
                }
            $list_alternative .= "</div>";
            echo $list_alternative;
        ?>
        <button class='purchase-btn'>
            <h6>Purchase Now</h6>
            <p>Shipping Or Receive At Nearest Store</p>
        </button>
        <div class='divider'></div>
        <p><em class="font-weight-bold">Hotline: </em>1800.9988</p>
        <p>Working Time: <em class="font-weight-bold">9AM-9:30PM</em></p>
    </div>
    <div class="rightInfo" >
        <div class="more-info">
            <ul>
                <li>
                    <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-box text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                    </svg>
                    <p><em class="font-weight-bold">Box includes:</em> Smartphone, Charger, Charging Cable, SIM ejecting tool</p>
                </li>
                <li>
                    <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"/>
                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    <p>One to one in <em class="font-weight-bold">30 days</em>, warranty in <em class="font-weight-bold"><?php echo $model['product']->warranty ?> months</em></p>
                </li>
                <li>
                    <svg width="3em" height="1em" viewBox="0 0 16 16" class="bi bi-truck text-warning" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    <p>Freeship in urban areas of Ho Chi Minh City</p>
                </li>
            </ul>
        </div>
        <p class="font-weight-bold bg-warning text-light label">AVAILABLE AT: </p>
        <ul class="branch-container">
            <?php
                foreach ($model['branches'] as $branch) {
                    echo "<li> $branch->branch_address - Contact: $branch->branch_phone</li>";
                }
            ?>
        </ul>
    </div>
</div>