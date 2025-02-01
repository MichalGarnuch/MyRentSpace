<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: ../index.php?error=Proszę wypełnić wszystkie pola");
        exit();
    }

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role, related_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password_hash, $role, $related_id);
        $stmt->fetch();

        // Zmiana na SHA2, ponieważ nie było użyte password_hash przy rejestracji
        if (hash('sha256', $password) === $password_hash) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['related_id'] = $related_id;

            header("Location: ../index.php?success=1");
            exit();
        } else {
            header("Location: ../index.php?error=Niepoprawne hasło");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Nie znaleziono użytkownika");
        exit();
    }
}
?>
