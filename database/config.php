<?php

  class ConnectionDB {
    private ?PDO $connect;

    protected string $hostName;
    protected string $dataBase;
    protected string $charset;
    protected string $userName;
    protected string $password;

    public function __construct() {
      $this->hostName = $_ENV['DB_HOST'];
      $this->dataBase = $_ENV['DB_NAME'];
      $this->charset = $_ENV['DB_CHARSET'];
      $this->userName = $_ENV['DB_USER'];
      $this->password = $_ENV['DB_PASSWORD'];
      
      $connectionString = 'mysql:host='.$this->hostName.';dbname='.$this->dataBase.';charset='.$this->charset.'';
      
      try {
        $this->connect = new PDO($connectionString, $this->userName, $this->password);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo 'Conexión exitosa';
      } catch (PDOException $error) {
        $this->connect = 'Error de conexión';
        echo 'Error: '.$error->getMessage();
      }
    }

    public function connect(): null | PDO {
      return $this->connect;
    }
  }
?>