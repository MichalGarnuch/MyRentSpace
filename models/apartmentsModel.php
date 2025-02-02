<?php
// Klasa ApartmentsModel obsługuje komunikację z bazą danych dla tabeli `apartments`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w tabeli `apartments`.

class ApartmentsModel {
    private $db; // Prywatna zmienna przechowująca połączenie z bazą danych.

    // Konstruktor klasy, przyjmujący połączenie z bazą danych.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie mieszkania i powiązane dane z tabel `apartments`, `buildings` i `locations`.
    public function getAll() {
        $query = "SELECT a.id, a.apartment_number, a.floor_number, a.size_sqm, a.status, 
               b.street, b.building_number, 
               l.city, l.postal_code
        FROM apartments a
        JOIN buildings b ON a.building_id = b.id
        JOIN locations l ON b.location_id = l.id
        ";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane jako tablicę asocjacyjną.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Obsługuje błąd zapytania.
        }
    }

    // Funkcja getAllLocations: Pobiera wszystkie miejscowości z tabeli `locations`.
    public function getAllLocations() {
        $query = "SELECT id, city, postal_code FROM locations ORDER BY city ASC";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane miejscowości.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Obsługuje błąd zapytania.
        }
    }

    // Funkcja addLocation: Dodaje nową miejscowość do tabeli `locations`.
    public function addLocation($data) {
        $query = "INSERT INTO locations (city, postal_code) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $data['city'], $data['postal_code']);
        if ($stmt->execute()) {
            return $this->db->insert_id; // Zwraca ID nowo dodanej miejscowości.
        } else {
            throw new Exception("Błąd zapisu lokalizacji: " . $stmt->error); // Obsługuje błąd zapisu.
        }
    }

    // Funkcja addBuilding: Dodaje nowy budynek do tabeli `buildings`.
    public function addBuilding($data) {
        $query = "INSERT INTO buildings (location_id, street, building_number) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $data['location_id'], $data['street'], $data['building_number']);
        if ($stmt->execute()) {
            return $this->db->insert_id; // Zwraca ID nowo dodanego budynku.
        } else {
            throw new Exception("Błąd zapisu budynku: " . $stmt->error); // Obsługuje błąd zapisu.
        }
    }

    // Funkcja save: Zapisuje nowe mieszkanie do tabeli `apartments`.
    public function save($data) {
        $query = "INSERT INTO apartments (building_id, apartment_number, floor_number, size_sqm, status) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isdis", // Typy danych: i - integer, s - string, d - double
            $data['building_id'],
            $data['apartment_number'],
            $data['floor_number'],
            $data['size_sqm'],
            $data['status']
        );
        if ($stmt->execute()) {
            return true; // Zwraca `true` po pomyślnym zapisaniu.
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error); // Obsługuje błąd zapisu.
        }
    }

    // Funkcja getAllBuildings: Pobiera wszystkie budynki z tabeli `buildings`.
    public function getAllBuildings() {
        $query = "
        SELECT b.id, b.street, b.building_number, b.location_id, 
               CONCAT(b.street, ' ', b.building_number) AS full_address
        FROM buildings b
    ";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane budynków.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Obsługuje błąd zapytania.
        }
    }

    // Funkcja getAllApartments: Pobiera wszystkie mieszkania z tabeli `apartments`.
    public function getAllApartments() {
        $query = "
        SELECT 
            a.id, 
            a.apartment_number, 
            CONCAT(b.street, ' ', b.building_number, ', ', l.city) AS full_address
        FROM apartments a
        JOIN buildings b ON a.building_id = b.id
        JOIN locations l ON b.location_id = l.id
        ORDER BY a.apartment_number ASC
    ";
        $result = $this->db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane mieszkań.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Obsługuje błąd zapytania.
        }
    }
}
?>
