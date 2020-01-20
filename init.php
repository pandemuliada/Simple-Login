<?php 
  session_start();

  // Required all the class
  require_once "./config/Database.php";
  require_once "./controller/User.php";

  // ========================================================
  // Instantiation
  // Create new object from Database class
  // It will immediately connected to the database, see the construct method on Database class 
  $DB = new Database();
  $User = new User();
  // ========================================================

  // ========================================================
  // Systax below if to check database connected or not
  // Uncoment the code below to see the result
  // if ($db) echo('Connected to database');
  // ========================================================

  $current_user = $User->currentUser();

  