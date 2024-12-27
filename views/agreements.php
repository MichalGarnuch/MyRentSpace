<?php
include 'config/db.php'; // Dołączenie pliku połączenia z bazą danych

// Zapytanie z JOIN do tabel apartments, tenants i owners
$query = "
    SELECT ra.id, ra.start_date, ra.end_date, ra.rent_amount, ra.status, 
           a.apartment_number, t.first_name, t.last_name, o.first_name AS owner_first_name, o.last_name AS owner_last_name
    FROM rental_agreements ra
    JOIN apartments a ON ra.apartment_id = a.id
    JOIN tenants t ON ra.tenant_id = t.id
    JOIN owners o ON ra.owner_id = o.id
";
$result = $conn->query($query);

// Sprawdzenie poprawności zapytania
if (!$result) {
    die("Błąd zapytania SQL: " . $conn->error);
}
?>

<div class="container">
    <h1 class="mb-4">Lista Umów Najmu</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Mieszkanie</th>
            <th>Najemca</th>
            <th>Właściciel</th>
            <th>Data rozpoczęcia</th>
            <th>Data zakończenia</th>
            <th>Czynsz</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>Mieszkanie #{$row['apartment_number']}</td>
                            <td>{$row['first_name']} {$row['last_name']}</td>
                            <td>{$row['owner_first_name']} {$row['owner_last_name']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                            <td>{$row['rent_amount']} PLN</td>
                            <td>{$row['status']}</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
