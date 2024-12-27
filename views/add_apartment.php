<div class="container mt-4">
    <h1 class="mb-4">Dodaj Mieszkanie</h1>
    <form method="POST" action="controllers/save_apartment.php">
        <div class="mb-3">
            <label for="building_id" class="form-label">ID Budynku:</label>
            <input type="number" class="form-control" id="building_id" name="building_id" placeholder="Podaj ID budynku" required>
        </div>
        <div class="mb-3">
            <label for="apartment_number" class="form-label">Numer Mieszkania:</label>
            <input type="text" class="form-control" id="apartment_number" name="apartment_number" placeholder="Podaj numer mieszkania" required>
        </div>
        <div class="mb-3">
            <label for="floor_number" class="form-label">Numer Piętra:</label>
            <input type="number" class="form-control" id="floor_number" name="floor_number" placeholder="Podaj numer piętra" required>
        </div>
        <div class="mb-3">
            <label for="size_sqm" class="form-label">Powierzchnia (m²):</label>
            <input type="number" class="form-control" id="size_sqm" name="size_sqm" placeholder="Podaj powierzchnię w m²" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status" required>
                <option value="available">Dostępne</option>
                <option value="rented">Wynajęte</option>
                <option value="maintenance">W trakcie naprawy</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Mieszkanie</button>
    </form>
</div>
