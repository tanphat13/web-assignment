<?php

use app\core\Application;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/index.css">
    <title>Mobile shop</title>
</head>

<body>
    <div class="admin-layout">
        <nav class="slide-bar">
            <div class="slide-bar-header">
                <div class="slide-bar-brand">
                    <a href="/admin">Admin Page</a>
                </div>
                <div class="slide-bar-admin-info">

                    <?php if (!Application::$app->isGuest()) : ?>
                        <p class="slide-bar-admin-welcome">
                            Wellcome
                        </p>
                        <p class="slide-baar-admin-name">
                            <?php
                            echo Application::$app->user->displayName();
                            ?>
                        </p>
                    <?php endif ?>

                </div>
            </div>

            <div class='side-bar-function-list'>
                <div class='function-item'>
                    <a href="/admin">
                        Manage staff
                    </a>
                </div>
                <div class='function-item'>
                    <a href="/admin/products">
                        Manage product
                    </a>
                </div>
            </div>
            <div class="slide-bar-action">
                <?php if (Application::$app->isGuest()) : ?>

                    <a class="slide-bar-login" href="/admin/login">
                        Login
                    </a>

                <?php else : ?>
                    <a class="slide-bar-logout" href="/logout">
                        Logout
                    </a>
                <?php endif ?>

            </div>
        </nav>
        <div class="container">
            <?php if (Application::$app->session->getFlash("success")) : ?>
                <div class="alert alert-success">
                    <?php echo Application::$app->session->getFlash("success") ?>
                </div>
            <?php endif; ?>
            {{content}}
        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="/js/key.js"></script>
    <script src="/js/store-data.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/login-form.js"></script>

    <?php

    ?>
    <script script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9PJUeg35P_24EKRatl9OEB4nWj4R2ORs&callback=initMap"></script>
</body>

</html>