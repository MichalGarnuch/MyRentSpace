<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie może dodawać danych → przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Dodaj Budynek</h1>

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'building_added'): ?>
        <!-- Jeśli budynek został dodany pomyślnie, pokaż komunikat sukcesu -->
        <div class="alert alert-success">
            Nowy budynek został dodany pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Jeśli wystąpił błąd, pokaż komunikat błędu -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania budynku -->
    <form method="POST" action="index.php?action=save_building">
        <!-- Pole wyboru istniejącej miejscowości -->
        <div class="mb-3">
            <label for="location_id" class="form-label">Miejscowość:</label>
            <select class="form-control" id="location_id" name="location_id" onchange="toggleNewLocationFields()">
                <option value="">Wybierz miejscowość</option>
                <!-- Iteracja przez tablicę $locations, aby wyświetlić dostępne miejscowości -->
                <?php foreach ($locations as $location): ?>
                    <option value="<?= htmlspecialchars($location['id']) ?>">
                        <?= htmlspecialchars($location['city'] . ' (' . $location['postal_code'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz z listy lub wpisz nową miejscowość poniżej.</small>
        </div>

        <!-- Pole do wpisania nowej miejscowości -->
        <div class="mb-3">
            <label for="new_city" class="form-label">Nowa miejscowość:</label>
            <input type="text" class="form-control" id="new_city" name="new_city" placeholder="Wpisz nazwę miejscowości">
        </div>

        <!-- Pole do wpisania nowego kodu pocztowego -->
        <div class="mb-3">
            <label for="new_postal_code" class="form-label">Kod pocztowy:</label>
            <input type="text" class="form-control" id="new_postal_code" name="new_postal_code" placeholder="Wpisz kod pocztowy (opcjonalnie)">
        </div>

        <!-- Pole do wpisania ulicy budynku -->
        <div class="mb-3">
            <label for="street" class="form-label">Ulica:</label>
            <input type="text" class="form-control" id="street" name="street" placeholder="Podaj ulicę" required>
        </div>

        <!-- Pole do wpisania numeru budynku -->
        <div class="mb-3">
            <label for="building_number" class="form-label">Numer Budynku:</label>
            <input type="text" class="form-control" id="building_number" name="building_number" placeholder="Podaj numer budynku" required>
        </div>

        <!-- Pole do wpisania liczby pięter budynku -->
        <div class="mb-3">
            <label for="total_floors" class="form-label">Liczba Pięter:</label>
            <input type="number" class="form-control" id="total_floors" name="total_floors" placeholder="Podaj liczbę pięter" required>
        </div>

        <!-- Pole do wpisania kosztów wspólnych budynku -->
        <div class="mb-3">
            <label for="common_cost" class="form-label">Koszty Wspólne:</label>
            <input type="number" step="0.01" class="form-control" id="common_cost" name="common_cost" placeholder="Podaj koszty wspólne" required>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj</button>
    </form>
</div>

<script>
    // Funkcja toggleNewLocationFields: Włącza/wyłącza pola "Nowa miejscowość" i "Kod pocztowy"
    // w zależności od tego, czy użytkownik wybrał istniejącą miejscowość z listy.
    function toggleNewLocationFields() {
        const locationSelect = document.getElementById('location_id'); // Pole wyboru miejscowości
        const newCityField = document.getElementById('new_city'); // Pole "Nowa miejscowość"
        const newPostalCodeField = document.getElementById('new_postal_code'); // Pole "Kod pocztowy"

        // Jeśli wybrano istniejącą miejscowość, wyłącz pola do wpisania nowej miejscowości i kodu pocztowego
        if (locationSelect.value) {
            newCityField.disabled = true;
            newPostalCodeField.disabled = true;
            newCityField.value = ''; // Wyczyść pole "Nowa miejscowość"
            newPostalCodeField.value = ''; // Wyczyść pole "Kod pocztowy"
        } else {
            // Jeśli nie wybrano miejscowości, włącz pola do wpisania nowej miejscowości i kodu pocztowego
            newCityField.disabled = false;
            newPostalCodeField.disabled = false;
        }
    }

    // Uruchom funkcję podczas ładowania strony, aby ustawić stan pól zgodnie z wybranym elementem
    document.addEventListener('DOMContentLoaded', toggleNewLocationFields);
</script>
