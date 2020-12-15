<?php
    use app\core\Application;
?>
<?php

$PageTitle = $product['product']->product_name . ' | ' . "smartphone.com";

include_once('layout/header.php');
?>
<h3><?php echo $product['product']->product_name . "(" . $product['product']->product_ram . "GB/" . $product['product']->product_rom . "GB) - Rate: ".($product['product']->rating ?? 'N/A') ?></h3>
<div class="product">
    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                foreach ($product['product_images'] as $image) {
                    $image_link = $image['link'];
                    $index = array_search($image, $product['product_images']);
                    echo "<li data-target='#carouselIndicators' data-slide-to='$index'";
                    if ($index === 0) echo " class='active'";
                    echo ">
                        <img src='" . $image_link . "class='img-thumbnail' alt='" . $product['product']->product_name . "'/>
                        </li>
                    ";
                }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
                foreach ($product['product_images'] as $image) {
                    $index = array_search($image, $product['product_images']);
                    echo "<div class='carousel-item";
                    if ($index === 0) echo " active";
                    echo "'>
                        <img src='" . $image['link'] . "'class='d-block w-100' alt='" . $product['product']->product_name . "'/>
                        </div>
                    ";
                }
            ?>
        </div>
        <?php if (count($product['product_images']) > 1) : ?>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <?php endif ?>
    </div>
    <div class="product-info">
        <h4 id="price"><?php echo number_format($product['product']->product_price, 0, '', '.') ?> VND</h4>
        <?php 
            $list_alternative = "<div class='alternative'>";
            foreach ($product['diff_spec'] as $alternativeModel) {
                $list_alternative .= "
                    <a href='product?id=$alternativeModel[product_id]' class='model'>
                        <p class='font-weight-bold'>$alternativeModel[product_ram]GB/$alternativeModel[product_rom]GB</p>
                        <p class='text-danger'>" . number_format($alternativeModel['product_price'], 0, '', '.') . "VND </p>
                    </a>
                ";
            }
            $list_alternative .= "</div>";
            echo $list_alternative;
        ?>
        <h6>Choose Color:</h6>
        <?php
            $list_color = "<div class='btn-group'>";
            foreach ($product['diff_color'] as $diffColorModel) {
                $list_color .= "
                    <button type='button' class='btn grid-item' onclick='loadAvailableBranch($diffColorModel[product_id])'>
                        <h6>$diffColorModel[product_color]</h6>
                        <p id='new_price_$diffColorModel[product_id]'>" . number_format($diffColorModel['product_price'], 0, '', '.') . " VND</p>
                    </button>
                ";
            }
            $list_color .= "</div>";
            echo $list_color;
        ?>
        <button class='purchase-btn' onclick="addToCart(<?php echo $session->get('user') ?>)">
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
                    <p>One to one in <em class="font-weight-bold">30 days</em>, warranty in <em class="font-weight-bold"><?php echo $product['product']->warranty ?> months</em></p>
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
        <ul class="branch-container" id="branch-container"><?= $branches ?></ul>
    </div>
</div>
<div class="additional-info">
    <div class="about-product">
        <h4>About Product</h4>
        <?php echo $product['product']->product_spec ?>
    </div>
    <div id="rating">
        <input type="radio" id="star5" name="rating" value="5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
        
        <input type="radio" id="star4half" name="rating" value="4.5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        
        <input type="radio" id="star4" name="rating" value="4" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        
        <input type="radio" id="star3half" name="rating" value="3.5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        
        <input type="radio" id="star3" name="rating" value="3" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class = "full" for="star3" title="Meh - 3 stars"></label>
        
        <input type="radio" id="star2half" name="rating" value="2.5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        
        <input type="radio" id="star2" name="rating" value="2" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        
        <input type="radio" id="star1half" name="rating" value="1.5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        
        <input type="radio" id="star1" name="rating" value="1" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        
        <input type="radio" id="starhalf" name="rating" value="0.5" onchange="handleRating(this, <?php echo $product['product']->product_id . ',' . $session->get('user')?>)"/>
        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
    </div>
    <div class="form-group">
        <textarea id="input-comment" class="form-control input-comment" rows="3" placeholder="Ask a question"></textarea>
        <button type="submit" value="Submit" class="btn btn-primary mb-2" onclick="submitComment(<?php echo $product['product']->product_id . ',' . $session->get('user') ?>)">Submit</button>
    </div>
    <div id="comments" class="comment-container">
        <?php
        $comments_element = "";
            foreach ($comments as $comment) {
                if (is_string($comment)) {
                    $comments_element .= "
                        <div id='$comment'></div>
                    ";
                    continue;
                }
                $date = date_create($comment['created_at'], timezone_open('Asia/Ho_Chi_Minh'));
                $date_format = date_format($date, 'H:i - d/m/Y');
                $comments_element .= "<div class='comment-element";
                if ($comment['is_answer'] === "2") {
                    $comments_element .= " answer-comment";
                }
                $comments_element .= "'>
                    <div class='comment-info'>
                        <p class='font-weight-bold m-0'>" . $comment['fullname'] . "</p>
                        <p class='font-italic text-muted time'>Sent at " . $date_format ."</p>
                    </div>
                    <div class='text-break content'>" . $comment['content'] . "</div>
               ";
                $comment_id = $comment['answer_id'];
                if ($comment['is_answer'] === '1') $comment_id = $comment['comment_id'];
                $comments_element .= "
                    <button onclick='loadAnswerInput(" .$product['product']->product_id. "," .$session->get('user'). "," .$comment_id.")'>
                        Reply
                    </button>
                    </div>
                ";
            }
            echo $comments_element;
        ?>
    </div>
</div>


<script>
    function loadAvailableBranch(product_id, new_price) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.cookie = "productId = " + product_id;
                document.getElementById('price').innerText = number_format(new_price, 0, '', '.') + " VND";
                document.getElementById('branch-container').innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "/branch?id="+product_id, true);
        xhttp.send();
    }
    function handleRating(myRadio, product_id, user_id) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('rating').innerHTML = '<p>Thank you for your rating</p>';
            }
        };
        xhttp.open("POST", "/rating", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("product_id="+product_id+"&user_id="+user_id+"&rate="+myRadio.value);
    }
    function loadAnswerInput(comment_id) {
        document.getElementById('comment-' + comment_id).innerHTML = 
        "<textarea id='input-comment" + comment_id + "'class='form-control input-comment' rows='3' placeholder='Input your answer'></textarea><button type='submit' value='Submit' class='btn btn-primary mb-2' onclick='submitComment(<?php echo $product['product']->product_id . ',' . $session->get('user') ?>, " + comment_id + ")'>Submit</button>"
    }
    function submitComment(product_id, user_id, answer_id = '') {
        let xhttp = new XMLHttpRequest();
        let is_answer = answer_id === '' ? 1 : 2;
        let input = document.getElementById('input-comment' + answer_id);
        let content = input.value;
        input.value = '';
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('comments').innerHTML = this.responseText;
            }
        }
        xhttp.open("POST", "/comment", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("product_id="+product_id+"&user_id="+user_id+"&is_answer="+is_answer+"&content="+content+"&answer_id="+answer_id);
    }
</script>
