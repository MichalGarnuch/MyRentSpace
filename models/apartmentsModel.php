<?php
class ApartmentsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "
            SELECT a.id, a.apartment_number, a.floor_number, a.size_sqm, a.status, 
                   b.street, b.building_number
            FROM apartments a
            JOIN buildings b ON a.building_id = b.id
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    public function save($data) {
        $query = "INSERT INTO apartments (building_id, apartment_number, floor_number, size_sqm, status) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isdis",
            $data['building_id'],
            $data['apartment_number'],
            $data['floor_number'],
            $data['size_sqm'],
            $data['status']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
