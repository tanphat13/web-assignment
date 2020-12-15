<?php

$PageTitle="My order". ' | ' . "smartphone.com";

include_once('layout/header.php');
?>

<div class="container">
    <div class="container order">
        <div class="h4">Order In Process</div>
        <div class="container order-container">
            <div class="row heading">
                <div class="col">Order Id</div>
                <div class="col">Deliver Date</div>
                <div class="col">Order Status</div>
                <div class="col">Order Method</div>
                <div class="col">Order Date</div>
                <div class="col">Order Note</div>
                <div class="col">Total</div>
            </div>
            <?php
                $order_list = "";
                foreach ($orders["undone_order"] as $order_item) {
                    $order_list .= "<div class='row'>";
                    foreach ($order_item as $item) {
                        if (array_search($item, $order_item) === "order_id") {
                            $order_list .= "<div class='col'><a href='/order?id=$item'>$item</a></div>";
                            continue;
                        }
                        if ($item === NULL or $item === '') $item = "N/A";
                        if (array_search($item, $order_item) === "total_price") {
                            $order_list .= "<div class='col'>" . number_format(intval($item), 0, '', '.') . " VND</div>";
                            continue;
                        }
                        $order_list .= "<div class='col'>$item</div>";
                    }
                    $order_list .= "</div>";
                }
                echo $order_list;
            ?>
        </div>
    </div>
    
    <div class="container order">
        <div class="h4">Old Order</div>
        <div class="container order-container">
            <div class="row heading">
                <div class="col">Order Id</div>
                <div class="col">Deliver Date</div>
                <div class="col">Order Status</div>
                <div class="col">Order Method</div>
                <div class="col">Order Date</div>
                <div class="col">Order Note</div>
                <div class="col">Total</div>
            </div>
            <?php
                $order_list = "";
                foreach ($orders["done_order"] as $order_item) {
                    $order_list .= "<div class='row'>";
                    foreach ($order_item as $item) {
                        if (array_search($item, $order_item) === "order_id") {
                            $order_list .= "<div class='col'><a href='/order?id=$item'>$item</a></div>";
                            continue;
                        }
                        if ($item === NULL or $item === '') $item = "N/A";
                        if (array_search($item, $order_item) === "total_price") {
                            $order_list .= "<div class='col'>" . number_format(intval($item), 0, '', '.') . " VND</div>";
                            continue;
                        }
                        $order_list .= "<div class='col'>$item</div>";
                    }
                    $order_list .= "</div>";
                }
                echo $order_list;
            ?>
        </div>
    </div>
</div>