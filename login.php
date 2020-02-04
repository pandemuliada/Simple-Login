<!-- Logic -->
<?php 
  require_once "./init.php";
  
  $DB->connect();

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

    $DB->disconect();
  }
?>

<!-- View -->
<?php require_once('./templates/header.php') ?>

  <div style="width: 400px" class='ml-10'>
    <h1 class='text-4xl mb-5'>Login to Dashboard</h1>
    <form action="login.php" method="POST">
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Email</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name="email" placeholder="Enter your email">
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Password</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="password" name="password" placeholder="Enter your password">
      </div>
      <button class='py-2 px-3 bg-blue-500 text-white rounded block' type="submit" name="login">Login</button>
    </form>
  </div>
  
<?php require_once('./templates/footer.php') ?>
