<?php 
  require_once "./init.php";
  
  if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    $registered_user = $User->register($name, $email, $password);

    // var_dump($registered_user);

    header("Location: login.php");
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

  <h1>Register Kuy</h1>
  <form action="register.php" method="POST">
    <input type="text" name="name" placeholder="Enter your name">
    <br>
    <br>
    <input type="text" name="email" placeholder="Enter your email">
    <br>
    <br>
    <input type="password" name="password" placeholder="Enter your password">
    <br>
    <br>
    <button type="submit" name="register">Register Cuy</button>
  </form>
  
</body>
</html>