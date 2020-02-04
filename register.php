<?php 
  require_once "./init.php";
  
  $DB->connect();
  
  if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id_level = $_POST['id_level'];
    
    $registered_user = $User->register($name, $email, $id_level, $password);
    
    // var_dump($registered_user);
    
    header("Location: login.php");
  }
  
  $DB->disconnect();

?>

<?php require_once('./templates/header.php') ?>

  <div style="width: 400px" class='ml-10'>
    <h1 class='text-4xl mb-5'>Register to Dashboard</h1>
    <form action="register.php" method="POST">
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Nama</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name="name" placeholder="Enter your name">
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Email</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name="email" placeholder="Enter your email">
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Level</label>
        <select name="id_level" class='rounded border border-gray-400 py-1 px-2 text-gray-600'>
          <option value="2">Kasir</option>
          <option value="3">Customer</option>
        </select>
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Password</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="password" name="password" placeholder="Enter your password">
      </div>
      <button class='py-2 px-3 bg-blue-500 text-white rounded block' type="submit" name="register">Register</button>
    </form>
  </div>
  
<?php require_once('./templates/footer.php') ?>