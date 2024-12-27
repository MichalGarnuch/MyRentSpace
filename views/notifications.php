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

<div class="container">
    <h1 class="mb-4">Powiadomienia</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Użytkownik</th>
            <th>Treść powiadomienia</th>
            <th>Typ</th>
            <th>Data wysłania</th>
            <th>Status</th>
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
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
