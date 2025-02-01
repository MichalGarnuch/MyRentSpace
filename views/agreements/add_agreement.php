<?php
require_once 'helpers/functions.php';

// Jeśli użytkownik nie może dodawać danych → przekieruj go na stronę główną
if (!canAddData()) {
    header("Location: index.php?error=Brak uprawnień");
    exit();
}
?>
<div class="container mt-4">
    <h1 class="mb-4">Dodaj Umowę Najmu</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'agreement_added'): ?>
        <!-- Jeśli umowa została dodana pomyślnie, pokaż komunikat sukcesu -->
        <div class="alert alert-success">
            Nowa umowa najmu została dodana pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Jeśli wystąpił błąd, pokaż komunikat błędu -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania umowy najmu -->
    <form method="POST" action="index.php?action=save_agreement">
        <!-- Pole wyboru mieszkania -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">Mieszkanie:</label>
            <select class="form-control" id="apartment_id" name="apartment_id" required>
                <option value="">Wybierz mieszkanie</option>
                <!-- Iteracja przez tablicę $apartments, aby wyświetlić dostępne mieszkania -->
                <?php foreach ($apartments as $apartment): ?>
                    <option value="<?= htmlspecialchars($apartment['id']) ?>">
                        <?= htmlspecialchars("Numer: " . $apartment['apartment_number']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Pole wyboru najemcy -->
        <div class="mb-3">
            <label for="tenant_id" class="form-label">Najemca:</label>
            <select class="form-control" id="tenant_id" name="tenant_id" required>
                <option value="">Wybierz najemcę</option>
                <!-- Iteracja przez tablicę $tenants, aby wyświetlić dostępnych najemców -->
                <?php foreach ($tenants as $tenant): ?>
                    <option value="<?= htmlspecialchars($tenant['id']) ?>">
                        <?= htmlspecialchars($tenant['full_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Pole wyboru właściciela -->
        <div class="mb-3">
            <label for="owner_id" class="form-label">Właściciel:</label>
            <select class="form-control" id="owner_id" name="owner_id" required>
                <option value="">Wybierz właściciela</option>
                <?php foreach ($owners as $owner): ?>
                    <option value="<?= htmlspecialchars($owner['id']) ?>">
                        <?= htmlspecialchars($owner['first_name'] . ' ' . $owner['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Pole do wpisania daty rozpoczęcia umowy -->
        <div class="mb-3">
            <label for="start_date" class="form-label">Data Rozpoczęcia:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <!-- Pole do wpisania daty zakończenia umowy -->
        <div class="mb-3">
            <label for="end_date" class="form-label">Data Zakończenia:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <!-- Pole do wpisania kwoty najmu -->
        <div class="mb-3">
            <label for="rent_amount" class="form-label">Kwota Najmu (PLN):</label>
            <input type="number" step="0.01" class="form-control" id="rent_amount" name="rent_amount" placeholder="Podaj kwotę najmu" required>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj Umowę</button>
    </form>
</div>
