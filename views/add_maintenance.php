<div class="container mt-4">
    <h1 class="mb-4">Dodaj Zgłoszenie Serwisowe</h1>
    <form method="POST" action="controllers/save_maintenance.php">
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label>
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis:</label>
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Opisz problem" required></textarea>
        </div>
        <div class="mb-3">
            <label for="request_date" class="form-label">Data Zgłoszenia:</label>
            <input type="date" class="form-control" id="request_date" name="request_date" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status" required>
                <option value="open">Otwarte</option>
                <option value="in_progress">W trakcie realizacji</option>
                <option value="closed">Zamknięte</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Zgłoszenie</button>
    </form>
</div>
