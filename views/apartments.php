<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie z JOIN do tabeli buildings
$query = "
    SELECT a.id, a.apartment_number, a.floor_number, a.size_sqm, a.status, b.street, b.building_number
    FROM apartments a
    JOIN buildings b ON a.building_id = b.id
";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Lista Mieszkań</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Numer mieszkania</th>
            <th>Piętro</th>
            <th>Powierzchnia (m²)</th>
            <th>Status</th>
            <th>Budynek</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['apartment_number']}</td>
                            <td>{$row['floor_number']}</td>
                            <td>{$row['size_sqm']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['street']} {$row['building_number']}</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
