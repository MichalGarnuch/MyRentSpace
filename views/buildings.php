<?php
include 'config/db.php'; // Dołączenie pliku połączenia z bazą danych

// Zapytanie do bazy danych
$query = "SELECT * FROM buildings";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Lista Budynków</h1>
    <!-- Tabela wyświetlająca dane -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ulica</th>
            <th>Numer budynku</th>
            <th>Liczba pięter</th>
            <th>Koszty wspólne</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Wyświetlanie danych w wierszach tabeli
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['street']}</td>
                            <td>{$row['building_number']}</td>
                            <td>{$row['total_floors']}</td>
                            <td>{$row['common_cost']}</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Sekcja dodawania nowego budynku -->
    <div class="mt-5">
        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addBuildingForm" aria-expanded="false" aria-controls="addBuildingForm">
            Dodaj Nowy Budynek
        </button>
        <div class="collapse mt-3" id="addBuildingForm">
            <form action="controllers/buildingsController.php" method="post">
                <div class="mb-3">
                    <label for="street" class="form-label">Ulica</label>
                    <input type="text" name="street" id="street" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="building_number" class="form-label">Numer budynku</label>
                    <input type="text" name="building_number" id="building_number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="total_floors" class="form-label">Liczba pięter</label>
                    <input type="number" name="total_floors" id="total_floors" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="common_cost" class="form-label">Koszty wspólne</label>
                    <input type="number" step="0.01" name="common_cost" id="common_cost" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Dodaj Budynek</button>
            </form>
        </div>
    </div>
</div>
