<?php
// Get domain list from db
function getDomainList()
{
  $query = "SELECT * from domain";
  $result = Database::$connection->query($query);
  return queryResultToArray($result);
}

// Get element list from db
function getElementList()
{
  $query = "SELECT * from element";
  $result = Database::$connection->query($query);
  return queryResultToArray($result);
}

// Get Average Fetch Time from domain
function getAverageFetchTime()
{
  $domainId = $_POST["domainId"];
  $query = "SELECT AVG(duration) AS a FROM requests LEFT JOIN url ON requests.url_id=url.id 
  WHERE url.domain_id=".$domainId." AND requests.time >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
  $result = Database::$connection->query($query);
  $row = $result->fetch_assoc();
  return $row["a"];
}

// Get url count from domain
function getUrlCountFromDomain()
{
  $domainId = $_POST["domainId"];
  $query = "SELECT COUNT(*) AS c FROM url WHERE domain_id='".$domainId."'";
  $result = Database::$connection->query($query);
  $row = $result->fetch_assoc();
  return $row["c"];
}

// Get element count so far
function getElementCount()
{
  $elementId = $_POST["elementId"];
  $query = "SELECT SUM(count) AS c FROM requests WHERE element_id='".$elementId."'";
  $result = Database::$connection->query($query);
  $row = $result->fetch_assoc();
  return $row["c"]?$row["c"]:0;
}
// Get element count from a specific domain
function getElementCountFromDomain()
{
  $elementId = $_POST["elementId"];
  $domainId = $_POST["domainId"];
  $query = "SELECT SUM(count) AS c FROM requests LEFT JOIN url ON requests.url_id=url.id 
  WHERE requests.element_id='".$elementId."' AND url.domain_id='".$domainId."'";
  $result = Database::$connection->query($query);
  $row = $result->fetch_assoc();
  return $row["c"]?$row["c"]:0;
}