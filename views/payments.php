<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie z JOIN do tabel rental_agreements
$query = "
    SELECT rp.id, rp.payment_date, rp.amount, rp.type, rp.status, ra.id AS agreement_id
    FROM rent_payments rp
    JOIN rental_agreements ra ON rp.rental_agreement_id = ra.id
";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Lista Płatności</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Umowa</th>
            <th>Data płatności</th>
            <th>Kwota</th>
            <th>Typ</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>Umowa #{$row['agreement_id']}</td>
                            <td>{$row['payment_date']}</td>
                            <td>{$row['amount']} PLN</td>
                            <td>{$row['type']}</td>
                            <td>{$row['status']}</td>
                          </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
