<?php 
  use Model\ActiveRecord;
  use Dotenv\Dotenv;

  require '../database/config.php';
  require 'helpers.php';
  require __DIR__ . '/../vendor/autoload.php';

  $dotenv = Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();

  $connection = new ConnectionDB();
  $connection->connect();

  ActiveRecord::setDataBase( $connection );
?>