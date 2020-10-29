<?php
    echo '<ul>';
    foreach ($products as $product) {
        echo '<li>
            <a href="index.php?controller=products&action=showProduct&id=' . $product->id . '">' . $product->name . '</a>
        </li>';
    }
    echo '</ul>';
?>