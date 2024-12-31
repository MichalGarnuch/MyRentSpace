<?php
class AgreementsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "
            SELECT ra.id, ra.start_date, ra.end_date, ra.rent_amount, ra.status, 
                   a.apartment_number, t.first_name AS tenant_first_name, t.last_name AS tenant_last_name, 
                   o.first_name AS owner_first_name, o.last_name AS owner_last_name
            FROM rental_agreements ra
            JOIN apartments a ON ra.apartment_id = a.id
            JOIN tenants t ON ra.tenant_id = t.id
            JOIN owners o ON ra.owner_id = o.id
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    public function save($data) {
        $query = "INSERT INTO rental_agreements (apartment_id, tenant_id, start_date, end_date, rent_amount) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iissd",
            $data['apartment_id'],
            $data['tenant_id'],
            $data['start_date'],
            $data['end_date'],
            $data['rent_amount']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
