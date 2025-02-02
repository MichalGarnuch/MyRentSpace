<?php
// Parametry połączenia z bazą danych
$host = 'localhost';          // Adres serwera bazy danych
$db_name = 'bd-myrentspace';  // Nazwa bazy danych
$user = 'root';               // Domyślny użytkownik w XAMPP
$password = '';               // Brak hasła w domyślnej konfiguracji XAMPP

// Połączenie z bazą danych
$conn = new mysqli($host, $user, $password, $db_name);

// Sprawdzenie, czy połączenie się powiodło
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error); // W przypadku błędu połączenia
}
?>
