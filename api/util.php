<?php
  function parseUrl($url) {
    $res = explode("/", $url);
    $domain = $res[0]."//".$res[2];
    $path = explode($domain, $url)[1];

    return array("domain"=>$domain, "path"=>$path);
  }

  function queryResultToArray($result){
    $rows = [];
    while ($row = $result->fetch_assoc())
      $rows[] = $row;
    return $rows;
  }