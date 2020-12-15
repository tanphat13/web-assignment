<div class="manage-staff-container">

    <div class="staff-table-wrapper">
        <div class="staff-table-row table-head">
            <div class='col-sm table-cell'>Order Id</div>
            <div class='col-md table-cell'>Order Date</div>
            <div class='col-md table-cell'>Delivery Date</div>
            <div class='col-md table-cell'>Order Status</div>
            <div class='col-md table-cell'>Order Method</div>
            <div class='col-sm-1 table-cell'>Action</div>
        </div>
        <?php
        echo $order_list;
        ?>
        <ul class="navigation-btn">
            <li class="nav-btn"> <?php if ($page > 1) : ?> <a href="?page=1&limit=10">
                First
                </a>
            <?php endif ?>

            </li>
            <li class="nav-btn">
                <?php if ($page > 1) : ?>
                    <a href=<?php echo "?page=" . ($page - 1) . "&limit=10" ?>>
                        Previous
                    </a>
                <?php endif ?>

            </li>
            <li class="nav-btn">
                <?php if ($page < $totalPage) : ?>
                    <a href=<?php echo "?page=" . ($page + 1) . "&limit=10" ?>>
                        Next
                    </a>
                <?php endif ?>
            </li>
            <li class="nav-btn">
                <?php if ($page < $totalPage) : ?>
                    <a href=<?php echo "?page=$totalPage&limit=10" ?>>
                        Last
                    </a>
                <?php endif ?>
            </li>
        </ul>
    </div>
</div>