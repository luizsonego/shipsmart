<?php

session_start();
include './config/db.php';


$post = filter_input(INPUT_POST, 'send', FILTER_SANITIZE_STRING);

if ($post) {
  $sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
  $currency = filter_input(INPUT_POST, 'currency', FILTER_SANITIZE_STRING);
  $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_STRING);

  $conn = Db::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = $conn->prepare("SELECT sku FROM products where sku = '{$sku}'");
  $query->bindParam(':sku', $sku, PDO::PARAM_INT);
  $query->execute();
  $response = $query->fetchAll();

  if(count($response) > 0) {
    print_r('iiii foi nao');
    return;
  }

  if(count($response) == 0){

    $name = strtolower($name);
    $name = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$name);

    $get_data = "INSERT INTO products (sku, description, name, price, currency, weight) VALUES(?,?,?,?,?,?)";
    $insert_data = $conn->prepare($get_data);
    $insert_data->bindParam(':sku', $sku);
  
    $insert_data->execute(array($sku, $description, $name, $price, $currency, $weight));
    print_r('Sarvo');
  }
  


}
