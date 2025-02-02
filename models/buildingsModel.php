<?php
// Klasa BuildingsModel obsługuje komunikację z bazą danych dla tabel `buildings` i `locations`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w bazie.

class BuildingsModel {
    private $db; // Prywatna zmienna przechowująca połączenie z bazą danych.

    // Konstruktor przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie budynki z tabeli `buildings` i powiązane miejscowości z tabeli `locations`.
    public function getAll() {
        $query = "
            SELECT b.id, l.city, l.postal_code, b.street, b.building_number, b.total_floors, b.common_cost
            FROM buildings b
            JOIN locations l ON b.location_id = l.id
        ";
        // Wykonanie zapytania SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja addLocation: Dodaje nową miejscowość do tabeli `locations`.
    // 1. Przyjmuje dane: `city` (nazwa miejscowości) i `postal_code` (kod pocztowy, opcjonalny).
    // 2. Zwraca ID nowo dodanej miejscowości.
    public function addLocation($data) {
        $query = "INSERT INTO locations (city, postal_code) VALUES (?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("ss", $data['city'], $data['postal_code']); // Powiązanie danych z zapytaniem

        if ($stmt->execute()) {
            // Zwraca ID nowo dodanej miejscowości.
            return $this->db->insert_id;
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie.
            throw new Exception("Błąd zapisu miejscowości: " . $stmt->error);
        }
    }

    // Funkcja getAllLocations: Pobiera wszystkie miejscowości z tabeli `locations`.
    // 1. Zwraca wyniki posortowane alfabetycznie według kolumny `city`.
    public function getAllLocations() {
        $query = "SELECT id, city, postal_code FROM locations ORDER BY city ASC"; // Zapytanie SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja save: Zapisuje nowy budynek do tabeli `buildings`.
    // 1. Przyjmuje dane: `location_id`, `street`, `building_number`, `total_floors`, `common_cost`.
    // 2. Zwraca `true` po pomyślnym zapisaniu danych lub rzuca wyjątek w przypadku błędu.
    public function save($data) {
        $query = "INSERT INTO buildings (location_id, street, building_number, total_floors, common_cost) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("issid", // Typy danych: i - integer, s - string, d - double
            $data['location_id'],
            $data['street'],
            $data['building_number'],
            $data['total_floors'],
            $data['common_cost']
        );

        if ($stmt->execute()) {
            // Zwraca `true`, jeśli zapis się powiódł.
            return true;
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie.
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
?>
