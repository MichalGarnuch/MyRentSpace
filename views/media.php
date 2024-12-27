<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie z JOIN do tabel apartments i media_types
$query = "
    SELECT mu.id, mu.reading_date, mu.value, mu.archived, a.apartment_number, mt.name AS media_name
    FROM media_usage mu
    JOIN apartments a ON mu.apartment_id = a.id
    JOIN media_types mt ON mu.media_type_id = mt.id
";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Zużycie Mediów</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Mieszkanie</th>
            <th>Medium</th>
            <th>Data odczytu</th>
            <th>Wartość</th>
            <th>Zarchiwizowane</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>Mieszkanie #{$row['apartment_number']}</td>
                            <td>{$row['media_name']}</td>
                            <td>{$row['reading_date']}</td>
                            <td>{$row['value']}</td>
                            <td>" . ($row['archived'] ? 'Tak' : 'Nie') . "</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
