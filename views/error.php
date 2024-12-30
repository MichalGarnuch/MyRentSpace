<?php
// Plik `error.php`
// Ten plik powinien obsługiwać wyświetlanie informacji o błędach w aplikacji.
// Na podstawie aktualnego projektu można w nim umieścić:

// 1. Dynamiczny nagłówek błędu z komunikatem
// 2. Opcjonalne szczegóły błędu (np. z $exception->getMessage() lub kodem błędu HTTP)
// 3. Link przekierowujący do strony głównej lub poprzedniej strony
?>

<div class="container"> <!-- Główny kontener dla komunikatu o błędzie -->
    <h1 class="text-danger">Wystąpił błąd</h1> <!-- Nagłówek informujący o błędzie -->
    <p class="lead">Coś poszło nie tak. Prosimy spróbować ponownie później lub skontaktować się z administratorem.</p> <!-- Ogólny komunikat -->
    <a href="index.php" class="btn btn-primary">Powrót do strony głównej</a> <!-- Link do strony głównej -->
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `error.php` powinien obsługiwać wyświetlanie informacji o błędach aplikacji.-->
<!--- Powinien zawierać ogólny komunikat o błędzie oraz opcjonalnie szczegóły techniczne (do celów debugowania).-->
<!--- Dodatkowo, można umieścić link do strony głównej lub opcji powrotu.-->
<!--*/-->
