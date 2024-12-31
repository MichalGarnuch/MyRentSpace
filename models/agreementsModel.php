<?php
// Klasa AgreementsModel obsługuje komunikację z bazą danych dla tabeli `rental_agreements`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w tabeli `rental_agreements`.

class AgreementsModel {
    // Prywatna zmienna $db przechowuje połączenie z bazą danych.
    private $db;

    // Konstruktor klasy, który przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie umowy najmu z tabeli `rental_agreements` i powiązane dane.
    // 1. Łączy tabelę `rental_agreements` z tabelami `apartments`, `tenants`, i `owners` za pomocą kluczy obcych.
    // 2. Zwraca wyniki jako tablicę asocjacyjną, gotową do użycia w kontrolerze.
    public function getAll() {
        $query = "
            SELECT ra.id, ra.start_date, ra.end_date, ra.rent_amount, ra.status, 
                   a.apartment_number, 
                   t.first_name AS tenant_first_name, t.last_name AS tenant_last_name, 
                   o.first_name AS owner_first_name, o.last_name AS owner_last_name
            FROM rental_agreements ra
            JOIN apartments a ON ra.apartment_id = a.id
            JOIN tenants t ON ra.tenant_id = t.id
            JOIN owners o ON ra.owner_id = o.id
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

    // Funkcja save: Zapisuje nową umowę najmu do tabeli `rental_agreements`.
    // 1. Przyjmuje dane: `apartment_id`, `tenant_id`, `start_date`, `end_date`, `rent_amount`.
    // 2. Zwraca `true` po pomyślnym zapisaniu danych lub rzuca wyjątek w przypadku błędu.
    public function save($data) {
        $query = "INSERT INTO rental_agreements (apartment_id, tenant_id, owner_id, start_date, end_date, rent_amount) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("iiissd", // Typy danych: i - integer, s - string, d - double
            $data['apartment_id'],
            $data['tenant_id'],
            $data['owner_id'], // Nowe pole
            $data['start_date'],
            $data['end_date'],
            $data['rent_amount']
        );

        if ($stmt->execute()) {
            // Zwraca `true`, jeśli zapis się powiódł.
            return true;
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie.
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }

    // Funkcja getAllApartments: Pobiera listę wszystkich mieszkań z tabeli `apartments`.
    // 1. Zwraca dane jako tablicę asocjacyjną.
    public function getAllApartments() {
        $query = "SELECT id, apartment_number FROM apartments ORDER BY apartment_number ASC"; // Zapytanie SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Funkcja getAllTenants: Pobiera listę wszystkich najemców z tabeli `tenants`.
    // 1. Zwraca dane jako tablicę asocjacyjną.
    public function getAllTenants() {
        $query = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM tenants ORDER BY last_name ASC"; // Zapytanie SQL
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jeśli wystąpi błąd, rzuca wyjątek z komunikatem o błędzie SQL.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }
    public function getAllOwners() {
        $query = "SELECT id, first_name, last_name FROM owners ORDER BY last_name ASC"; // Zapytanie SQL
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca dane jako tablicę asocjacyjną
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }
}
