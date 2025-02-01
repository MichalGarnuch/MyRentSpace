<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie ma uprawnień do dodawania danych, przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Dodaj Zużycie Mediów</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'media_usage_added'): ?>
        <div class="alert alert-success">Nowy odczyt zużycia mediów został dodany pomyślnie!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <!-- Formularz dodawania zużycia mediów -->
    <form method="POST" action="index.php?action=save_media_usage">
        <!-- Pole wyboru mieszkania -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">Mieszkanie:</label>
            <select class="form-control" id="apartment_id" name="apartment_id" onchange="loadRentalAgreements()" required>
                <option value="">Wybierz mieszkanie</option>
                <?php foreach ($apartments as $apartment): ?>
                    <option value="<?= htmlspecialchars($apartment['id']) ?>">
                        <?= htmlspecialchars('Mieszkanie #' . $apartment['apartment_number'] . ' - ' . ($apartment['full_address'] ?? 'Brak adresu')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz mieszkanie z listy.</small>
        </div>

        <!-- Pole wyboru umowy najmu -->
        <div class="mb-3">
            <label for="rental_agreement_id" class="form-label">Umowa Najmu:</label>
            <select class="form-control" id="rental_agreement_id" name="rental_agreement_id" required disabled>
                <option value="">Wybierz mieszkanie, aby załadować umowy</option>
            </select>
        </div>

        <!-- Pole wyboru medium -->
        <div class="mb-3">
            <label for="media_type_id" class="form-label">Medium:</label>
            <select class="form-control" id="media_type_id" name="media_type_id" required>
                <option value="">Wybierz medium</option>
                <?php foreach ($mediaTypes as $mediaType): ?>
                    <option value="<?= htmlspecialchars($mediaType['id']) ?>">
                        <?= htmlspecialchars($mediaType['name'] . ' (' . $mediaType['unit'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Data odczytu -->
        <div class="mb-3">
            <label for="reading_date" class="form-label">Data odczytu:</label>
            <input type="date" class="form-control" id="reading_date" name="reading_date" required>
        </div>

        <!-- Wartość zużycia -->
        <div class="mb-3">
            <label for="value" class="form-label">Wartość zużycia:</label>
            <input type="number" step="0.01" class="form-control" id="value" name="value" required>
        </div>

        <!-- Status archiwizacji -->
        <div class="mb-3">
            <label for="archived" class="form-label">Zarchiwizowane:</label>
            <select class="form-control" id="archived" name="archived">
                <option value="0">Nie</option>
                <option value="1">Tak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Dodaj Zużycie</button>
    </form>
</div>

<script>
    // Funkcja ładowania umów najmu na podstawie wybranego mieszkania
    function loadRentalAgreements() {
        const apartmentId = document.getElementById('apartment_id').value;
        const rentalAgreementSelect = document.getElementById('rental_agreement_id');
        rentalAgreementSelect.disabled = true;

        if (!apartmentId) {
            rentalAgreementSelect.innerHTML = '<option value="">Wybierz mieszkanie, aby załadować umowy</option>';
            return;
        }

        fetch(`index.php?view=media&action=get_rental_agreements&apartment_id=${apartmentId}`)
            .then(response => response.json())
            .then(data => {
                rentalAgreementSelect.innerHTML = '<option value="">Wybierz umowę</option>';
                data.forEach(agreement => {
                    const option = document.createElement('option');
                    option.value = agreement.id;
                    option.textContent = agreement.agreement_details;
                    rentalAgreementSelect.appendChild(option);
                });
                rentalAgreementSelect.disabled = false;
            })
            .catch(error => {
                console.error('Błąd ładowania umów:', error);
                rentalAgreementSelect.innerHTML = '<option value="">Błąd ładowania</option>';
            });
    }
</script>
