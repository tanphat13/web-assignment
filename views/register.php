<form action="" method="post">
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
        <input class="form-check-input <?php
                                        echo $model->hasError('gender') ? ' is-invalid' : '';
                                        ?>" type="radio" name="gender" value="male" id="male" checked>
        <label class="form-check-label" for="male">
            Male
        </label>
        <div class="invalid-feedback">
            <?php
            echo $model->getFirstError('gender');
            ?>
        </div>
    </div>
    <div class="form-group">
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
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control <?php
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
        <input name="phone" type="number" class="form-control <?php
                                                                echo $model->hasError('phone') ? ' is-invalid' : '';
                                                                ?>" id="phone" aria-describedby="emailHelp">
        <div class="invalid-feedback">
            <?php
            echo $model->getFirstError('phone');
            ?>
        </div>
    </div>
    <div class="form-group ">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control <?php
                                                                    echo $model->hasError('password') ? ' is-invalid' : '';
                                                                    ?>" id="password" aria-describedby="emailHelp">
        <div class="invalid-feedback">
            <?php
            echo $model->getFirstError('password');
            ?>
        </div>
    </div>
    <div class="form-group ">
        <label for="comfirmPassword">Comfirm password</label>
        <input type="password" name="comfirmPassword" class="form-control <?php
                                                                            echo $model->hasError('comfirmPassword') ? ' is-invalid' : '';
                                                                            ?> " id="comfirmPassword" aria-describedby="emailHelp">
        <div class="invalid-feedback">
            <?php
            echo $model->getFirstError('comfirmPassword');
            ?>
        </div>
    </div>
    <button onclick="test" ; class="btn btn-primary">Submit</button>
</form>