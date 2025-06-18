<?php
$conn = new mysqli("localhost", "root", "", "sensor_db");
$res = $conn->query("SELECT * FROM data_ultrasonik ORDER BY id DESC LIMIT 10");

echo '<table class="table table-bordered table-striped table-sm">';
echo '<thead class="table-dark"><tr><th>No</th><th>Jarak (cm)</th><th>Waktu</th></tr></thead><tbody>';
$no = 1;
while ($row = $res->fetch_assoc()) {
  echo "<tr><td>{$no}</td><td>{$row['distance']}</td><td>{$row['waktu']}</td></tr>";
  $no++;
}
echo '</tbody></table>';
?>
