<div class="container mt-4">
    <h1 class="mb-4">Dodaj Budynek</h1>
    <form method="POST" action="../controllers/save_building.php"> <!-- Formularz przesyła dane do skryptu zapisu -->
        <div class="mb-3">
            <label for="street" class="form-label">Ulica:</label>
            <input type="text" class="form-control" id="street" name="street" placeholder="Podaj ulicę" required>
        </div>
        <div class="mb-3">
            <label for="building_number" class="form-label">Numer Budynku:</label>
            <input type="text" class="form-control" id="building_number" name="building_number" placeholder="Podaj numer budynku" required>
        </div>
        <div class="mb-3">
            <label for="total_floors" class="form-label">Liczba Pięter:</label>
            <input type="number" class="form-control" id="total_floors" name="total_floors" placeholder="Podaj liczbę pięter" required>
        </div>
        <button type="submit" class="btn btn-success">Dodaj</button>
    </form>
</div>
