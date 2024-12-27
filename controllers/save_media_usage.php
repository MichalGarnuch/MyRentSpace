<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_id = $_POST['apartment_id'];
    $media_type_id = $_POST['media_type_id'];
    $reading_date = $_POST['reading_date'];
    $value = $_POST['value'];

    // Walidacja danych
    if (empty($apartment_id) || empty($media_type_id) || empty($reading_date) || empty($value)) {
        header('Location: ../index.php?view=add_media_usage&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO media_usage (apartment_id, media_type_id, reading_date, value) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $apartment_id, $media_type_id, $reading_date, $value);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=media&success=media_usage_added');
    } else {
        header('Location: ../index.php?view=add_media_usage&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_media_usage');
}
?>
