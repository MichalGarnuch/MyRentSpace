<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_id = $_POST['apartment_id'];
    $description = $_POST['description'];
    $request_date = $_POST['request_date'];
    $status = $_POST['status'];

    // Walidacja danych
    if (empty($apartment_id) || empty($description) || empty($request_date) || empty($status)) {
        header('Location: ../index.php?view=add_maintenance&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO maintenance_requests (apartment_id, description, request_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $apartment_id, $description, $request_date, $status);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=maintenance&success=maintenance_added');
    } else {
        header('Location: ../index.php?view=add_maintenance&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_maintenance');
}
?>
