<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $commission_rate = $_POST['commission_rate'];

    // Walidacja danych
    if (empty($first_name) || empty($last_name) || empty($phone) || empty($email) || empty($commission_rate)) {
        header('Location: ../index.php?view=add_owner&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO owners (first_name, last_name, phone, email, commission_rate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $first_name, $last_name, $phone, $email, $commission_rate);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=owners&success=owner_added');
    } else {
        header('Location: ../index.php?view=add_owner&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_owner');
}
?>
