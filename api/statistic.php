<?php
  require_once "../config/db.php";

  Database::initialize();

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

 