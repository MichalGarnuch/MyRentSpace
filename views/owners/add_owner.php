<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie może dodawać danych → przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Dodaj Właściciela</h1>

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'owner_added'): ?>
        <!-- Jeśli właściciel został dodany pomyślnie, pokaż komunikat sukcesu -->
        <div class="alert alert-success">
            Nowy właściciel został dodany pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Jeśli wystąpił błąd, pokaż komunikat błędu -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania właściciela -->
    <form method="POST" action="index.php?action=save_owner">
        <!-- Pole do wpisania imienia właściciela -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Imię:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Podaj imię" required>
        </div>

        <!-- Pole do wpisania nazwiska właściciela -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Nazwisko:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Podaj nazwisko" required>
        </div>

        <!-- Pole do wpisania numeru telefonu właściciela -->
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required>
        </div>

        <!-- Pole do wpisania adresu email właściciela -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj adres email" required>
        </div>

        <!-- Pole do wpisania procentu prowizji właściciela -->
        <div class="mb-3">
            <label for="commission_rate" class="form-label">Procent Prowizji:</label>
            <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" placeholder="Podaj procent prowizji" required>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj</button>
    </form>
</div>

<!--
Komentarze kluczowe:
- Plik generuje formularz do dodawania nowych właścicieli.
- Formularz przesyła dane do akcji "save_owner" w kontrolerze.
- Dane do wprowadzenia obejmują: imię, nazwisko, numer telefonu, adres email oraz procent prowizji.
- W przypadku sukcesu lub błędu wyświetlane są odpowiednie komunikaty.
- Pola są oznaczone jako "required", aby wymusić ich uzupełnienie przed przesłaniem formularza.
-->
