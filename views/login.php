<div class ='admin-login-screen'>
    <h3 class="admin-login-form-title">
        Login as admin/staff
    </h3>
    <form class="admin-login-form" action="" method="post">
        <h1 class="show-error">
            <?php
            if ($model->hasError('password')) {
                echo $model->getFirstError('password') ?? '';
            } else if ($model->hasError('email')) {
                echo $model->getFirstError('email') ?? '';
            }
            ?>
        </h1>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="email" class="form-control
        " id="email" aria-describedby="emailHelp">

        </div>
        <div class="form-group ">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control
       " id="password" aria-describedby="emailHelp">

        </div>
        <button onclick="test" class="btn btn-primary login-btn">Log In</button>
    </form>
</div>