<?php
require_once 'helpers/functions.php'; // Załadowanie funkcji pomocniczych

// Sprawdzenie, czy użytkownik ma uprawnienia do dodawania danych
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień"); // Przekierowanie w przypadku braku uprawnień
    exit();
}
?>

<div class="container mt-4"> <!-- Główny kontener formularza -->
    <h1 class="mb-4">Dodaj Właściciela</h1> <!-- Nagłówek formularza -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'owner_added'): ?>
        <!-- Komunikat sukcesu po dodaniu właściciela -->
        <div class="alert alert-success">
            Nowy właściciel został dodany pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Komunikat błędu w przypadku problemów -->
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
