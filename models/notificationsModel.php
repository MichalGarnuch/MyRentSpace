<?php
class NotificationsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Pobiera wszystkie powiadomienia z bazy danych
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
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }

    // Pobiera szczegóły pojedynczego powiadomienia na podstawie ID
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
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            throw new Exception("Błąd pobierania powiadomienia: " . $stmt->error);
        }
    }
// Pobiera wszystkich użytkowników z bazy danych
    public function getAllUsers() {
        $query = "SELECT id, username FROM users ORDER BY username ASC";
        $result = $this->db->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Błąd zapytania SQL: " . $this->db->error);
        }
    }
    // Dodaje nowe powiadomienie do bazy danych
    public function add($data) {
        $query = "INSERT INTO notifications (user_id, message, type, sent_at, status) VALUES (?, ?, ?, NOW(), 'unread')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "iss",
            $data['user_id'],
            $data['message'],
            $data['type']
        );

        if ($stmt->execute()) {
            return $this->db->insert_id;
        } else {
            throw new Exception("Błąd zapisu powiadomienia: " . $stmt->error);
        }
    }

    // Aktualizuje istniejące powiadomienie
    public function update($data) {
        $query = "UPDATE notifications SET message = ?, type = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            "sssi",
            $data['message'],
            $data['type'],
            $data['status'],
            $data['id']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd aktualizacji powiadomienia: " . $stmt->error);
        }
    }

    // Usuwa powiadomienie na podstawie ID
    public function delete($id) {
        $query = "DELETE FROM notifications WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Błąd usuwania powiadomienia: " . $stmt->error);
        }
    }

    // Waliduje dane powiadomienia
    public function validateData($data) {
        // Sprawdzenie poprawności typu powiadomienia
        $validTypes = ['reminder', 'info', 'alert'];
        if (!in_array($data['type'], $validTypes)) {
            throw new Exception("Nieprawidłowy typ powiadomienia.");
        }

        // Sprawdzenie poprawności statusu powiadomienia
        $validStatuses = ['unread', 'read'];
        if (!in_array($data['status'], $validStatuses)) {
            throw new Exception("Nieprawidłowy status powiadomienia.");
        }

        return true;
    }
}
?>
