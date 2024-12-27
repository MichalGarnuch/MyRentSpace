<?php
include 'config/db.php'; // Dołączenie połączenia z bazą danych

// Zapytanie SELECT do tabeli owners
$query = "SELECT id, first_name, last_name, phone, email, commission_rate FROM owners";
$result = $conn->query($query);
?>

<div class="container">
    <h1 class="mb-4">Lista Właścicieli</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Telefon</th>
            <th>Email</th>
            <th>Procent prowizji</th>
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
            echo "<tr><td colspan='6' class='text-center'>Brak danych</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
