<?php
// Klasa OwnersModel obsługuje komunikację z bazą danych dla tabeli `owners`.
// Model zawiera metody do pobierania, zapisywania oraz zarządzania danymi w bazie.

class OwnersModel {
    // Prywatna zmienna $db przechowuje połączenie z bazą danych.
    private $db;

    // Konstruktor klasy, który przyjmuje połączenie z bazą ($db) i przypisuje je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkich właścicieli z tabeli `owners`.
    // 1. Zwraca wyniki jako tablicę asocjacyjną, gotową do użycia w kontrolerze.
    public function getAll() {
        $query = "SELECT id, first_name, last_name, phone, email, commission_rate FROM owners";
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

    // Funkcja save: Zapisuje nowego właściciela do tabeli `owners`.
    // 1. Przyjmuje dane: `first_name`, `last_name`, `phone`, `email`, `commission_rate`.
    // 2. Zwraca `true` po pomyślnym zapisaniu danych lub rzuca wyjątek w przypadku błędu.
    public function save($data) {
        $query = "INSERT INTO owners (first_name, last_name, phone, email, commission_rate) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query); // Przygotowanie zapytania SQL
        $stmt->bind_param("ssssd", // Typy danych: s - string, d - double
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['email'],
            $data['commission_rate']
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
