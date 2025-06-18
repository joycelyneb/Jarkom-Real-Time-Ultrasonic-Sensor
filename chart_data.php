<?php
$conn = new mysqli("localhost", "root", "", "sensor_db");
$res = $conn->query("SELECT distance, waktu FROM data_ultrasonik ORDER BY id DESC LIMIT 10");

$data = [];
while ($row = $res->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode(array_reverse($data)); // Urutkan naik berdasarkan waktu
?>
