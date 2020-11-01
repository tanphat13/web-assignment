<?php

/**
 * @var $exception \Exception
 */

?>

<h3>
    <div class='status-code'>
        <?php
            echo $exception->getCode();
        ?>
    </div>
    <div class="error-message">
        <?php
            echo $exception->getMessage();
        ?>
    </div>



</h3>