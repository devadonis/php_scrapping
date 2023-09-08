<?php
  require_once "../config/db.php";

  Database::initialize();

  // Get domain list from db
  function getDomainList(){
    $query = "SELECT * from domain";
    $result = Database::$connection->execute_query($query, []);
    $rows = [];
    while ($row = $result->fetch_assoc())
    {
      $rows[] = $row;
    }
    return $rows;
  }

  // Get element list from db
  function getElementList(){
    $query = "SELECT * from element";
    $result = Database::$connection->execute_query($query, []);
    $rows = [];
    while ($row = $result->fetch_assoc())
    {
      $rows[] = $row;  
    }
    return $rows;
  }

  // Get url count from domain
  function getUrlCountFromDomain()
  {
    $domainId = $_POST["domainId"];
    $query = "SELECT * from url WHERE domain_id=?";
    $result = Database::$connection->execute_query($query, [$domainId]);
    $rows = [];
    while ($row = $result->fetch_assoc())
    {
      $rows[] = $row;
    }
    return $rows;
  }


 