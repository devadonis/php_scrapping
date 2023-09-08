<?php
include_once "util.php";

/** Get scraped data */
function scrapeData()
{
  // Parsing url seperately and if it is not valide return error message
  $url = parseUrl($_POST["url"]);

  if ($url["msg"] !== "success") {
    return $url;
  }

  // Check Request URL
  $recent_result = getRecentResult($url["domain"], $url["path"], $_POST["element"]);
  $scrapeData = null;
  if ($recent_result)
    $scrapeData = $recent_result;
  else // Scrape data
    $scrapeData = getData($url, $_POST["element"]);

  if ($scrapeData["msg"] === "success") {
    $result = saveData($url, $_POST["element"], $scrapeData);
  } else {
    $result["msg"] = $scrapeData["msg"];
  }

  return $result;
}

/** Check Resquest URl so that the request is valid */
function getRecentResult($domain, $url, $element)
{
  //check if url exists
  $query = "SELECT url.id as url_id FROM url LEFT JOIN domain ON url.domain_id=domain.id 
    WHERE url.path=? AND domain.name=?";
  $row = Database::$connection->execute_query($query, [$url, $domain])->fetch_assoc();

  if ($row) //if url exists, search for recent requests
  {
    $url_id = $row['url_id'];
    $query = "SELECT * FROM requests LEFT JOIN element ON requests.element_id=element.id WHERE url_id=? AND element.name=? AND requests.time >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)ORDER BY requests.time DESC LIMIT 1 ";
    $row = Database::$connection->execute_query($query, [$url_id, $element])->fetch_assoc();
    if ($row) {
      $result = array("time" => $row['time'], "duration" => $row['duration'], "count" => $row['count'], "msg" => "success");
      return $result;
    }
  }
  return null;
}

// Get url content 
function getUrlContent($url)
{
  $parts = parse_url($url);
  $host = $parts['host'];
  $ch = curl_init();
  $header = array(
    'GET /1575051 HTTP/1.1',
    "Host: {$host}",
    'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Language:en-US,en;q=0.8',
    'Cache-Control:max-age=0',
    'Connection:keep-alive',
    'Host:adfoc.us',
    'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
  );

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
  curl_setopt($ch, CURLOPT_COOKIESESSION, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

/** Scrape data */
function getData($url, $element)
{
  $timestamp = microtime(true);
  $html = getUrlContent("https://" . $url["domain"] . "/" . $url["path"]); // Scrape url
  // var_dump("https://" . $url["domain"] . "/" . $url["path"]);
  if ($html === FALSE) {
    $result["msg"] = "Invalid URL.";
    return $result;
  }

  $time = date('Y-m-d H:i:s');
  $timestamp = intval((microtime(true) - $timestamp) * 1000);

  $doc = new DOMDocument;
  libxml_use_internal_errors(true);
  $doc->loadHTML($html);
  libxml_clear_errors();

  $xpath = new DOMXPath($doc);

  $count = $xpath->query("//" . $element)->length;

  // If there is no element, return error message, else return data
  if (!$count) {
    $result["msg"] = "No such element that you find.";
  } else {
    $result = array("time" => $time, "duration" => $timestamp, "count" => $count, "msg" => "success");
  }

  return $result;
}

/** Save Response data */
function saveData($url, $element, $scrapeData)
{
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
    $data = "URL " . $url["domain"] . "/" . $url["path"] . " Fetched on " . $scrapeData["time"] . ", took " . $scrapeData["duration"] . " msec. Element <" . $element . "> appeared " . $scrapeData["count"] . " times in page.";
    $result = array("msg" => "success", "data" => $data);
  } else {
    $result = array("msg" => "Something went wrong when saving response data.");
  }

  return $result;
}