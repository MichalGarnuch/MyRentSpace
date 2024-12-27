<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_id = $_POST['apartment_id'];
    $tenant_id = $_POST['tenant_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $amount = $_POST['amount'];

    // Walidacja danych
    if (empty($apartment_id) || empty($tenant_id) || empty($start_date) || empty($end_date) || empty($amount)) {
        header('Location: ../index.php?view=add_agreement&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO rental_agreements (apartment_id, tenant_id, start_date, end_date, amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissd", $apartment_id, $tenant_id, $start_date, $end_date, $amount);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=agreements&success=agreement_added');
    } else {
        header('Location: ../index.php?view=add_agreement&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_agreement');
}
?>
