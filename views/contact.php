<h1><?php echo $name ?></h1>
<?php

$PageTitle="Contact". ' | ' . "smartphone.com";

include_once('layout/header.php');
?>
<form action="" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name">
    </div>
    <div class="form-group ">
        <label class="form-check-label" for="body">textarea</label>
        <input type="textarea" class="form-text" id="body">

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>