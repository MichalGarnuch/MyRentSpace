<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $building_id = $_POST['building_id'];
    $apartment_number = $_POST['apartment_number'];
    $floor_number = $_POST['floor_number'];
    $size_sqm = $_POST['size_sqm'];
    $status = $_POST['status'];

    // Walidacja danych
    if (empty($building_id) || empty($apartment_number) || empty($floor_number) || empty($size_sqm) || empty($status)) {
        header('Location: ../index.php?view=add_apartment&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO apartments (building_id, apartment_number, floor_number, size_sqm, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $building_id, $apartment_number, $floor_number, $size_sqm, $status);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=apartments&success=apartment_added');
    } else {
        header('Location: ../index.php?view=add_apartment&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_apartment');
}
?>
