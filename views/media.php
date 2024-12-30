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

<div class="container"> <!-- Kontener dla listy zużycia mediów -->
    <h1 class="mb-4">Zużycie Mediów</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą zużycia mediów -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID odczytu -->
            <th>Mieszkanie</th> <!-- Kolumna mieszkania -->
            <th>Medium</th> <!-- Kolumna medium -->
            <th>Data odczytu</th> <!-- Kolumna daty odczytu -->
            <th>Wartość</th> <!-- Kolumna wartości zużycia -->
            <th>Zarchiwizowane</th> <!-- Kolumna statusu archiwizacji -->
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
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>"; // Wiersz informujący o braku danych
        }
        ?>
        </tbody>
    </table>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `media.php` generuje listę odczytów zużycia mediów.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel media_usage, apartments oraz media_types, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID odczytu, numer mieszkania, nazwę medium, datę odczytu, wartość oraz status archiwizacji.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
