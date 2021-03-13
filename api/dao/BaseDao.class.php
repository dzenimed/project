<?php
require_once dirname(__FILE__)."/../config.php";

class BaseDao {
  private $connection;

  public function __construct__(){
    try {
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);

      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully.";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function insert(){

  }

  public function update(){

  }

  public function query(){
    //SELECT * FROM Account WHERE account_id = 7;
  }

  public function query_unique(){

  }


}

?>