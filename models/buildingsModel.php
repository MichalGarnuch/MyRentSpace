<?php
// buildingsModel.php
// Model obsługujący operacje na danych dotyczących budynków.
// Odpowiada za interakcję z bazą danych oraz manipulacje danymi budynków.

class BuildingModel {
    private $db; // Połączenie z bazą danych

    // Konstruktor przyjmujący połączenie z bazą danych
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja do dodawania nowego budynku
    // Parametry:
    // - $data (array): Dane wejściowe dla nowego budynku (ulica, numer budynku, liczba pięter)
    // Zwraca:
    // - bool: true w przypadku sukcesu, exception w przypadku błędu
    public function save($data) {
        $query = "INSERT INTO buildings (street, building_number, total_floors) VALUES (?, ?, ?)"; // Zapytanie SQL
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania
        $stmt->bind_param("ssi", $data['street'], $data['building_number'], $data['total_floors']); // Powiązanie parametrów

        if ($stmt->execute()) { // Wykonanie zapytania
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $this->db->error); // Obsługa błędu w przypadku niepowodzenia
        }
    }
}

?>
