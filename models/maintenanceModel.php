<?php
class MaintenanceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobiera wszystkie zgłoszenia serwisowe
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
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Pobiera listę mieszkań
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
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Dodaje nowe zgłoszenie serwisowe
    public function add($data) {
        $query = "INSERT INTO maintenance_requests (apartment_id, description, request_date, status)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "isss",
            $data['apartment_id'],
            $data['description'],
            $data['request_date'],
            $data['status']
        );

        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Błąd zapisu zgłoszenia: " . $stmt->error);
        }
    }

    // Aktualizuje istniejące zgłoszenie serwisowe
    public function update($data) {
        $query = "UPDATE maintenance_requests SET description = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "ssi",
            $data['description'],
            $data['status'],
            $data['id']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd aktualizacji zgłoszenia: " . $stmt->error);
        }
    }

    // Usuwa zgłoszenie serwisowe na podstawie ID
    public function delete($id) {
        $query = "DELETE FROM maintenance_requests WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd usuwania zgłoszenia: " . $stmt->error);
        }
    }

    // Pobiera szczegóły pojedynczego zgłoszenia serwisowego na podstawie ID
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
            WHERE m.id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            throw new Exception("Błąd pobierania zgłoszenia: " . $stmt->error);
        }
    }
}
?>
