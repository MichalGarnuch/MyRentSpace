<?php
// Klasa PaymentsModel obsługuje komunikację z bazą danych dla tabeli `rent_payments` i powiązanych danych.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w bazie.

class PaymentsModel {
    // Prywatna zmienna $db przechowuje połączenie z bazą danych.
    private $db;

    // Konstruktor klasy, który przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie płatności z tabeli `rent_payments` i powiązane umowy z tabeli `rental_agreements`.
    // 1. Łączy tabelę `rent_payments` z tabelą `rental_agreements` za pomocą klucza obcego `rental_agreement_id`.
    // 2. Zwraca wyniki jako tablicę asocjacyjną, gotową do użycia w kontrolerze.
    public function getAll() {
        $query = "
            SELECT p.id, p.payment_date, p.amount, p.type, p.status, 
                   CONCAT('Umowa #', r.id, ' (', r.start_date, ' - ', r.end_date, ')') AS agreement_description
            FROM rent_payments p
            JOIN rental_agreements r ON p.rental_agreement_id = r.id
        ";
        // Wykonanie zapytania SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja getAllAgreements: Pobiera wszystkie umowy najmu z tabeli `rental_agreements`.
    // 1. Przyjmuje dane o umowach i generuje opis w formacie: "Umowa #ID (start_date - end_date)".
    // 2. Zwraca wyniki jako tablicę asocjacyjną.
    public function getAllAgreements() {
        $query = "
            SELECT id, CONCAT('Umowa #', id, ' (', start_date, ' - ', end_date, ')') AS agreement_description 
            FROM rental_agreements 
            ORDER BY id ASC
        ";
        // Wykonanie zapytania SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja save: Zapisuje nową płatność do tabeli `rent_payments`.
    // 1. Przyjmuje dane: `rental_agreement_id`, `payment_date`, `amount`, `type`, `status`.
    // 2. Zwraca `true` po pomyślnym zapisaniu danych lub rzuca wyjątek w przypadku błędu.
    public function save($data) {
        $query = "
            INSERT INTO rent_payments (rental_agreement_id, payment_date, amount, type, status) 
            VALUES (?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("isdss", // Typy danych: i - integer, s - string, d - double
            $data['rental_agreement_id'], // ID umowy najmu (int)
            $data['payment_date'],        // Data płatności (string)
            $data['amount'],              // Kwota płatności (double)
            $data['type'],                // Typ płatności (string)
            $data['status']               // Status płatności (string)
        );

        if ($stmt->execute()) {
            // Zwraca `true`, jeśli zapis się powiódł.
            return true;
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie.
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
