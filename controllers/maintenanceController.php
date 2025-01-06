<?php
// Import modelu MaintenanceModel, który obsługuje dane z bazy dotyczące zgłoszeń serwisowych.
require_once __DIR__ . '/../models/maintenanceModel.php';

class MaintenanceController {
    private $model;

    public function __construct($db) {
        $this->model = new MaintenanceModel($db); // Inicjalizacja modelu
    }

    // Wyświetla listę zgłoszeń serwisowych
    public function listMaintenance() {
        try {
            $maintenanceRequests = $this->model->getAll(); // Pobranie danych o zgłoszeniach
            require __DIR__ . '/../views/maintenance/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }

    // Wyświetla formularz dodawania zgłoszeń serwisowych
    public function addMaintenanceView() {
        try {
            $apartments = $this->model->getAllApartments(); // Pobranie mieszkań
            require __DIR__ . '/../views/maintenance/add_maintenance.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }

    // Obsługuje zapis nowego zgłoszenia serwisowego do bazy danych
    public function saveMaintenance($data) {
        try {
            // Walidacja danych
            if (empty($data['apartment_id']) || empty($data['description']) || empty($data['request_date']) || empty($data['status'])) {
                header('Location: index.php?view=add_maintenance&error=empty_fields');
                exit();
            }

            // Zapis danych do bazy
            $this->model->add([
                'apartment_id' => $data['apartment_id'],
                'description' => $data['description'],
                'request_date' => $data['request_date'],
                'status' => $data['status']
            ]);

            header('Location: index.php?view=add_maintenance&success=maintenance_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_maintenance&error=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Wyświetla formularz edycji zgłoszenia serwisowego
    public function editMaintenanceView($id) {
        try {
            $maintenance = $this->model->getById($id); // Pobranie szczegółów zgłoszenia
            $apartments = $this->model->getAllApartments(); // Pobranie listy mieszkań
            require __DIR__ . '/../views/maintenance/edit_maintenance.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }

    // Obsługuje aktualizację istniejącego zgłoszenia serwisowego
    public function updateMaintenance($data) {
        try {
            // Walidacja danych
            if (empty($data['id']) || empty($data['description']) || empty($data['status'])) {
                header('Location: index.php?view=edit_maintenance&error=empty_fields&id=' . urlencode($data['id']));
                exit();
            }

            // Aktualizacja zgłoszenia
            $this->model->update([
                'id' => $data['id'],
                'description' => $data['description'],
                'status' => $data['status']
            ]);

            header('Location: index.php?view=maintenance&success=maintenance_updated');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=edit_maintenance&error=' . urlencode($e->getMessage()) . '&id=' . urlencode($data['id']));
            exit();
        }
    }

    // Obsługuje usunięcie zgłoszenia serwisowego
    public function deleteMaintenance($id) {
        try {
            $this->model->delete($id); // Usunięcie zgłoszenia z bazy
            header('Location: index.php?view=maintenance&success=maintenance_deleted');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=maintenance&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
