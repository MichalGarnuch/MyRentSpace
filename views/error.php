<?php
// Ustaw kod błędu HTTP (np. 500 dla błędów serwera)
http_response_code(500);

// Pobierz komunikat błędu, jeśli został przekazany
$error_message = htmlspecialchars($_GET['message'] ?? 'Nieznany błąd');
?>

<div class="container mt-5"> <!-- Główny kontener dla komunikatu o błędzie -->
    <div class="alert alert-danger text-center" role="alert"> <!-- Użycie Bootstrapowego alertu -->
        <h1 class="display-4">Ups! Wystąpił błąd</h1>
        <p class="lead"><?= $error_message ?></p> <!-- Wyświetlenie dynamicznego komunikatu błędu -->
        <hr>
        <p class="small">Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.</p>
        <a href="index.php" class="btn btn-primary">Powrót do strony głównej</a> <!-- Link do strony głównej -->
    </div>
</div>
