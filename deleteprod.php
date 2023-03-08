<?php
// get index
$index = $_GET['index'];

// fetch data from json
$data = file_get_contents('productos.json');
$data = json_decode($data, true);

// remove element with index and reindex
array_splice($data, $index, 1);
$data = array_values($data);

// encode back to json
$data = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('productos.json', $data);

header('location: productos.php');
?>
