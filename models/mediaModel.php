<?php
// Klasa MediaModel obsługuje komunikację z bazą danych dla tabeli `media_usage`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi związanymi z mediami.

class MediaModel {
    // Prywatna zmienna $db przechowuje połączenie z bazą danych.
    private $db;

    // Konstruktor klasy, który przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie odczyty zużycia mediów wraz z powiązanymi danymi.
    public function getAll() {
        $query = "
            SELECT 
                mu.id, 
                mu.reading_date, 
                mu.value, 
                mu.archived, 
                a.apartment_number, 
                CONCAT(b.street, ' ', b.building_number, ', ', l.city) AS full_address,
                mt.name AS media_name,
                mt.unit AS media_unit,
                ra.id AS rental_agreement_id,
                CONCAT('Umowa #', ra.id) AS agreement_details
            FROM media_usage mu
            JOIN apartments a ON mu.apartment_id = a.id
            JOIN buildings b ON a.building_id = b.id
            JOIN locations l ON b.location_id = l.id
            JOIN media_types mt ON mu.media_type_id = mt.id
            LEFT JOIN rental_agreements ra ON mu.rental_agreement_id = ra.id
            ORDER BY mu.reading_date DESC
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja getAllMediaTypes: Pobiera wszystkie typy mediów.
    public function getAllMediaTypes() {
        $query = "SELECT id, name, unit FROM media_types ORDER BY name ASC";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja getAllApartments: Pobiera wszystkie mieszkania wraz z pełnym adresem.
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
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja getRentalAgreementsByApartment: Pobiera umowy najmu dla konkretnego mieszkania.
    public function getRentalAgreementsByApartment($apartmentId) {
        $query = "
            SELECT 
                ra.id, 
                ra.apartment_id, 
                CONCAT('Umowa #', ra.id, ' (', ra.start_date, ' - ', ra.end_date, ')') AS agreement_details
            FROM rental_agreements ra
            WHERE ra.apartment_id = ?
            ORDER BY ra.start_date DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $apartmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }
// Duplicate method removed. The original getAllApartments() is retained earlier in the code.
    // Funkcja save: Zapisuje nowy odczyt zużycia mediów do tabeli `media_usage`.
    public function save($data) {
        // Walidacja mieszkania
        $apartmentQuery = "SELECT id FROM apartments WHERE id = ?";
        $apartmentStmt = $this->db->prepare($apartmentQuery);
        $apartmentStmt->bind_param("i", $data['apartment_id']);
        $apartmentStmt->execute();
        if ($apartmentStmt->get_result()->num_rows === 0) {
            throw new Exception("Wybrane mieszkanie nie istnieje w systemie.");
        }

        // Walidacja typu medium
        $mediaTypeQuery = "SELECT id FROM media_types WHERE id = ?";
        $mediaTypeStmt = $this->db->prepare($mediaTypeQuery);
        $mediaTypeStmt->bind_param("i", $data['media_type_id']);
        $mediaTypeStmt->execute();
        if ($mediaTypeStmt->get_result()->num_rows === 0) {
            throw new Exception("Wybrany typ medium nie istnieje w systemie.");
        }

        // Walidacja umowy najmu (opcjonalna)
        if (!empty($data['rental_agreement_id'])) {
            $agreementQuery = "SELECT id FROM rental_agreements WHERE id = ?";
            $agreementStmt = $this->db->prepare($agreementQuery);
            $agreementStmt->bind_param("i", $data['rental_agreement_id']);
            $agreementStmt->execute();
            if ($agreementStmt->get_result()->num_rows === 0) {
                throw new Exception("Wybrana umowa najmu nie istnieje w systemie.");
            }
        }

        // Zapis do tabeli
        $query = "
            INSERT INTO media_usage (apartment_id, media_type_id, rental_agreement_id, reading_date, value, archived) 
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query);
        $archived = $data['archived'] ?? 0;
        $stmt->bind_param(
            "iiidsi",
            $data['apartment_id'],
            $data['media_type_id'],
            $data['rental_agreement_id'],
            $data['reading_date'],
            $data['value'],
            $archived
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
