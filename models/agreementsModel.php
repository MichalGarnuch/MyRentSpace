<?php
// agreementsModel.php
// Model obsługujący operacje na danych dotyczących umów najmu.

class AgreementsModel {
    private $db; // Połączenie z bazą danych

    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja do zapisu nowej umowy najmu
    // Parametry:
    // - $data (array): Dane wejściowe dla nowej umowy najmu
    public function save($data) {
        $query = "INSERT INTO rental_agreements (apartment_id, tenant_id, start_date, end_date, amount) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iissd", $data['apartment_id'], $data['tenant_id'], $data['start_date'], $data['end_date'], $data['amount']);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd zapisu: " . $this->db->error);
        }
    }
}

?>
