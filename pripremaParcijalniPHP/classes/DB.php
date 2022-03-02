<?php

namespace DB;

use PDOException;
use PDO;

// Singleton to connect db.
class DB
{
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  private $host;
  private $user;
  private $pass;
  private $name;
  private $baza;

  // The db connection is established in the private constructor.
  private function __construct($Connection)
  {
    $this->host = $Connection['host'];
    $this->user = $Connection['user'];
    $this->pass = $Connection['pass'];
    $this->name = $Connection['dbname'];
    $this->baza = $Connection['baza'];

    $this->conn = new PDO(
      "{$this->baza}:host={$this->host};
      dbname={$this->name}",
      $this->user,
      $this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
    );
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance($polje)
  {
    if (!self::$instance) {
      self::$instance = new DB($polje);
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function login($login)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO users (nickname) VALUES (:nickname)");
      $stmt->bindParam(':nickname', $login);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function chatchat()
  {
    try {
      $stmt = $this->conn->prepare("SELECT idnick, poruka FROM razgovor");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt-> fetchAll();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
  }


  public function send($send)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO razgovor (poruka) VALUES (:poruka)");
      $stmt->bindParam(':poruka', $send);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
