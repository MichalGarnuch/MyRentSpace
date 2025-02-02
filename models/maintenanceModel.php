<?php
// Klasa MaintenanceModel obsługuje komunikację z bazą danych dla tabeli `maintenance_requests`.
// Model zawiera metody do pobierania, zapisywania, aktualizowania i usuwania zgłoszeń serwisowych.

class MaintenanceModel {
    private $db; // Prywatna zmienna przechowująca połączenie z bazą danych.

    // Konstruktor przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie zgłoszenia serwisowe wraz z danymi o mieszkaniu, budynku i lokalizacji.
    public function getAll() {
        $query = "
            SELECT 
                m.id, 
                m.apartment_id, 
                m.description, 
                m.request_date, 
                m.status,
                a.apartment_number, 
                a.floor_number,
                b.street, 
                b.building_number,
                l.city, 
                l.postal_code
            FROM maintenance_requests m
            LEFT JOIN apartments a ON m.apartment_id = a.id
            LEFT JOIN buildings b ON a.building_id = b.id
            LEFT JOIN locations l ON b.location_id = l.id
            ORDER BY m.request_date DESC
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca wszystkie zgłoszenia jako tablicę asocjacyjną.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Błąd zapytania.
        }
    }

    // Funkcja getAllApartments: Pobiera wszystkie mieszkania wraz z pełnym adresem (ulica, numer budynku, miasto).
    public function getAllApartments() {
        $query = "
            SELECT 
                a.id, 
                a.apartment_number, 
                a.floor_number, 
                CONCAT(b.street, ' ', b.building_number, ', ', l.city) AS full_address
            FROM apartments a
            JOIN buildings b ON a.building_id = b.id
            JOIN locations l ON b.location_id = l.id
            ORDER BY a.apartment_number ASC
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca wszystkie mieszkania z pełnym adresem.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Błąd zapytania.
        }
    }

    // Funkcja add: Dodaje nowe zgłoszenie serwisowe do tabeli `maintenance_requests`.
    public function add($data) {
        $query = "INSERT INTO maintenance_requests (apartment_id, description, request_date, status)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "isss", // Typy danych: i - integer, s - string
            $data['apartment_id'], // ID mieszkania
            $data['description'],  // Opis zgłoszenia
            $data['request_date'], // Data zgłoszenia
            $data['status']        // Status zgłoszenia
        );

        if ($stmt->execute()) {
            return $this->db->insert_id; // Zwraca ID nowo dodanego zgłoszenia.
        } else {
            throw new Exception("Błąd zapisu zgłoszenia: " . $stmt->error); // Błąd zapisu.
        }
    }

    // Funkcja update: Aktualizuje istniejące zgłoszenie serwisowe.
    public function update($data) {
        $query = "UPDATE maintenance_requests SET description = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssi", // Typy danych: s - string, i - integer
            $data['description'], // Opis zgłoszenia
            $data['status'],      // Status zgłoszenia
            $data['id']           // ID zgłoszenia
        );

        if ($stmt->execute()) {
            return true; // Zwraca true, jeśli aktualizacja się powiodła.
        } else {
            throw new Exception("Błąd aktualizacji zgłoszenia: " . $stmt->error); // Błąd aktualizacji.
        }
    }

    // Funkcja delete: Usuwa zgłoszenie serwisowe na podstawie ID.
    public function delete($id) {
        $query = "DELETE FROM maintenance_requests WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id); // Przygotowanie zapytania z parametrem ID.

        if ($stmt->execute()) {
            return true; // Zwraca true, jeśli usuwanie się powiodło.
        } else {
            throw new Exception("Błąd usuwania zgłoszenia: " . $stmt->error); // Błąd usuwania.
        }
    }

    // Funkcja getById: Pobiera szczegóły pojedynczego zgłoszenia serwisowego na podstawie ID.
    public function getById($id) {
        $query = "
            SELECT 
                m.id, 
                m.apartment_id, 
                m.description, 
                m.request_date, 
                m.status,
                a.apartment_number, 
                a.floor_number,
                b.street, 
                b.building_number,
                l.city, 
                l.postal_code
            FROM maintenance_requests m
            LEFT JOIN apartments a ON m.apartment_id = a.id
            LEFT JOIN buildings b ON a.building_id = b.id
            LEFT JOIN locations l ON b.location_id = l.id
            WHERE m.id = ?"; // Zapytanie do pobrania zgłoszenia na podstawie ID.
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id); // Przygotowanie zapytania z parametrem ID.

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Zwraca szczegóły zgłoszenia.
        } else {
            throw new Exception("Błąd pobierania zgłoszenia: " . $stmt->error); // Błąd pobierania.
        }
    }
}
?>
