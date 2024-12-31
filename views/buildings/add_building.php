<div class="container mt-4">
    <h1 class="mb-4">Dodaj Budynek</h1>
    <form method="POST" action="index.php?action=save_building">
        <div class="mb-3">
            <label for="location_id" class="form-label">Miejscowość:</label>
            <select class="form-control" id="location_id" name="location_id" onchange="toggleNewLocationFields()">
                <option value="">Wybierz miejscowość</option>
                <?php foreach ($locations as $location): ?>
                    <option value="<?= htmlspecialchars($location['id']) ?>">
                        <?= htmlspecialchars($location['city'] . ' (' . $location['postal_code'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz z listy lub wpisz nową miejscowość poniżej.</small>
        </div>

        <div class="mb-3">
            <label for="new_city" class="form-label">Nowa miejscowość:</label>
            <input type="text" class="form-control" id="new_city" name="new_city" placeholder="Wpisz nazwę miejscowości">
        </div>
        <div class="mb-3">
            <label for="new_postal_code" class="form-label">Kod pocztowy:</label>
            <input type="text" class="form-control" id="new_postal_code" name="new_postal_code" placeholder="Wpisz kod pocztowy (opcjonalnie)">
        </div>
        <div class="mb-3">
            <label for="street" class="form-label">Ulica:</label>
            <input type="text" class="form-control" id="street" name="street" placeholder="Podaj ulicę" required>
        </div>
        <div class="mb-3">
            <label for="building_number" class="form-label">Numer Budynku:</label>
            <input type="text" class="form-control" id="building_number" name="building_number" placeholder="Podaj numer budynku" required>
        </div>
        <div class="mb-3">
            <label for="total_floors" class="form-label">Liczba Pięter:</label>
            <input type="number" class="form-control" id="total_floors" name="total_floors" placeholder="Podaj liczbę pięter" required>
        </div>
        <div class="mb-3">
            <label for="common_cost" class="form-label">Koszty Wspólne:</label>
            <input type="number" step="0.01" class="form-control" id="common_cost" name="common_cost" placeholder="Podaj koszty wspólne" required>
        </div>
        <button type="submit" class="btn btn-success">Dodaj</button>
    </form>
</div>

<script>
    function toggleNewLocationFields() {
        const locationSelect = document.getElementById('location_id');
        const newCityField = document.getElementById('new_city');
        const newPostalCodeField = document.getElementById('new_postal_code');

        // Jeśli wybrano miejscowość, wyłącz pola do wpisania nowej
        if (locationSelect.value) {
            newCityField.disabled = true;
            newPostalCodeField.disabled = true;
            newCityField.value = ''; // Czyści pole
            newPostalCodeField.value = ''; // Czyści pole
        } else {
            newCityField.disabled = false;
            newPostalCodeField.disabled = false;
        }
    }

    // Uruchom funkcję podczas ładowania strony, aby poprawnie ustawić stan pól
    document.addEventListener('DOMContentLoaded', toggleNewLocationFields);
</script>
