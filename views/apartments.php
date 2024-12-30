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

<div class="container"> <!-- Kontener dla listy mieszkań -->
    <h1 class="mb-4">Lista Mieszkań</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą mieszkań -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID mieszkania -->
            <th>Numer mieszkania</th> <!-- Kolumna numeru mieszkania -->
            <th>Piętro</th> <!-- Kolumna numeru piętra -->
            <th>Powierzchnia (m²)</th> <!-- Kolumna powierzchni mieszkania -->
            <th>Status</th> <!-- Kolumna statusu mieszkania -->
            <th>Budynek</th> <!-- Kolumna adresu budynku -->
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
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>"; // Wiersz informujący o braku danych
        }
        ?>
        </tbody>
    </table>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `apartments.php` generuje listę mieszkań.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel apartments oraz buildings, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID mieszkania, numer mieszkania, piętro, powierzchnię, status oraz adres budynku (ulica i numer).-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
