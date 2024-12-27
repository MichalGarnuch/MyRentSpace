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
</div>
