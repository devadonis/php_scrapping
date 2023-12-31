<?php
  define("SERVER_URL", $_SERVER["HTTP_HOST"]);
  define("BASE_DIR", $_SERVER["DOCUMENT_ROOT"]);
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
  define("DB_PASSWORD", "");
  define("DB_DATABASE", "test");
  define("VIEW", BASE_DIR."/view");
  define("ASSETS", "/assets");

  # Api names
  define("SCRAPE_URL", "SCRAPE_URL");
  define("GET_DOMAIN_LIST", "GET_DOMAIN_LIST");
  define("GET_ELEMENT_LIST", "GET_ELEMENT_LIST");
  define("GET_AVERAGE_FETCH_TIME", "GET_AVERAGE_FETCH_TIME");
  define("GET_URL_COUNT_FROM_DOMAIN", "GET_URL_COUNT_FROM_DOMAIN");
  define("GET_ELEMENT_COUNT", "GET_ELEMENT_COUNT");
  define("GET_ELEMENT_COUNT_FROM_DOMAIN", "GET_ELEMENT_COUNT_FROM_DOMAIN");