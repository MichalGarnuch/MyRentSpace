<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie z JOIN do tabel users
$query = "
    SELECT n.id, n.message, n.type, n.sent_at, n.status, u.username
    FROM notifications n
    JOIN users u ON n.user_id = u.id
";
$result = $conn->query($query);
?>

<div class="container"> <!-- Kontener dla listy powiadomień -->
    <h1 class="mb-4">Powiadomienia</h1> <!-- Nagłówek strony -->
    <table class="table table-striped"> <!-- Tabela z listą powiadomień -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID powiadomienia -->
            <th>Użytkownik</th> <!-- Kolumna nazwy użytkownika -->
            <th>Treść powiadomienia</th> <!-- Kolumna treści powiadomienia -->
            <th>Typ</th> <!-- Kolumna typu powiadomienia -->
            <th>Data wysłania</th> <!-- Kolumna daty wysłania -->
            <th>Status</th> <!-- Kolumna statusu powiadomienia -->
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['type']}</td>
                            <td>{$row['sent_at']}</td>
                            <td>" . ($row['status'] === 'unread' ? 'Nieprzeczytane' : 'Przeczytane') . "</td>
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
<!--- Plik `notifications.php` generuje listę powiadomień.-->
<!--- Dane pobierane są za pomocą zapytania SQL z tabel notifications oraz users, wykorzystując JOIN.-->
<!--- Wyświetlane dane obejmują ID powiadomienia, nazwę użytkownika, treść powiadomienia, typ, datę wysłania oraz status.-->
<!--- Status jest wyświetlany jako "Nieprzeczytane" lub "Przeczytane" w zależności od wartości kolumny `status`.-->
<!--- W przypadku braku danych tabela wyświetla informację "Brak danych".-->
<!--*/-->
