<?php
//header('Content-Type: application/json');
require_once __DIR__ . "\..\bootstrap.php";
var_dump($_REQUEST);
if ($_POST) {
    //$data    = json_decode($_POST['params']['vars']);
    //var_dump($data);
    return;
    $product = new Product();
    $product->setLabel();
    $entityManager->persist($product);
    $entityManager->flush();
}
?>