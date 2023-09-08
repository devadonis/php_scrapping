<?php
  include_once "util.php";

  /** Get scraped data */
  function scrapeData() {
    $data = $_POST;

    // Parsing url seperately and if it is not valide return error message
    $url = parseUrl($data["url"]);

    if ($url["msg"] !== "success") {
      return $url;
    }

    // // Check Request URL
    // // checkRequest($res["domain"], $res["url"], $data["element"]);

    // Scrape data
    $scrapeData = getData($url, $data["element"]);

    if ($scrapeData["msg"] === "success") {
      $result = saveData($url, $data["element"], $scrapeData);
    } else {
      $result["msg"] = $scrapeData["msg"];
    }

    return $result;
  }

  /** Check Resquest URl so that the request is valid */
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
    } else {
      // scrape data
    }
  }

  /** Scrape data */
  function getData($url, $element) {
    $timestamp = microtime(true);
    $html = @file_get_contents($url["domain"].$url["path"]); // Scrape url

    if ($html === FALSE) {
      $result["msg"] = "No such URL is known.";
      return $result;
    }

    $time = date('Y-m-d H:i:s');
    $timestamp = intval((microtime(true) - $timestamp) * 1000);

    $doc = new DOMDocument;
    libxml_use_internal_errors(true);
    $doc->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($doc);

    $count = $xpath->query("//".$element)->length;

    // If there is no element, return error message, else return data
    if (!$count) {
      $result["msg"] = "No such element that you find.";
    } else {
      $result = array("time"=>$time, "duration"=>$timestamp, "count"=>$count, "msg"=>"success");
    }

    return $result;
  }

  /** Save Response data */
  function saveData($url, $element, $scrapeData) {
    // If there is no saved element, save it and return id
    $query = "SELECT id FROM element WHERE name=? LIMIT 1";
    $result = Database::$connection->execute_query($query, [$element]);

    if ($result->num_rows === 0) {
      $query = "INSERT INTO element (name) VALUES (?)";
      $result = Database::$connection->execute_query($query, [$element]);
      $elementId = Database::$connection->insert_id;
    } else {
      $elementId = $result->fetch_assoc()["id"];
    }

    // If there is no saved domain, save it and return id
    $query = "SELECT id FROM domain WHERE name=? LIMIT 1";
    $result = Database::$connection->execute_query($query, [$url["domain"]]);

    if ($result->num_rows === 0) {
      $query = "INSERT INTO domain (name) VALUES (?)";
      $result = Database::$connection->execute_query($query, [$url["domain"]]);
      $domainId = Database::$connection->insert_id;
    } else {
      $domainId = $result->fetch_assoc()["id"];
    }

    // If there is no saved url, save it and return id
    $query = "SELECT id FROM url WHERE path=? AND domain_id=? LIMIT 1";
    $result = Database::$connection->execute_query($query, [$url["path"], $domainId]);

    if ($result->num_rows === 0) {
      $query = "INSERT INTO url (path, domain_id) VALUES (?, ?)";
      $result = Database::$connection->execute_query($query, [$url["path"], $domainId]);
      $urlId = Database::$connection->insert_id;
    } else {
      $urlId = $result->fetch_assoc()["id"];
    }

    // Save response data and if there is any error return error message
    $query = "INSERT INTO requests (url_id, element_id, time, duration, count) VALUES (?, ?, ?, ?, ?)";
    $result = Database::$connection->execute_query($query, [$urlId, $elementId, $scrapeData["time"], $scrapeData["duration"], $scrapeData["count"]]);
    $requestId = Database::$connection->insert_id;

    if ($requestId) {
      $data = "URL ".$url["domain"]."/".$url["path"]." Fetched on ".$scrapeData["time"].", took ".$scrapeData["duration"]." msec. Element <".$element."> appeared ".$scrapeData["count"]." times in page.";
      $result = array("msg"=>"success", "data"=>$data);
    } else {
      $result = array("msg"=>"Something went wrong when saving response data.");
    }

    return $result;
  }