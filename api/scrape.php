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
    $query = "SELECT requests.id, domain.name as domain, url.name AS url, element.name AS element, requests.time, requests.duration
      FROM requests
      LEFT JOIN domain ON requests.domain_id = domain.id
      LEFT JOIN url ON requests.url_id = url.id
      LEFT JOIN element ON requests.element_id = element.id
      WHERE domain.name=? AND url.name=? AND element.name=?
      ORDER BY requests.time DESC LIMIT 1";

    $result = Database::$connection->execute_query($query, [$domain, $url, $element])->fetch_assoc();
    
    if ($result) {
      // return old value and upgrade time
        file_put_contents("error.log", print_r($result,true)."\n", FILE_APPEND);
    } else {
      // scrape data
    }
  }

  function scrapeData() {

  }

  function saveData() {

  }