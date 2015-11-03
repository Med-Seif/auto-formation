<?php
header('Content-Type: application/json');
require_once __DIR__ . "\..\bootstrap.php";
$productRepository = $entityManager->getRepository('Product');
$products = $productRepository->findAll();
$output = array();
foreach ($products as $p){
    $output [] = [ 'id' => $p->getId(), 'label' => $p->getLabel() ];
}
echo json_encode($output);