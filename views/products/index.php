<?php
    echo '<ul>';
    foreach ($products as $product) {
        echo '<li>
            <a href="#">' . $product->name . '</a>
        </li>';
    }
    echo '</ul>';
?>