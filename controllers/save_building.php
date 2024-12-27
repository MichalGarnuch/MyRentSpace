<?php
include '../config/db.php'; // Dołączenie pliku konfiguracji bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Sprawdzenie, czy dane są przesyłane metodą POST
    // Pobieranie danych z formularza
    $street = $_POST['street'];
    $building_number = $_POST['building_number'];
    $total_floors = $_POST['total_floors'];

    // Tworzenie zapytania SQL
    $query = "INSERT INTO buildings (street, building_number, total_floors) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query); // Przygotowanie zapytania
    $stmt->bind_param("ssi", $street, $building_number, $total_floors); // Powiązanie parametrów

    // Wykonanie zapytania
    if ($stmt->execute()) {
        // Przekierowanie po sukcesie
        header('Location: ../index.php?view=buildings&success=1');
    } else {
        // Obsługa błędu
        echo "Błąd: " . $conn->error;
    }

    $stmt->close(); // Zamknięcie zapytania
}
$conn->close(); // Zamknięcie połączenia z bazą danych
?>
