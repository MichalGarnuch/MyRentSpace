<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie SELECT do tabeli tenants
$query = "SELECT id, first_name, last_name, phone, email FROM tenants";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Lista Najemców</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Telefon</th>
            <th>Email</th>
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
            echo "<tr><td colspan='5' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
