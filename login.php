<?php 
  require_once "./init.php";
  
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    $logged_user = $User->login($email, $password);

    // var_dump($logged_user);

    // If email & password match with one record at database
    // Set session & redirect to home.php
    if ($logged_user) {
      $_SESSION['is_login'] = true;
      $_SESSION['user'] = $logged_user;
      header("Location: home.php");
    } else {
      $_SESSION['is_login'] = false;
      $_SESSION['user'] = null;
    }
  }


  $DB->disconect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Simple Login</title>
</head>
<body>

  <h1>Login Kuy</h1>
  <form action="login.php" method="POST">
    <input type="text" name="email" placeholder="Enter your email">
    <br>
    <br>
    <input type="password" name="password" placeholder="Enter your password">
    <br>
    <br>
    <button type="submit" name="login">Login Cuy</button>
  </form>
  
</body>
</html>