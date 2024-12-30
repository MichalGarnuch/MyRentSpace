<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie SELECT do tabeli tenants
$query = "SELECT id, first_name, last_name, phone, email FROM tenants";
$result = $conn->query($query);
?>

<div class="container"> <!-- Kontener dla listy najemców -->
    <h1 class="mb-4">Lista Najemców</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą najemców -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID najemcy -->
            <th>Imię</th> <!-- Kolumna imię -->
            <th>Nazwisko</th> <!-- Kolumna nazwisko -->
            <th>Telefon</th> <!-- Kolumna telefonu -->
            <th>Email</th> <!-- Kolumna adresu e-mail -->
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
<!--- Plik `tenants.php` generuje listę najemców.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabeli tenants.-->
<!--- Wyświetlane dane obejmują ID, imię, nazwisko, numer telefonu oraz adres e-mail.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
