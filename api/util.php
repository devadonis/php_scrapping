<?php
  function parseUrl($url) {
    // Validate url is valid
    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
      $res = explode("://", $url);
      $res = $res[1];
      $res_list = explode('/', $res);
      $domain = $res_list[0];
      
      if (substr($domain,0,4) === "www.")  // "wwww." is optional
        $domain = substr($domain,4);
      $path = substr($res, strlen($domain)+1);

      $result = array("domain"=>$domain, "path"=>$path, "msg"=>"success");
    } else {
      $result = array("msg"=>"$url is not valid URL.");
    }

    return $result;
  }

  function queryResultToArray($result){
    $rows = [];
    while ($row = $result->fetch_assoc())
      $rows[] = $row;
    return $rows;
  }