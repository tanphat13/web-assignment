<div class="manage-staff-container">
    <div class="table-action">
        <div class="btn-create-staff">
            <a href="/admin/create-new-staff">Add new staff</a>
        </div>
    </div>

    <div class="staff-table-wrapper">
        <div class="staff-table-row">
            <div class='col-sm-1 table-cell'>Id</div>
            <div class='col-md table-cell'>Name</div>
            <div class='col-md table-cell'>Phone number</div>
            <div class='col-md table-cell'>Email</div>
            <div class='col-sm-1 table-cell'>Gender</div>
        </div>
        <?php
        echo $staffList;
        ?>
        <ul class="navigation-btn">
            <li>
                <?php if ($page > 1) : ?>
                    <a href="?page=1&limit=1">
                        First
                    </a>
                <?php endif ?>

            </li>
            <li>
                <?php if ($page > 1) : ?>
                    <a href=<?php echo "?page=" . ($page - 1) . "&limit=1" ?>>
                        Previous
                    </a>
                <?php endif ?>
                
            </li>
            <li>
                <?php if ($page < $totalPage) : ?>
                    <a href=<?php echo "?page=" . ($page + 1) . "&limit=1" ?>>
                        Next
                    </a>
                <?php endif ?>
            </li>
            <li>
                <?php if ($page < $totalPage) : ?>
                    <a href=<?php echo "?page=$totalPage&limit=1" ?>>
                        Last
                    </a>
                <?php endif ?>
            </li>
        </ul>
    </div>

    <form class="staff-update-form">
        <div class="form-group">
            <label for="fullname">Name</label>
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
            <label for="email">Email address</label>
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
            <label for="phone">Phone number</label>
            <input id="phone" name="phone" type="number" class="form-control <?php
                                                                                echo $model->hasError('phone') ? ' is-invalid' : '';
                                                                                ?>" id="phone" aria-describedby="emailHelp">
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('phone');
                ?>
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>