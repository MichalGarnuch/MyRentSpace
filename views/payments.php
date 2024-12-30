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

<div class="container"> <!-- Kontener dla listy płatności -->
    <h1 class="mb-4">Lista Płatności</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą płatności -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID płatności -->
            <th>Umowa</th> <!-- Kolumna ID umowy najmu -->
            <th>Data płatności</th> <!-- Kolumna daty płatności -->
            <th>Kwota</th> <!-- Kolumna kwoty płatności -->
            <th>Typ</th> <!-- Kolumna typu płatności -->
            <th>Status</th> <!-- Kolumna statusu płatności -->
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
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>"; // Wiersz informujący o braku danych
        }
        ?>
        </tbody>
    </table>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `payments.php` generuje listę płatności.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel rent_payments oraz rental_agreements, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID płatności, ID umowy, datę płatności, kwotę, typ oraz status płatności.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
