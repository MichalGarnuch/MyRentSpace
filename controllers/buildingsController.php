<?php
require_once __DIR__ . '/../models/buildingsModel.php';

class BuildingsController {
    private $model;

    public function __construct($db) {
        $this->model = new BuildingsModel($db);
    }

    public function listBuildings() {
        try {
            $buildings = $this->model->getAll();
            require __DIR__ . '/../views/buildings/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    public function addBuildingView() {
        try {
            $locations = $this->model->getAllLocations(); // Pobranie miejscowości z tabeli `locations`
            require __DIR__ . '/../views/buildings/add_building.php'; // Przekazanie do widoku
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }


    public function saveBuilding($data) {
        try {
            // Sprawdź, czy użytkownik wybrał istniejącą miejscowość, czy wpisał nową
            if (empty($data['location_id']) && empty($data['new_city'])) {
                header('Location: ../index.php?view=add_building&error=empty_location');
                exit();
            }

            if (!empty($data['new_city'])) {
                // Dodaj nową miejscowość do tabeli `locations`
                $location_id = $this->model->addLocation([
                    'city' => $data['new_city'],
                    'postal_code' => $data['new_postal_code'] ?? null
                ]);
            } else {
                // Użyj istniejącej miejscowości
                $location_id = $data['location_id'];
            }

            // Walidacja pozostałych pól
            if (empty($location_id) || empty($data['street']) || empty($data['building_number']) || empty($data['total_floors']) || empty($data['common_cost'])) {
                header('Location: ../index.php?view=add_building&error=empty_fields');
                exit();
            }

            // Zapisz budynek do bazy danych
            $this->model->save([
                'location_id' => $location_id,
                'street' => $data['street'],
                'building_number' => $data['building_number'],
                'total_floors' => $data['total_floors'],
                'common_cost' => $data['common_cost']
            ]);

            header('Location: ../index.php?view=buildings&success=building_added');
        } catch (Exception $e) {
            header('Location: ../index.php?view=add_building&error=' . urlencode($e->getMessage()));
        }
    }

}
