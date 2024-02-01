<?php
$db = new PDO('mysql:host=localhost;dbname=car_sales', 'username', 'password');

$stmt = $db->query("SELECT * FROM cars");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cars);
?>