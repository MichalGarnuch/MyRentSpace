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

<div class="container"> <!-- Kontener dla listy zgłoszeń serwisowych -->
    <h1 class="mb-4">Zgłoszenia Serwisowe</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą zgłoszeń -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID zgłoszenia -->
            <th>Mieszkanie</th> <!-- Kolumna mieszkania -->
            <th>Opis zgłoszenia</th> <!-- Kolumna opisu zgłoszenia -->
            <th>Data zgłoszenia</th> <!-- Kolumna daty zgłoszenia -->
            <th>Status</th> <!-- Kolumna statusu zgłoszenia -->
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
            echo "<tr><td colspan='5' class='text-center'>Brak danych</td></tr>"; // Wiersz informujący o braku danych
        }
        ?>
        </tbody>
    </table>
</div>
<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `maintenance.php` generuje listę zgłoszeń serwisowych.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel maintenance_requests oraz apartments, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID zgłoszenia, numer mieszkania, opis zgłoszenia, datę zgłoszenia oraz status.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
