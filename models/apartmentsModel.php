<?php
// Klasa ApartmentsModel obsługuje komunikację z bazą danych dla tabeli `apartments`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w tabeli `apartments`.

class ApartmentsModel {
    // Prywatna zmienna $db przechowuje połączenie z bazą danych.
    private $db;

    // Konstruktor klasy, który przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie mieszkania z tabeli `apartments` i powiązane budynki z tabeli `buildings`.
    // 1. Łączy tabelę `apartments` z tabelą `buildings` za pomocą klucza obcego `building_id`.
    // 2. Zwraca wyniki jako tablicę asocjacyjną, gotową do użycia w kontrolerze.
    public function getAll() {
        $query = "SELECT a.id, a.apartment_number, a.floor_number, a.size_sqm, a.status, 
               b.street, b.building_number, 
               l.city, l.postal_code
        FROM apartments a
        JOIN buildings b ON a.building_id = b.id
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
    public function getAllLocations() {
        $query = "SELECT id, city, postal_code FROM locations ORDER BY city ASC";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    public function addLocation($data) {
        $query = "INSERT INTO locations (city, postal_code) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $data['city'], $data['postal_code']);

        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Błąd zapisu lokalizacji: " . $stmt->error);
        }
    }
    public function addBuilding($data) {
        $query = "INSERT INTO buildings (location_id, street, building_number) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $data['location_id'], $data['street'], $data['building_number']);

        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Błąd zapisu budynku: " . $stmt->error);
        }
    }

    // Funkcja save: Zapisuje nowe mieszkanie do tabeli `apartments`.
    // 1. Przyjmuje dane: `building_id`, `apartment_number`, `floor_number`, `size_sqm`, `status`.
    // 2. Zwraca `true` po pomyślnym zapisaniu danych lub rzuca wyjątek w przypadku błędu.
    public function save($data) {
        $query = "INSERT INTO apartments (building_id, apartment_number, floor_number, size_sqm, status) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("isdis", // Typy danych: i - integer, s - string, d - double
            $data['building_id'],
            $data['apartment_number'],
            $data['floor_number'],
            $data['size_sqm'],
            $data['status']
        );

        if ($stmt->execute()) {
            // Zwraca `true`, jeśli zapis się powiódł.
            return true;
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie.
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }

    // Funkcja getAllBuildings: Pobiera wszystkie budynki z tabeli `buildings`.
    // 1. Zwraca wyniki jako tablicę asocjacyjną.
    public function getAllBuildings() {
        $query = "
        SELECT b.id, b.street, b.building_number, b.location_id, 
               CONCAT(b.street, ' ', b.building_number) AS full_address
        FROM buildings b
    ";
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }
}
