<?php 
  require_once './init.php';

  // If there's no loggin user, redirect to login page
  if (!$current_user) header("Location: login.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Homepage</title>
</head>
<body>
  
  <h1>Hello, <?= $current_user->name  ?></h1>
  <p>Your're level is <b><?= $current_user->level_name ?></b></p>


  <ul>
    <!-- If id_level is 1 (admin) -->
    <?php if ($current_user->id_level == 1) : ?>
      <li><a href="admin/dashboard">Dashboard</a></li>
      <li><a href="admin/users">User List</a></li>
      <li><a href="admin/products.php">Products</a></li>
    <?php endif ?>

    <!-- If id_level is 2 (cashier) -->
    <?php if ($current_user->id_level == 2) : ?>
      <li><a href="admin/orders">Order List</a></li>
    <?php endif ?>
    
    <!-- If id_level is 3 (customer) -->
    <?php if ($current_user->id_level == 3) : ?>
      <li><a href="admin/orders">Order List</a></li>
    <?php endif ?>
  </ul>


  <a href="./logout.php">Logout</a>

</body>
</html>