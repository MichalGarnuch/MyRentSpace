<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Walidacja danych
    if (empty($first_name) || empty($last_name) || empty($phone) || empty($email)) {
        header('Location: ../index.php?view=add_tenant&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO tenants (first_name, last_name, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $phone, $email);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=tenants&success=tenant_added');
    } else {
        header('Location: ../index.php?view=add_tenant&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_tenant');
}
?>
