<?php 
  require_once './init.php';

  if (!$current_user) header("Location: login.php");
  if ($current_user) header("Location: home.php");