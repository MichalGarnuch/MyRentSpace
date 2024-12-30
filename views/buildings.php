<?php
include 'config/db.php'; // Dołączenie pliku połączenia z bazą danych

// Zapytanie do bazy danych
$query = "SELECT * FROM buildings";
$result = $conn->query($query);
?>

<div class="container"> <!-- Kontener dla listy budynków -->
    <h1 class="mb-4">Lista Budynków</h1> <!-- Nagłówek strony -->
    <!-- Tabela wyświetlająca dane -->
    <table class="table table-striped"> <!-- Tabela z listą budynków -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID budynku -->
            <th>Ulica</th> <!-- Kolumna ulicy -->
            <th>Numer budynku</th> <!-- Kolumna numeru budynku -->
            <th>Liczba pięter</th> <!-- Kolumna liczby pięter -->
            <th>Koszty wspólne</th> <!-- Kolumna kosztów wspólnych -->
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Wyświetlanie danych w wierszach tabeli
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['street']}</td>
                            <td>{$row['building_number']}</td>
                            <td>{$row['total_floors']}</td>
                            <td>{$row['common_cost']}</td>
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
<!--- Plik `buildings.php` generuje listę budynków.-->
<!--- Dane pobierane są za pomocą prostego zapytania SQL z tabeli `buildings`.-->
<!--- Wyświetlane dane obejmują ID budynku, ulicę, numer budynku, liczbę pięter oraz koszty wspólne.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
