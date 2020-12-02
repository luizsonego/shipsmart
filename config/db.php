<?php

require_once './vendor/autoload.php';

class Db
{
  private static $dbName = 'shipsmart';
  private static $dbHost = 'localhost';
  private static $dbUser = 'root';
  private static $dbPassword = '';

  private static $conn = null;

  public function __construct()
  {
    die('Error');
  }

  public function connectMongo()
  {
    $client = new MongoDB\Client();
  }


  public function connect()
  {
    if (null == self::$conn) {
      try {
        self::$conn =  new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPassword);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $exception) {
        die($exception->getMessage());
      }
    }
    return self::$conn;
  }

  public static function disconnect()
  {
    self::$conn = null;
  }


  public function createDb()
  {
    try {
      self::$conn =  new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPassword);
      self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $table = "CREATE DATABASE IF NOT EXISTS shipsmart";
      self::$conn->exec($table);
      $sql = "CREATE TABLE IF NOT EXISTS products (
          id int(11) AUTO_INCREMENT PRIMARY KEY,
          sku varchar(255) UNIQUE NOT NULL,
          description varchar(255) NOT NULL,
          name varchar(255) NOT NULL,
          price varchar(255) NOT NULL,
          currency varchar(3) NOT NULL,
          weight varchar(255) NOT NULL
          )";
      self::$conn->exec($sql);
      echo "DB criado com sucesso";
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}
