<?php
  // Conver query result to Array
  function queryResultToArray($result)
  {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }
?>