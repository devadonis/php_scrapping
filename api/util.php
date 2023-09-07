<?php
  function parseUrl($url) {
    $res = explode("/", $url);
    $domain = $res[0]."//".$res[2];
    $url = explode($domain, $url)[1];

    return array("domain"=>$domain, "url"=>$url);
  }
