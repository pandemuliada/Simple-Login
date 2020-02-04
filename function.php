<?php 

  function url($url_params) {
    return $_SERVER['HTTP_HOST'] . '/' . $url_params;
  }