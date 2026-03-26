<?php
include 'db.php';

$sql = "SELECT * FROM designs";
$result = $conn->query($sql);

$designs = [];

while ($row = $result->fetch_assoc()) {
    $designs[] = $row;
}

echo json_encode($designs);
?>