<h1>Create staff form</h1>
<div class="create-staff-wapper">
    <div class="open-create-staff-form">
        Create new staff
    </div>
    <form method='post' class="create-staff-form">
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
        
        <button  class="btn btn-primary">Submit</button>
    </form>
</div>