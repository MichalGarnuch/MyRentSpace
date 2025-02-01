<?php
// Ustawienie kodu błędu HTTP na 500 (błąd serwera)
http_response_code(500);

// Pobranie komunikatu błędu z URL lub ustawienie domyślnego komunikatu
$error_message = htmlspecialchars($_GET['message'] ?? 'Nieznany błąd');
?>

<div class="container mt-5"> <!-- Kontener na komunikat o błędzie -->
    <div class="alert alert-danger text-center" role="alert"> <!-- Bootstrapowy alert do wyświetlania błędów -->
        <h1 class="display-4">Ups! Wystąpił błąd</h1> <!-- Nagłówek z komunikatem -->
        <p class="lead"><?= $error_message ?></p> <!-- Wyświetlenie przekazanego komunikatu błędu -->
        <hr>
        <p class="small">Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.</p> <!-- Dodatkowa informacja dla użytkownika -->
        <a href="index.php" class="btn btn-primary">Powrót do strony głównej</a> <!-- Link do strony głównej -->
    </div>
</div>
