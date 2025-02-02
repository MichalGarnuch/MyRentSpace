<?php
// Import modelu ApartmentsModel
require_once __DIR__ . '/../models/apartmentsModel.php';

class ApartmentsController {
    private $model;

    public function __construct($db) {
        $this->model = new ApartmentsModel($db); // Inicjalizacja modelu
    }

    // Wyświetla listę mieszkań
    public function listApartments() {
        try {
            $apartments = $this->model->getAll(); // Pobranie danych
            require __DIR__ . '/../views/apartments/list.php'; // Widok
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania mieszkania
    public function addApartmentView() {
        try {
            $locations = $this->model->getAllLocations(); // Pobranie lokalizacji
            $buildings = $this->model->getAllBuildings(); // Pobranie budynków
            require __DIR__ . '/../views/apartments/add_apartment.php'; // Formularz
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nowe mieszkanie
    public function saveApartment($data) {
        try {
            // Walidacja: Sprawdzanie wymaganych pól
            if (empty($data['apartment_number']) || empty($data['floor_number']) || empty($data['size_sqm']) || empty($data['status']) || empty($data['building_id'])) {
                header('Location: index.php?view=add_apartment&error=empty_fields');
                exit();
            }

            // Obsługuje nowe miasto i budynek, jeśli użytkownik podał
            if (!empty($data['new_city'])) {
                $location_id = $this->model->addLocation([
                    'city' => $data['new_city'],
                    'postal_code' => $data['new_postal_code']
                ]);
            } else {
                $location_id = $data['location_id'];
            }

            if (!empty($data['new_street']) && !empty($data['new_building_number'])) {
                $building_id = $this->model->addBuilding([
                    'location_id' => $location_id,
                    'street' => $data['new_street'],
                    'building_number' => $data['new_building_number']
                ]);
            } else {
                $building_id = $data['building_id'];
            }

            // Zapis do bazy
            $this->model->save([
                'apartment_number' => $data['apartment_number'],
                'floor_number' => $data['floor_number'],
                'size_sqm' => $data['size_sqm'],
                'status' => $data['status'],
                'building_id' => $building_id,
                'location_id' => $location_id
            ]);

            header('Location: index.php?view=add_apartment&success=apartment_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_apartment&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
