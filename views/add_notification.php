<div class="container mt-4">
    <h1 class="mb-4">Dodaj Powiadomienie</h1>
    <form method="POST" action="controllers/save_notification.php">
        <div class="mb-3">
            <label for="user_id" class="form-label">ID Użytkownika:</label>
            <input type="number" class="form-control" id="user_id" name="user_id" placeholder="Podaj ID użytkownika" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Treść Powiadomienia:</label>
            <textarea class="form-control" id="message" name="message" placeholder="Podaj treść powiadomienia" required></textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Typ Powiadomienia:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="reminder">Przypomnienie</option>
                <option value="info">Informacja</option>
                <option value="alert">Alert</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Powiadomienie</button>
    </form>
</div>
