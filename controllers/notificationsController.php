<?php
// Import modelu NotificationsModel, który obsługuje dane z bazy dotyczące powiadomień
require_once __DIR__ . '/../models/notificationsModel.php';

// Klasa NotificationsController obsługuje logikę biznesową dotyczącą powiadomień.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class NotificationsController {
    private $model;

    public function __construct($db) {
        $this->model = new NotificationsModel($db); // Inicjalizacja modelu
    }

    // Wyświetla listę powiadomień
    public function listNotifications() {
        try {
            $notifications = $this->model->getAll(); // Pobranie danych o powiadomieniach
            require __DIR__ . '/../views/notifications/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania nowego powiadomienia
    public function addNotificationView() {
        try {
            $users = $this->model->getAllUsers(); // Pobranie listy użytkowników
            require __DIR__ . '/../views/notifications/add_notification.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Obsługuje zapis nowego powiadomienia do bazy danych
    public function saveNotification($data) {
        try {
            // Walidacja danych
            if (empty($data['user_id']) || empty($data['message']) || empty($data['type'])) {
                header('Location: index.php?view=add_notification&error=empty_fields');
                exit();
            }

            // Zapis powiadomienia w bazie
            $this->model->add([
                'user_id' => $data['user_id'],
                'message' => $data['message'],
                'type' => $data['type']
            ]);

            header('Location: index.php?view=add_notification&success=notification_added');
            exit();
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: index.php?view=add_notification&error=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Wyświetla formularz edycji istniejącego powiadomienia
    public function editNotificationView($id) {
        try {
            $notification = $this->model->getById($id); // Pobranie szczegółów powiadomienia
            $users = $this->model->getAllUsers(); // Pobranie listy użytkowników
            require __DIR__ . '/../views/notifications/edit_notification.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Obsługuje aktualizację powiadomienia
    public function updateNotification($data) {
        try {
            // Walidacja danych
            if (empty($data['id']) || empty($data['message']) || empty($data['type']) || empty($data['status'])) {
                header('Location: index.php?view=edit_notification&error=empty_fields&id=' . urlencode($data['id']));
                exit();
            }

            // Aktualizacja powiadomienia w bazie
            $this->model->update([
                'id' => $data['id'],
                'message' => $data['message'],
                'type' => $data['type'],
                'status' => $data['status']
            ]);

            header('Location: index.php?view=notifications&success=notification_updated');
            exit();
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: index.php?view=edit_notification&error=' . urlencode($e->getMessage()) . '&id=' . urlencode($data['id']));
            exit();
        }
    }

    // Usuwa powiadomienie na podstawie ID
    public function deleteNotification($id) {
        try {
            $this->model->delete($id); // Usunięcie powiadomienia z bazy
            header('Location: index.php?view=notifications&success=notification_deleted');
            exit();
        } catch (Exception $e) {
            // Obsługa błędu i przekierowanie z komunikatem
            header('Location: index.php?view=notifications&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
