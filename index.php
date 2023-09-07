<?php
  require_once "./config/constant.php";
  require_once "./config/db.php";
  require_once "./api/scrape.php";

  Database::initialize();

  $request = $_SERVER["REQUEST_URI"];

  switch ($request) {
    case "/":
      require VIEW."/scrape.php";
      break;
    case "/statistic/":
      require VIEW."/statistic.php";
      break;
    case "/api/getdata":
      getData();
      break;
    default:
      http_response_code(404);
      require VIEW."/404.php";
  }

  Database::close();
?>