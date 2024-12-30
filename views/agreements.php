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

<div class="container"> <!-- Kontener dla listy umów najmu -->
    <h1 class="mb-4">Lista Umów Najmu</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą umów -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID -->
            <th>Mieszkanie</th> <!-- Kolumna mieszkania -->
            <th>Najemca</th> <!-- Kolumna najemcy -->
            <th>Właściciel</th> <!-- Kolumna właściciela -->
            <th>Data rozpoczęcia</th> <!-- Kolumna daty rozpoczęcia -->
            <th>Data zakończenia</th> <!-- Kolumna daty zakończenia -->
            <th>Czynsz</th> <!-- Kolumna czynszu -->
            <th>Status</th> <!-- Kolumna statusu -->
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
            echo "<tr><td colspan='8' class='text-center'>Brak danych</td></tr>"; // Wiersz informujący o braku danych
        }
        ?>
        </tbody>
    </table>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `agreements.php` generuje listę umów najmu.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel: rental_agreements, apartments, tenants i owners, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID umowy, numer mieszkania, najemcę, właściciela, daty rozpoczęcia i zakończenia, kwotę czynszu oraz status.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
