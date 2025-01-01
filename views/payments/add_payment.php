<div class="container mt-4"> <!-- Główny kontener strony -->
    <h1 class="mb-4">Dodaj Płatność</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'payment_added'): ?>
        <!-- Jeśli płatność została dodana pomyślnie, pokaż komunikat sukcesu -->
        <div class="alert alert-success">
            Nowa płatność została dodana pomyślnie!
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <!-- Jeśli wystąpił błąd, pokaż komunikat błędu -->
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <!-- Formularz dodawania płatności -->
    <form method="POST" action="index.php?action=save_payment">
        <!-- Pole wyboru istniejącej umowy najmu -->
        <div class="mb-3">
            <label for="agreement_id" class="form-label">Umowa najmu:</label>
            <select class="form-control" id="agreement_id" name="rental_agreement_id" required>
                <option value="">Wybierz umowę najmu</option>
                <!-- Iteracja przez tablicę $agreements, aby wyświetlić dostępne umowy -->
                <?php foreach ($agreements as $agreement): ?>
                    <option value="<?= htmlspecialchars($agreement['id']) ?>">
                        <?= htmlspecialchars($agreement['agreement_description']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz istniejącą umowę z listy.</small>
        </div>

        <!-- Pole do wyboru daty płatności -->
        <div class="mb-3">
            <label for="payment_date" class="form-label">Data płatności:</label>
            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
        </div>

        <!-- Pole do wpisania kwoty płatności -->
        <div class="mb-3">
            <label for="amount" class="form-label">Kwota płatności:</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Podaj kwotę płatności" required>
        </div>

        <!-- Pole do wyboru typu płatności -->
        <div class="mb-3">
            <label for="type" class="form-label">Typ płatności:</label>
            <select class="form-control" id="type" name="type" required>
                <option value="rent">Czynsz</option>
                <option value="owner_rent">Czynsz właścicielski</option>
                <option value="media">Media</option>
                <option value="commission">Prowizja</option>
            </select>
        </div>

        <!-- Pole do wyboru statusu płatności -->
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="paid">Zapłacone</option>
                <option value="pending">Oczekujące</option>
                <option value="overdue">Zaległe</option>
            </select>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj Płatność</button>
    </form>
</div>
