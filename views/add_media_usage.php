<div class="container mt-4">
    <h1 class="mb-4">Dodaj Zużycie Mediów</h1>
    <form method="POST" action="controllers/save_media_usage.php">
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label>
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required>
        </div>
        <div class="mb-3">
            <label for="media_type_id" class="form-label">ID Typu Medium:</label>
            <input type="number" class="form-control" id="media_type_id" name="media_type_id" placeholder="Podaj ID typu medium" required>
        </div>
        <div class="mb-3">
            <label for="reading_date" class="form-label">Data Odczytu:</label>
            <input type="date" class="form-control" id="reading_date" name="reading_date" required>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Zużycie (jednostki):</label>
            <input type="number" step="0.01" class="form-control" id="value" name="value" placeholder="Podaj wartość zużycia" required>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Zużycie Mediów</button>
    </form>
</div>
