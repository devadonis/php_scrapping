<?php
  function parseUrl($url) {
    // Validate url is valid
    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
      $res = explode("/", $url);
      $domain = $res[0]."//".$res[2];
      $path = explode($domain, $url)[1];

      $result = array("domain"=>$domain, "path"=>$path, "msg"=>"success");
    } else {
      $result = array("msg"=>"$url is not valid URL.");
    }

    return $result;
  }
