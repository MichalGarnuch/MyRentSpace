<?php
class BuildingsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "
            SELECT b.id, l.city, l.postal_code, b.street, b.building_number, b.total_floors, b.common_cost
            FROM buildings b
            JOIN locations l ON b.location_id = l.id
        ";
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
            return $this->db->insert_id; // Zwraca ID nowo dodanej miejscowości
        } else {
            throw new Exception("Błąd zapisu miejscowości: " . $stmt->error);
        }
    }


    public function getAllLocations() {
        $query = "SELECT id, city, postal_code FROM locations ORDER BY city ASC"; // Posortowane alfabetycznie
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca wszystkie rekordy jako tablicę asocjacyjną
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }


    public function save($data) {
        $query = "INSERT INTO buildings (location_id, street, building_number, total_floors, common_cost) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("issid",
            $data['location_id'],
            $data['street'],
            $data['building_number'],
            $data['total_floors'],
            $data['common_cost']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
