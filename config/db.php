<?php
  // Create connection
  $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

  // Check connection
  if ($connection->connect_error) {
    die("Connection failed: ".$connection->connect_error);
  }
