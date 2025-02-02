<?php
// Klasa PaymentsModel obsługuje komunikację z bazą danych dla tabeli `rent_payments`.
// Zawiera metody do pobierania, zapisywania i zarządzania danymi płatności.

class PaymentsModel {
    // Połączenie z bazą danych
    private $db;

    // Konstruktor klasy przyjmujący połączenie z bazą ($db)
    public function __construct($db) {
        $this->db = $db;
    }

    // Pobiera wszystkie płatności z tabeli `rent_payments` oraz powiązane umowy z tabeli `rental_agreements`
    public function getAll() {
        $query = "
            SELECT p.id, p.payment_date, p.amount, p.type, p.status, 
                   CONCAT('Umowa #', r.id, ' (', r.start_date, ' - ', r.end_date, ')') AS agreement_description
            FROM rent_payments p
            JOIN rental_agreements r ON p.rental_agreement_id = r.id
        ";
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wyniki jako tablicę asocjacyjną
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Rzuca wyjątek w przypadku błędu zapytania SQL
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Pobiera wszystkie umowy najmu z tabeli `rental_agreements`
    public function getAllAgreements() {
        $query = "
            SELECT id, CONCAT('Umowa #', id, ' (', start_date, ' - ', end_date, ')') AS agreement_description 
            FROM rental_agreements 
            ORDER BY id ASC
        ";
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wyniki jako tablicę asocjacyjną
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Rzuca wyjątek w przypadku błędu zapytania SQL
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Zapisuje nową płatność do tabeli `rent_payments`
    public function save($data) {
        $query = "
            INSERT INTO rent_payments (rental_agreement_id, payment_date, amount, type, status) 
            VALUES (?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("isdss",
            $data['rental_agreement_id'], // ID umowy najmu (integer)
            $data['payment_date'],        // Data płatności (string)
            $data['amount'],              // Kwota płatności (double)
            $data['type'],                // Typ płatności (string)
            $data['status']               // Status płatności (string)
        );

        if ($stmt->execute()) {
            // Zwraca `true`, jeśli zapis się powiódł
            return true;
        } else {
            // Rzuca wyjątek w przypadku błędu zapisu
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
?>
