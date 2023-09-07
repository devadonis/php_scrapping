<?php
require_once "../config/constant.php";
// file_put_contents("debug.log",print_r($_POST,true)."/n",FILE_APPEND);
// var_dump($_POST);
/*
Return data format:
  data: response data 
  status: 1 => error, 0 => success (like unix status)
*/
if (isset($_POST['api'])) {
  $api = $_POST["api"];
  $data = array(); // Response data
  
  switch ($api) {
    case SCRAPE_URL: // Scrape url api
      break;
  }
  echo json_encode(array("status" => 0, "data" => $data));
} else { // Invalid api request
  echo json_encode(array("status" => 1, "data" => "Something wrong!"));
}
?>