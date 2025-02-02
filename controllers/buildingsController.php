<?php
// Import modelu BuildingsModel
require_once __DIR__ . '/../models/buildingsModel.php';

class BuildingsController {
    private $model;

    public function __construct($db) {
        $this->model = new BuildingsModel($db); // Inicjalizacja modelu
    }

    // Wyświetla listę budynków
    public function listBuildings() {
        try {
            $buildings = $this->model->getAll(); // Pobranie danych
            require __DIR__ . '/../views/buildings/list.php'; // Widok
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania budynku
    public function addBuildingView() {
        try {
            $locations = $this->model->getAllLocations(); // Pobranie miejscowości
            require __DIR__ . '/../views/buildings/add_building.php'; // Formularz
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nowy budynek
    public function saveBuilding($data) {
        try {
            // Walidacja: Miejscowość musi być wybrana lub nowa dodana
            if (empty($data['location_id']) && empty($data['new_city'])) {
                header('Location: index.php?view=add_building&error=empty_location');
                exit();
            }

            // Obsługuje nową miejscowość, jeśli użytkownik podał nazwę
            if (!empty($data['new_city'])) {
                $location_id = $this->model->addLocation([
                    'city' => $data['new_city'],
                    'postal_code' => $data['new_postal_code'] ?? null
                ]);
            } else {
                $location_id = $data['location_id']; // Używa wybranej miejscowości
            }

            // Walidacja: Sprawdzanie innych wymaganych pól
            if (empty($location_id) || empty($data['street']) || empty($data['building_number']) || empty($data['total_floors']) || empty($data['common_cost'])) {
                header('Location: index.php?view=add_building&error=empty_fields');
                exit();
            }

            // Zapis danych do bazy
            $this->model->save([
                'location_id' => $location_id,
                'street' => $data['street'],
                'building_number' => $data['building_number'],
                'total_floors' => $data['total_floors'],
                'common_cost' => $data['common_cost']
            ]);

            header('Location: index.php?view=add_building&success=building_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_building&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
