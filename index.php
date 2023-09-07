<?php
  require "./config/constant.php";
  require "./config/db.php";

  $request = $_SERVER["REQUEST_URI"];

  switch ($request) {
    case "":
    case "/test/":
      require VIEW."/scrape.php";
      break;
    case "/test/statistic/":
      require VIEW."/statistic.php";
      break;
    default:
      http_response_code(404);
      require VIEW."/404.php";
  }
?>