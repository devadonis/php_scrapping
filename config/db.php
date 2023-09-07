<?php
  class Database
  {
    private static $init = FALSE;

    public static $connection;

    public static function initialize()
    {
      if (self::$init === TRUE) return;

      self::$init = TRUE;
      self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

      if (self::$connection->connect_error) {
        die("Connection failed: ".self::$connection->connect_error);
      }
    }

    public static function close()
    {
      if (self::$init === FALSE) return;
      
      self::$init = FALSE;
      self::$connection->close();
    }
  }
