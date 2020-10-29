<?php
    echo '<ul>';
    foreach ($posts as $post) {
        echo '<li>
            <a href="#"' . $post->name . '</a>
        </li>';
    }
    echo '</ul>';
?>