<?php
require_once 'helpers/functions.php'; // Załadowanie funkcji pomocniczych

// Sprawdzenie, czy użytkownik ma uprawnienia do dodawania danych
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień"); // Przekierowanie w przypadku braku uprawnień
    exit();
}
?>

<div class="container mt-4">
    <h1 class="mb-4">Dodaj Najemcę</h1>

    <!-- Sekcja komunikatów o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'tenant_added'): ?>
        <!-- Sukces - Nowy najemca został dodany -->
        <div class="alert alert-success">
            Nowy najemca został dodany pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Błąd - Wyświetlanie komunikatu o błędzie -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania najemcy -->
    <form method="POST" action="index.php?action=save_tenant">
        <!-- Pole na imię najemcy -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Imię:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Podaj imię" required>
        </div>

        <!-- Pole na nazwisko najemcy -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Nazwisko:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Podaj nazwisko" required>
        </div>

        <!-- Pole na numer telefonu najemcy -->
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required>
        </div>

        <!-- Pole na adres email najemcy -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj adres email" required>
        </div>

        <!-- Przycisk do przesyłania formularza, dostępny tylko jeśli użytkownik ma uprawnienia -->
        <?php if (canAddData()): ?>
            <button type="submit" class="btn btn-success">Dodaj</button>
        <?php endif; ?>
    </form>
</div>
