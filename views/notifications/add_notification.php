<div class="container mt-4"> <!-- Główny kontener formularza dodawania powiadomienia -->
    <h1 class="mb-4">Dodaj Powiadomienie</h1> <!-- Nagłówek strony -->

    <!-- Sekcja komunikatów: Wyświetla komunikaty o sukcesie lub błędzie -->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'notification_added'): ?>
        <div class="alert alert-success">Powiadomienie zostało dodane pomyślnie!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <!-- Formularz dodawania powiadomienia -->
    <form method="POST" action="index.php?action=save_notification">
        <!-- Pole wyboru użytkownika -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Użytkownik:</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Wybierz użytkownika</option>
                <!-- Iteracja przez tablicę $users, aby wyświetlić dostępnych użytkowników -->
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['id']) ?>">
                        <?= htmlspecialchars($user['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted">Wybierz użytkownika z listy.</small>
        </div>

        <!-- Pole do wpisania treści powiadomienia -->
        <div class="mb-3">
            <label for="message" class="form-label">Treść Powiadomienia:</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Wpisz treść powiadomienia" required></textarea>
        </div>

        <!-- Pole wyboru typu powiadomienia -->
        <div class="mb-3">
            <label for="type" class="form-label">Typ Powiadomienia:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="reminder">Przypomnienie</option>
                <option value="info">Informacja</option>
                <option value="alert">Alert</option>
            </select>
        </div>

        <!-- Przycisk do przesłania formularza -->
        <button type="submit" class="btn btn-success">Dodaj Powiadomienie</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Możesz dodać dodatkowe skrypty, jeśli potrzebujesz
    });
</script>
