<?php include('connection.php') ?>
<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php?msg=no_user_found");
    exit(); // Ensure to stop further execution
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/adminCSS.css">
   <link rel="stylesheet" href="css/adminlte.min.css">
   <title>Admin Page</title>
 
   <?php require_once('include/nava.php'); ?>

<div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $con->query("SELECT * FROM `products`")->num_rows; ?></h3>

                <p>Total Products</p>
              </div>
            </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-3">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $con->query("SELECT * FROM `users`")->num_rows; ?></h3>

                <p>Total Users</p>
              </div>
              
            </div>
          </div>
       </div>

       <div class="row">
          <div class="col-md-3">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $con->query("SELECT * FROM `order`")->num_rows; ?></h3>

                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
            </div>
          </div>
       </div>

       <div class="row">
    <div class="col-md-3">
        <div class="small-box bg-light shadow-sm border">
            <div class="inner">
                <?php
                // Assuming $con is your database connection
                
                // Query to select total sales from orders where payment_status is '1'
                $result = $con->query("SELECT SUM(price_total) AS total_sales FROM `order` WHERE payment = 'cod'");
                
                // Check if the query executed successfully
                if ($result) {
                    // Fetch the total sales value
                    $row = $result->fetch_assoc();
                    $totalPaidSales = $row["total_sales"];
                } else {
                    // If the query fails, set total sales to 0
                    $totalPaidSales = 0;
                }
                ?>
                <h3>₱<?= number_format($totalPaidSales, 2) ?></h3>
                <p>Total Sales: </p>
            </div>
            <div class="icon">
                <i class="fa fa-building"></i>
            </div>
        </div>
    </div>
</div>
</head>
<body>
