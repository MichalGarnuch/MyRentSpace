<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie może dodawać danych → przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4"> <!-- Główny kontener formularza dodawania mieszkania -->
    <h1 class="mb-4">Dodaj Mieszkanie</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'apartment_added'): ?>
        <div class="alert alert-success">Nowe mieszkanie zostało dodane pomyślnie!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <!-- Formularz dodawania mieszkania -->
    <form method="POST" action="index.php?action=save_apartment">
        <!-- Wybór lub dodanie lokalizacji -->
        <div class="mb-3">
            <label for="location_id" class="form-label">Miejscowość:</label>
            <select class="form-control" id="location_id" name="location_id" onchange="filterBuildings()">
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
        <div class="mb-3">
            <label for="new_city" class="form-label">Nowa miejscowość:</label>
            <input type="text" class="form-control" id="new_city" name="new_city" placeholder="Wpisz nazwę miejscowości">
        </div>
        <div class="mb-3">
            <label for="new_postal_code" class="form-label">Kod pocztowy:</label>
            <input type="text" class="form-control" id="new_postal_code" name="new_postal_code" placeholder="Wpisz kod pocztowy">
        </div>

        <!-- Wybór lub dodanie budynku -->
        <div class="mb-3">
            <label for="building_id" class="form-label">Budynek:</label>
            <select class="form-control" id="building_id" name="building_id" onchange="lockBuildingFields()">
                <option value="">Wybierz budynek</option>
                <?php foreach ($buildings as $building): ?>
                    <option value="<?= htmlspecialchars($building['id']) ?>" data-location-id="<?= htmlspecialchars($building['location_id']) ?>">
                    <?= htmlspecialchars($building['full_address']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz z listy lub wpisz nowy budynek poniżej.</small>
        </div>
        <div class="mb-3">
            <label for="new_street" class="form-label">Ulica:</label>
            <input type="text" class="form-control" id="new_street" name="new_street" placeholder="Wpisz nazwę ulicy">
        </div>
        <div class="mb-3">
            <label for="new_building_number" class="form-label">Numer Budynku:</label>
            <input type="text" class="form-control" id="new_building_number" name="new_building_number" placeholder="Wpisz numer budynku">
        </div>

        <!-- Pole do wpisania numeru mieszkania -->
        <div class="mb-3">
            <label for="apartment_number" class="form-label">Numer Mieszkania:</label>
            <input type="text" class="form-control" id="apartment_number" name="apartment_number" placeholder="Podaj numer mieszkania" required>
        </div>

        <!-- Pole do wpisania numeru piętra -->
        <div class="mb-3">
            <label for="floor_number" class="form-label">Numer Piętra:</label>
            <input type="number" class="form-control" id="floor_number" name="floor_number" placeholder="Podaj numer piętra" required>
        </div>

        <!-- Pole do wpisania powierzchni mieszkania -->
        <div class="mb-3">
            <label for="size_sqm" class="form-label">Powierzchnia (m²):</label>
            <input type="number" class="form-control" id="size_sqm" name="size_sqm" placeholder="Podaj powierzchnię w m²" required>
        </div>

        <!-- Pole do wyboru statusu mieszkania -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status" required>
                <option value="available">Dostępne</option>
                <option value="rented">Wynajęte</option>
                <option value="maintenance">W trakcie naprawy</option>
            </select>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj Mieszkanie</button>
    </form>
</div>
<script>
    function filterBuildings() {
        const locationId = document.getElementById('location_id').value;
        const buildingSelect = document.getElementById('building_id');
        const buildingOptions = buildingSelect.querySelectorAll('option');

        // Jeśli nie wybrano miejscowości, pokaż wszystkie budynki
        if (!locationId) {
            buildingOptions.forEach(option => {
                option.style.display = ''; // Pokaż wszystkie budynki
            });
            lockLocationFields(); // Sprawdź blokadę dla lokalizacji
            return;
        }

        // Filtruj budynki na podstawie `data-location-id`
        buildingOptions.forEach(option => {
            const optionLocationId = option.dataset.locationId;
            if (optionLocationId && optionLocationId !== locationId) {
                option.style.display = 'none'; // Ukryj budynki z inną lokalizacją
            } else {
                option.style.display = ''; // Pokaż budynki z wybraną lokalizacją
            }
        });

        buildingSelect.value = ''; // Reset wyboru budynku
        lockLocationFields(); // Sprawdź blokadę dla lokalizacji
    }

    function lockLocationFields() {
        const locationSelect = document.getElementById('location_id');
        const newCityField = document.getElementById('new_city');
        const newPostalCodeField = document.getElementById('new_postal_code');

        if (locationSelect.value) {
            // Zablokuj pola nowej lokalizacji, jeśli wybrano istniejącą lokalizację
            newCityField.disabled = true;
            newPostalCodeField.disabled = true;
            newCityField.value = ''; // Wyczyść pole "Nowa miejscowość"
            newPostalCodeField.value = ''; // Wyczyść pole "Kod pocztowy"
        } else {
            // Odblokuj pola nowej lokalizacji, jeśli nie wybrano istniejącej lokalizacji
            newCityField.disabled = false;
            newPostalCodeField.disabled = false;
        }
    }

    function lockBuildingFields() {
        const buildingSelect = document.getElementById('building_id');
        const selectedBuilding = buildingSelect.options[buildingSelect.selectedIndex];
        const newStreetField = document.getElementById('new_street');
        const newBuildingNumberField = document.getElementById('new_building_number');

        if (selectedBuilding && selectedBuilding.value) {
            // Zablokuj pola nowego budynku, jeśli wybrano istniejący budynek
            newStreetField.disabled = true;
            newBuildingNumberField.disabled = true;
            newStreetField.value = ''; // Wyczyść pole "Ulica"
            newBuildingNumberField.value = ''; // Wyczyść pole "Numer budynku"
        } else {
            // Odblokuj pola nowego budynku, jeśli nie wybrano istniejącego budynku
            newStreetField.disabled = false;
            newBuildingNumberField.disabled = false;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        filterBuildings(); // Filtruj budynki przy ładowaniu strony
        lockBuildingFields(); // Sprawdź blokadę pól budynku przy ładowaniu strony
        lockLocationFields(); // Sprawdź blokadę pól lokalizacji przy ładowaniu strony
    });
</script>
<script>
    // Funkcja toggleNewLocationFields: Włącza/wyłącza pola "Nowa miejscowość" i "Kod pocztowy"
    // w zależności od tego, czy użytkownik wybrał istniejącą miejscowość z listy.
    function toggleNewLocationFields() {
        const locationSelect = document.getElementById('location_id');
        const newCityField = document.getElementById('new_city');
        const newPostalCodeField = document.getElementById('new_postal_code');

        // Jeśli wybrano istniejącą miejscowość, wyłącz pola do wpisania nowej miejscowości i kodu pocztowego
        if (locationSelect.value) {
            newCityField.disabled = true;
            newPostalCodeField.disabled = true;
            newCityField.value = '';
            newPostalCodeField.value = '';
        } else {
            // Jeśli nie wybrano miejscowości, włącz pola do wpisania nowej miejscowości i kodu pocztowego
            newCityField.disabled = false;
            newPostalCodeField.disabled = false;
        }
    }
    function toggleNewBuildingFields() {
        const buildingSelect = document.getElementById('building_id');
        const newStreetField = document.getElementById('new_street');
        const newBuildingNumberField = document.getElementById('new_building_number');

        if (buildingSelect.value) {
            newStreetField.disabled = true;
            newBuildingNumberField.disabled = true;
            newStreetField.value = '';
            newBuildingNumberField.value = '';
        } else {
            newStreetField.disabled = false;
            newBuildingNumberField.disabled = false;
        }
    }

    // Uruchom funkcję podczas ładowania strony, aby ustawić stan pól zgodnie z wybranym elementem
    document.addEventListener('DOMContentLoaded', () => {
        toggleNewLocationFields();
        toggleNewBuildingFields();
    });
</script>
