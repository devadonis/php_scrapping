<?php
  require "./config/constant.php";
  require "./config/db.php";

  $request = $_SERVER["REQUEST_URI"];

  switch ($request) {
    case "":
    case "/":
      require VIEWS."scrape.html";
    case "/statistic":
      require VIEWS."statistic.html";
    default:
      http_response_code(404);
  }
?>