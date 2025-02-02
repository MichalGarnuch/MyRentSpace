<?php
// Klasa OwnersModel obsługuje komunikację z bazą danych dla tabeli `owners`.
// Model umożliwia pobieranie, zapisywanie oraz zarządzanie danymi właścicieli.

class OwnersModel {
    // Prywatna zmienna przechowująca połączenie z bazą danych.
    private $db;

    // Konstruktor przyjmujący połączenie z bazą.
    public function __construct($db) {
        $this->db = $db;
    }

    // Pobiera wszystkich właścicieli z tabeli `owners`.
    // Zwraca dane jako tablicę asocjacyjną.
    public function getAll() {
        $query = "SELECT id, first_name, last_name, phone, email, commission_rate FROM owners";
        $result = $this->db->query($query);

        if ($result) {
            // Zwraca wyniki jako tablicę asocjacyjną.
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // W przypadku błędu zapytania SQL rzuca wyjątek.
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Zapisuje nowego właściciela do tabeli `owners`.
    // Zwraca `true` po pomyślnym zapisaniu lub rzuca wyjątek w przypadku błędu.
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
            // Zwraca `true` po pomyślnym zapisie.
            return true;
        } else {
            // W przypadku błędu zapisu rzuca wyjątek.
            throw new Exception("Błąd zapisu: " . $stmt->error);
        }
    }
}
?>
