<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rental_agreement_id = $_POST['rental_agreement_id'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    // Walidacja danych
    if (empty($rental_agreement_id) || empty($payment_date) || empty($amount) || empty($type) || empty($status)) {
        header('Location: ../index.php?view=add_payment&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO payments (rental_agreement_id, payment_date, amount, type, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdss", $rental_agreement_id, $payment_date, $amount, $type, $status);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=payments&success=payment_added');
    } else {
        header('Location: ../index.php?view=add_payment&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_payment');
}
?>
