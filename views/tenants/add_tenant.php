<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie może dodawać danych → przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Dodaj Najemcę</h1>

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'tenant_added'): ?>
        <!-- Jeśli najemca został dodany pomyślnie, pokaż komunikat sukcesu -->
        <div class="alert alert-success">
            Nowy najemca został dodany pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Jeśli wystąpił błąd, pokaż komunikat błędu -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania najemcy -->
    <form method="POST" action="index.php?action=save_tenant">
        <!-- Pole do wpisania imienia najemcy -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Imię:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Podaj imię" required>
        </div>

        <!-- Pole do wpisania nazwiska najemcy -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Nazwisko:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Podaj nazwisko" required>
        </div>

        <!-- Pole do wpisania numeru telefonu najemcy -->
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required>
        </div>

        <!-- Pole do wpisania adresu email najemcy -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj adres email" required>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <?php if (canAddData()): ?>
        <button type="submit" class="btn btn-success">Dodaj</button
        <?php endif; ?>
    </form>
</div>

<!--
Komentarze kluczowe:
- Plik generuje formularz do dodawania nowych najemców.
- Formularz przesyła dane do akcji "save_tenant" w kontrolerze.
- Dane do wprowadzenia obejmują: imię, nazwisko, numer telefonu oraz adres email.
- W przypadku sukcesu lub błędu wyświetlane są odpowiednie komunikaty.
- Pola są oznaczone jako "required", aby wymusić ich uzupełnienie przed przesłaniem formularza.
-->
