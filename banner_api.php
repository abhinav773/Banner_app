<?php
include 'config.php';
header('Content-Type: application/json');
$result = $conn->query("SELECT * FROM banners ORDER BY id DESC LIMIT 1");
$banner = $result->fetch_assoc();

echo json_encode($banner);
?>
