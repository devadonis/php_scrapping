<?php
  function getData() {
    $data = $_REQUEST;

    // Parsing url seperately
    $res = parseUrl($data["url"]);

    // Check Request URL
    checkRequest($res["domain"], $res["url"], $data["element"]);
  }

  function parseUrl($url) {
    $res = explode("/", $url);
    $domain = $res[0]."//".$res[2];
    $url = explode($domain, $url)[1] == "" ? "/" : explode($domain, $url)[1];

    return array("domain"=>$domain, "url"=>$url);
  }

  function checkRequest($domain, $url, $element) {
    file_put_contents("error.log", print_r($element,true)."\n", FILE_APPEND);
    
    $sql = "SELECT domain.name, url.name, element.name, requests.time, requests.duration FROM (((requests LEFT JOIN domain ON requests.domain_id = domain.id ) LEFT JOIN url ON requests.url_id = url.id) LEFT JOIN element ON requests.element_id = element.id) ORDER BY requests.time DESC LIMIT 1";
    // file_put_contents("error.log", print_r($connection,true)."\n", FILE_APPEND);

    $result = Database::$connection->query($sql);
    
    if ($result->num_rows > 0) {
      file_put_contents("error.log", print_r($result,true)."\n", FILE_APPEND);
      // return old value and upgrade time
    } else {
      // scrape data
    }
  }

  function scrapeData() {

  }

  function saveData() {

  }