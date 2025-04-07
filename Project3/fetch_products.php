<?php
include 'db.php';

$soort_id = isset($_GET['soort_id']) ? intval($_GET['soort_id']) : 0;

if ($soort_id > 0) {
    $sql = $conn->prepare("SELECT id, naam FROM producten WHERE soort_id = ?");
    $sql->bind_param("i", $soort_id);
    $sql->execute();
    $result = $sql->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}
?>
