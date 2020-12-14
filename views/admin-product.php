<div class="manage-products-container">
    <div class="table-action">
        <div class="table-action-search-bar">
            <label for="search-option">Options</label>
            <select name="search-option" id="search-option">
                <option value="Brand">Brand</option>
                <option value="Name">phone</option>
            </select>
            <input type='text' id="admimn-table-actions-search" class="search-input" placeholder="Search" onkeyup="searchStaff(this.value)">
        </div>
        <div class="btn-create-staff">
            <a href="/admin/add-new-product">Add new products</a>
        </div>
    </div>

    <div class="staff-table-wrapper">
        <div class="staff-table-row table-head">
            <div class='col-sm-1 table-cell'>Id</div>
            <div class='col-md table-cell'>Brand</div>
            <div class='col-md table-cell'>Product Name</div>
            <div class='col-md table-cell'>Actions</div>
        </div>
        <div id='table-content' class="staff-table-content">
            <?php
            echo $productList;
            ?>
        </div>

        <ul class="navigation-btn">
            <li class="nav-btn" <?php if ($page > 1) : ?> <a href="?page=1&limit=10">
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
    <div id='delete-confirm' class="delete-confirm-wrapper">
        <h3 class="delete-confirm-warning">
            Warning
        </h3>
        <div id="confirm-delete-message" class="delete-confirm-message">
            Do you want to delete this product
        </div>
        <div class="delete-confirm-btn-group">
            <div class="delete-btn" onclick="deleteModel()">
                Delete
            </div>
            <div onclick="closeConfirmDelete()" class="cancle-btn">
                Cancle
            </div>
        </div>

    </div>
</div>