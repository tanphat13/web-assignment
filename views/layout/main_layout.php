<?php
use app\core\Application;

// echo var_dump(Application::$app->user);
// echo var_dump($model);
?>
<!doctype html>
<html lang="en">

<!-- <?php
    // $title_error_404 = 'No site existed';
    // if (isset($_GET['id'])) {
    //     $id_post = trim(htmlspecialchars($_GET['id']));
     

    //     $sql_check_post = "SELECT product_id FROM products WHERE  product_id = '$id_post'";
    //     if ($db->num_rows($sql_check_post)) {
    //         $data_post = $db->fetch_assoc($sql_check_post, 1);
     
    //         $title = $data_post['title'];

    //     } else {
    //         $title = $title_error_404;
    //     }
  
    // }
    // else if (isset($_GET['sc'])) {
    //    $slug_cate = trim(htmlspecialchars($_GET['sc']));
     
  
    //     $sql_check_cate = "SELECT url, label FROM categories WHERE url = '$slug_cate'";
    //     if ($db->num_rows($sql_check_cate)) {
    //         $data_cate = $db->fetch_assoc($sql_check_cate, 1);
     
    //         $title = $data_cate['label'];

    //     }
    //      else {
    //         $title = $title_error_404;
    //     }
    // } 
    // else {
    //     $title = $data_web['title'];
        
    // }
?> -->



<head>
    <!-- Required meta tags -->
    <!-- <title>Mobile shop - Điện thoại, Smartphone chính hãng, giá tốt nhất tại Thành phố Hồ Chí Minh</title> -->
    
    <meta name="keywords" content="Smartphone, điện thoại di động, dtdd">
    <meta name="description" content="Hệ thống bán lẻ điện thoại di động, smartphone chính hãng mới nhất tại khu vực thành phố Hồ Chí Minh">
    <meta property="og:title" content="Smartphone.com - Điện thoại, Smartphone chính hãng, giá tốt nhất tại Thành phố Hồ Chí Minh">
    <meta property="og:description" content="Hệ thống bán lẻ điện thoại di động, smartphone chính hãng mới nhất tại khu vực thành phố Hồ Chí Minh">
    <meta content="INDEX,FOLLOW" name="robots">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta property="og:site_name" content="Smartphone.com">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
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
                    <li>
                        <a class="nav-link" href="/my-cart">
                            My Cart
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="/my-order">
                            My Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            Welcome, <?php
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

                                    if (isset($model)) {
                                        if ($model->getFirstError('email') || $model->getFirstError('password')) {
                                            echo "active";
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        echo "";
                                    }
                                    ?>' id="loginForm">
            <form action="" method="post">
                <div class="login-title">Login</div>
                <h1 class="show-error">
                    <?php
                    if (isset($model)) {
                        if ($model->hasError('password')) {
                            echo $model->getFirstError('password') ?? '';
                        } else if ($model->hasError('email')) {
                            echo $model->getFirstError('email') ?? '';
                        }
                    }
                    ?>
                </h1>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email address:</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control
        " id="email" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Password:</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control
       " id="password" aria-describedby="emailHelp">
                    </div>


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
            <li>Location</li>
            <li>288 Đường 3 tháng 2</li>
            <li>4B Cộng Hòa</li>
            <li>5 Nguyễn Kiệm, Gò Vấp</li>
            </ul>

        </div>
        <!-- ------------------------------------------- -->
        <div class="col1">
            <ul class="Contact_number">
                <li>Hotlines</li>
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