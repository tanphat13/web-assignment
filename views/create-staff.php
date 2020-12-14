<div class="create-staff-wrapper">
    <h1>Create staff form</h1>
    <form method='post' class="create-staff-form">
        <div class="form-group row">
            <label for="fullname" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
                <input type="text" name="fullname" class="form-control
        <?php
        echo $model->hasError('fullname') ? ' is-invalid' : '';
        ?>
        " id="fullname">
            </div>
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('fullname');
                ?>
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input <?php
                                            echo $model->hasError('gender') ? ' is-invalid' : '';
                                            ?>" type="radio" name="gender" value="male" id="male" checked>
            <label class="form-check-label col-sm-4 col-form-label" for="male">
                Male
            </label>
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('gender');
                ?>
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input <?php
                                            echo $model->hasError('gender') ? ' is-invalid' : '';
                                            ?>" type="radio" value="female" name="gender" id="female">
            <label class="form-check-label" for="female">
                Female
            </label>
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('gender');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email address</label>
            <div class="col-sm-8">
                <input type="email" name="email" class="form-control <?php
                                                                        echo $model->hasError('email') ? ' is-invalid' : '';
                                                                        ?>" id="email" aria-describedby="emailHelp">
            </div>
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('email');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-4 col-form-label">Phone number</label>
            <div class="col-sm-8">
                <input name="phone" type="text" class="form-control <?php
                                                                    echo $model->hasError('phone') ? ' is-invalid' : '';
                                                                    ?>" id="phone" aria-describedby="emailHelp">
            </div>
            <div class="invalid-feedback">
                <?php
                echo $model->getFirstError('phone');
                ?>
            </div>
        </div>
        <button class="btn btn-primary create-btn">Create</button>
    </form>
</div>