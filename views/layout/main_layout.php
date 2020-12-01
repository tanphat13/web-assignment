<?php

use app\core\Application;

// echo var_dump(Application::$app->user);
// echo var_dump($model);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Mobile shop</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/category">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
           
            <?php if (Application::$app->isGuest()) : ?>
                <ul class='navbar-nav ml-auto'>
                    <li class="nav-item" id="loginBtn">
                        <p class="nav-link">Login</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">register</a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class='navbar-nav ml-auto'>
                    <li>
                        <a class="nav-link" href="/profile">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            Wellcome <?php
                                        echo Application::$app->user->displayName();
                                        ?>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/logout">
                            Logout
                        </a>
                    </li>
                </ul>
            <?php endif ?>
        </div>
    </nav>
    <div class="home-wrapper">
    <div class='login-wrapper <?php 
    
    if(isset($model)){
                                    if ($model->getFirstError('email') || $model->getFirstError('password')) {
                                        echo "active";
                                    } else {
                                        echo '';
                                    }
    }else{
        echo "";
    }
        ?>' id="loginForm">
        <form action="" method="post">
            <h1 class="show-error">
                <?php
                if(isset($model)){
                    if ($model->hasError('password')) {
                        echo $model->getFirstError('password') ?? '';
                    } else if ($model->hasError('email')) {
                        echo $model->getFirstError('email') ?? '';
                    }
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
            <button onclick="test" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div class="container">
        <?php if (Application::$app->session->getFlash("success")) : ?>
            <div class="alert alert-success">
                <?php echo Application::$app->session->getFlash("success") ?>
            </div>
        <?php endif; ?>
        {{content}}
    </div>
    </div>
    <footer class="footer-container">
        <div class="col1"> 
            <ul>
            <li><a href="/warranty">Warranty Policy</a></li>
            <li><a href="/returnpolicy">Return Policy</a></li>
            <li><a href="/installment">Installment Purchase</a></li>
            </ul>
        </div>
        <!-- ------------------------------------------- -->
        <div class="col1"> 
            <ul>
            <li><a href="#">Send Feedback, Complain</a></li>
            <li><a href="#">Recruitment</a></li>
            <li><a href="#">Company Introduction</a></li>
            </ul>

        </div>
        <!-- ------------------------------------------- -->
        <div class="col1"> 
            <ul class="Contact_number">
                <li>Hotlines
                </li>
                <li>Purchase: (0123456789)</li>
                <li>Technical Help: (0123456789)</li>
                <li>Warranty: (0123456789)</li>
                <li>Complain: (0123456789)</li>
            </ul>
        </div>
        <!-- ------------------------------------------- -->
        <div class="col1"> 
            <p>Location</p>
            <div class="location-wrapper">
                <div class="map" id="map">
                </div>
            </div>

        </div>
        
    </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script src="js/key.js"></script>
    <script src="js/store-data.js"></script>
    <script src="js/index.js"></script>
    <script src="js/login-form.js"></script>
    <script script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9PJUeg35P_24EKRatl9OEB4nWj4R2ORs&callback=initMap"></script>
</body>

</html>