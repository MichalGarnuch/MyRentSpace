<?php
require_once '../config/db.php'; // Dołączenie pliku z konfiguracją bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
    $type = $_POST['type'];

    // Walidacja danych
    if (empty($user_id) || empty($message) || empty($type)) {
        header('Location: ../index.php?view=add_notification&error=empty_fields');
        exit();
    }

    // Przygotowanie zapytania SQL
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, type) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $message, $type);

    if ($stmt->execute()) {
        header('Location: ../index.php?view=notifications&success=notification_added');
    } else {
        header('Location: ../index.php?view=add_notification&error=database_error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../index.php?view=add_notification');
}
?>
