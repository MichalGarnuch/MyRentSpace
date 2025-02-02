<?php
// Klasa obsługująca komunikację z bazą danych dla tabeli `tenants`.
class TenantsModel {
    // Połączenie z bazą danych
    private $db;

    // Konstruktor - przyjmuje połączenie z bazą ($db)
    public function __construct($db) {
        $this->db = $db;
    }

    // Pobiera wszystkich najemców z tabeli `tenants`
    public function getAll() {
        $query = "SELECT id, first_name, last_name, phone, email FROM tenants";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane jako tablicę
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Błąd zapytania
        }
    }

    // Zapisuje nowego najemcę do bazy danych
    public function save($data) {
        $query = "INSERT INTO tenants (first_name, last_name, phone, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("ssss", $data['first_name'], $data['last_name'], $data['phone'], $data['email']); // Powiązanie danych

        if ($stmt->execute()) {
            return true; // Jeśli zapis udany
        } else {
            throw new Exception("Błąd zapisu: " . $stmt->error); // Błąd zapisu
        }
    }
}
?>
