<?php
// Klasa NotificationsModel obsługuje komunikację z bazą danych dla tabeli `notifications`.
// Model zapewnia metody do pobierania, zapisywania, aktualizowania, usuwania oraz walidowania powiadomień.

class NotificationsModel {
    private $db;  // Prywatna zmienna przechowująca połączenie z bazą danych.

    // Konstruktor przyjmujący połączenie z bazą ($db) i przypisujący je do zmiennej $db.
    public function __construct($db) {
        $this->db = $db;
    }

    // Funkcja getAll: Pobiera wszystkie powiadomienia z tabeli `notifications` z danymi o użytkownikach.
    // Łączy tabelę `notifications` z tabelą `users` za pomocą `user_id`.
    public function getAll() {
        $query = "
            SELECT 
                n.id, 
                n.message, 
                n.type, 
                n.sent_at, 
                n.status, 
                u.username
            FROM notifications n
            JOIN users u ON n.user_id = u.id
            ORDER BY n.sent_at DESC
        ";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca wszystkie rekordy jako tablicę asocjacyjną.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Rzuca wyjątek w przypadku błędu.
        }
    }

    // Funkcja getById: Pobiera szczegóły pojedynczego powiadomienia na podstawie ID.
    public function getById($id) {
        $query = "
            SELECT 
                n.id, 
                n.message, 
                n.type, 
                n.sent_at, 
                n.status, 
                n.user_id, 
                u.username
            FROM notifications n
            JOIN users u ON n.user_id = u.id
            WHERE n.id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);  // Przygotowanie zapytania z parametrem ID.

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Zwraca szczegóły powiadomienia.
        } else {
            throw new Exception("Błąd pobierania powiadomienia: " . $stmt->error); // Błąd zapytania.
        }
    }

    // Funkcja getAllUsers: Pobiera wszystkich użytkowników z tabeli `users`.
    public function getAllUsers() {
        $query = "SELECT id, username FROM users ORDER BY username ASC";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Zwraca wszystkich użytkowników jako tablicę asocjacyjną.
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error); // Błąd zapytania.
        }
    }

    // Funkcja add: Dodaje nowe powiadomienie do bazy danych.
    public function add($data) {
        $query = "INSERT INTO notifications (user_id, message, type, sent_at, status) VALUES (?, ?, ?, NOW(), 'unread')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", // Przygotowanie zapytania z parametrami: user_id (int), message (string), type (string)
            $data['user_id'],
            $data['message'],
            $data['type']
        );

        if ($stmt->execute()) {
            return $this->db->insert_id; // Zwraca ID nowo dodanego powiadomienia.
        } else {
            throw new Exception("Błąd zapisu powiadomienia: " . $stmt->error); // Błąd zapisu.
        }
    }

    // Funkcja update: Aktualizuje istniejące powiadomienie na podstawie ID.
    public function update($data) {
        $query = "UPDATE notifications SET message = ?, type = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", // Przygotowanie zapytania z parametrami: message (string), type (string), status (string), id (int)
            $data['message'],
            $data['type'],
            $data['status'],
            $data['id']
        );

        if ($stmt->execute()) {
            return true; // Zwraca true, jeśli aktualizacja się powiodła.
        } else {
            throw new Exception("Błąd aktualizacji powiadomienia: " . $stmt->error); // Błąd aktualizacji.
        }
    }

    // Funkcja delete: Usuwa powiadomienie na podstawie ID.
    public function delete($id) {
        $query = "DELETE FROM notifications WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);  // Przygotowanie zapytania z parametrem ID.

        if ($stmt->execute()) {
            return true; // Zwraca true, jeśli usunięcie się powiodło.
        } else {
            throw new Exception("Błąd usuwania powiadomienia: " . $stmt->error); // Błąd usuwania.
        }
    }

    // Funkcja validateData: Waliduje dane powiadomienia przed zapisaniem lub aktualizacją.
    public function validateData($data) {
        // Sprawdzenie poprawności typu powiadomienia.
        $validTypes = ['reminder', 'info', 'alert'];
        if (!in_array($data['type'], $validTypes)) {
            throw new Exception("Nieprawidłowy typ powiadomienia."); // Jeśli typ jest nieprawidłowy, rzuca wyjątek.
        }

        // Sprawdzenie poprawności statusu powiadomienia.
        $validStatuses = ['unread', 'read'];
        if (!in_array($data['status'], $validStatuses)) {
            throw new Exception("Nieprawidłowy status powiadomienia."); // Jeśli status jest nieprawidłowy, rzuca wyjątek.
        }

        return true; // Zwraca true, jeśli dane są poprawne.
    }
}
?>
