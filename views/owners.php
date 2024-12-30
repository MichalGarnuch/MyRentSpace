<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie SELECT do tabeli owners
$query = "SELECT id, first_name, last_name, phone, email, commission_rate FROM owners";
$result = $conn->query($query);
?>

<div class="container"> <!-- Kontener dla listy właścicieli -->
    <h1 class="mb-4">Lista Właścicieli</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą właścicieli -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID właściciela -->
            <th>Imię</th> <!-- Kolumna imię -->
            <th>Nazwisko</th> <!-- Kolumna nazwisko -->
            <th>Telefon</th> <!-- Kolumna telefonu -->
            <th>Email</th> <!-- Kolumna adresu e-mail -->
            <th>Procent prowizji</th> <!-- Kolumna procentu prowizji -->
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['commission_rate']}%</td>
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
<!--- Plik `owner.php` generuje listę właścicieli nieruchomości.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabeli owners.-->
<!--- Wyświetlane dane obejmują ID, imię, nazwisko, numer telefonu, adres e-mail oraz procent prowizji.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
