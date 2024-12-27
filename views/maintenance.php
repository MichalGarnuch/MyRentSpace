<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie z JOIN do tabel apartments
$query = "
    SELECT mr.id, mr.description, mr.request_date, mr.status, a.apartment_number
    FROM maintenance_requests mr
    JOIN apartments a ON mr.apartment_id = a.id
";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Zgłoszenia Serwisowe</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Mieszkanie</th>
            <th>Opis zgłoszenia</th>
            <th>Data zgłoszenia</th>
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
                            <td>{$row['description']}</td>
                            <td>{$row['request_date']}</td>
                            <td>{$row['status']}</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
