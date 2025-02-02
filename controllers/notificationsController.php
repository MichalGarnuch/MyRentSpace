<?php
// Import modelu NotificationsModel do obsługi powiadomień
require_once __DIR__ . '/../models/notificationsModel.php';

class NotificationsController {
    private $model;

    // Konstruktor inicjuje model NotificationsModel
    public function __construct($db) {
        $this->model = new NotificationsModel($db);
    }

    // Wyświetla listę powiadomień
    public function listNotifications() {
        try {
            $notifications = $this->model->getAll();
            require __DIR__ . '/../views/notifications/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania powiadomienia
    public function addNotificationView() {
        try {
            $users = $this->model->getAllUsers();
            require __DIR__ . '/../views/notifications/add_notification.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nowe powiadomienie
    public function saveNotification($data) {
        try {
            if (empty($data['user_id']) || empty($data['message']) || empty($data['type'])) {
                header('Location: index.php?view=add_notification&error=empty_fields');
                exit();
            }

            $this->model->add([
                'user_id' => $data['user_id'],
                'message' => $data['message'],
                'type' => $data['type']
            ]);

            header('Location: index.php?view=add_notification&success=notification_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_notification&error=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Wyświetla formularz edycji powiadomienia
    public function editNotificationView($id) {
        try {
            $notification = $this->model->getById($id);
            $users = $this->model->getAllUsers();
            require __DIR__ . '/../views/notifications/edit_notification.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Aktualizuje powiadomienie w bazie
    public function updateNotification($data) {
        try {
            if (empty($data['id']) || empty($data['message']) || empty($data['type']) || empty($data['status'])) {
                header('Location: index.php?view=edit_notification&error=empty_fields&id=' . urlencode($data['id']));
                exit();
            }

            $this->model->update([
                'id' => $data['id'],
                'message' => $data['message'],
                'type' => $data['type'],
                'status' => $data['status']
            ]);

            header('Location: index.php?view=notifications&success=notification_updated');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=edit_notification&error=' . urlencode($e->getMessage()) . '&id=' . urlencode($data['id']));
            exit();
        }
    }

    // Usuwa powiadomienie
    public function deleteNotification($id) {
        try {
            $this->model->delete($id);
            header('Location: index.php?view=notifications&success=notification_deleted');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=notifications&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
