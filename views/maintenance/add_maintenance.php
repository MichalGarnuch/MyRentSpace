<div class="container mt-4"> <!-- Główny kontener formularza dodawania zgłoszenia serwisowego -->
    <h1 class="mb-4">Dodaj Zgłoszenie Serwisowe</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'maintenance_added'): ?>
        <div class="alert alert-success">
            Zgłoszenie serwisowe zostało dodane pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania zgłoszenia serwisowego -->
    <form method="POST" action="index.php?action=save_maintenance">
        <!-- Pole wyboru mieszkania -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">Mieszkanie:</label>
            <select class="form-control" id="apartment_id" name="apartment_id" required>
                <option value="">Wybierz mieszkanie</option>
                <!-- Iteracja przez tablicę $apartments, aby wyświetlić dostępne mieszkania -->
                <?php foreach ($apartments as $apartment): ?>
                    <option value="<?= htmlspecialchars($apartment['id']) ?>">
                        <?= htmlspecialchars('Mieszkanie ' . $apartment['apartment_number'] . ', Piętro ' . $apartment['floor_number'] . ', Budynek ' . $apartment['street'] . ' ' . $apartment['building_number'] . ', ' . $apartment['city']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz mieszkanie z listy.</small>
        </div>

        <!-- Pole do wpisania opisu zgłoszenia -->
        <div class="mb-3">
            <label for="description" class="form-label">Opis:</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Opisz problem" required></textarea>
        </div>

        <!-- Pole do wpisania daty zgłoszenia -->
        <div class="mb-3">
            <label for="request_date" class="form-label">Data Zgłoszenia:</label>
            <input type="date" class="form-control" id="request_date" name="request_date" required>
        </div>

        <!-- Pole wyboru statusu zgłoszenia -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="open">Otwarte</option>
                <option value="in_progress">W trakcie realizacji</option>
                <option value="closed">Zamknięte</option>
            </select>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj Zgłoszenie</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const apartmentSelect = document.getElementById('apartment_id');
        const requestDateField = document.getElementById('request_date');

        // Ustaw domyślną datę zgłoszenia na dzisiejszy dzień
        const today = new Date().toISOString().split('T')[0];
        requestDateField.value = today;
    });
</script>
