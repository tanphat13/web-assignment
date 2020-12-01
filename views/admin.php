<div class="manage-staff-container">
    <div class="table-action">
        <div class="table-action-search-bar">
            <label for="search-option">Options</label>
            <select name="search-option" id="search-option">
                <option value="fullname">Fullname</option>
                <option value="phone">phone</option>
                <option value="email">email</option>
            </select>
            <input type='text' id="admimn-table-actions-search" class="search-input" placeholder="Search" onkeyup="searchStaff(this.value)">
        </div>
        <div class="btn-create-staff">
            <a href="/admin/create-new-staff">Add new staff</a>
        </div>
    </div>

    <div class="staff-table-wrapper">
        <div class="staff-table-row table-head">
            <div class='col-sm-1 table-cell'>Id</div>
            <div class='col-md table-cell'>Name</div>
            <div class='col-md table-cell'>Phone number</div>
            <div class='col-md table-cell'>Email</div>
            <div class='col-sm-1 table-cell'>Gender</div>
            <div class='col-sm-1 table-cell'>Actions</div>
        </div>
        <div id='table-content' class="staff-table-content">
            <?php
            echo $staffList;
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

    <form method="post" id="staff-update-form" class="staff-update-form">

        <div class="form-title">
            Update staff information form
        </div>
        <div class="form-group">
            <p id="update-message"></p>
        </div>
        <div class="form-group">
            <label for="fullname">Staff name:</label>
            <input type="text" name="fullname" class="form-control
        <?php
        echo $model->hasError('fullname') ? ' is-invalid' : '';
        ?>
        " id="fullname">
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('fullname');
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email address:</label>
            <input id="email" type="email" name="email" class="form-control <?php
                                                                            echo $model->hasError('email') ? ' is-invalid' : '';
                                                                            ?>" id="email" aria-describedby="emailHelp">
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('email');
                ?>
            </div>
        </div>
        <div class="form-group ">
            <label for="phone">Phone number:</label>
            <input id="phone" name="phone" type="number" class="form-control <?php
                                                                                echo $model->hasError('phone') ? ' is-invalid' : '';
                                                                                ?>" aria-describedby="emailHelp">
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('phone');
                ?>
            </div>
        </div>

        <div class="btn btn-primary update-btn" onClick="updateStaffInfo()">Update</div>
        <div id='update-form-close-btn' class='close-btn' onClick="closeUpdateForm()">
            x
        </div>
    </form>
</div>