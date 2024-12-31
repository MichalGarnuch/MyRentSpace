<?php
// Import modelu BuildingsModel, który obsługuje dane z bazy dotyczące budynków
require_once __DIR__ . '/../models/buildingsModel.php';

// Klasa BuildingsController obsługuje logikę biznesową dotyczącą budynków.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class BuildingsController {
    // Prywatna zmienna $model przechowuje instancję modelu BuildingsModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu BuildingsModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new BuildingsModel($db); // Inicjalizacja modelu
    }

    // Funkcja listBuildings: Wyświetla listę budynków.
    // 1. Pobiera dane budynków z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/buildings`.
    public function listBuildings() {
        try {
            $buildings = $this->model->getAll(); // Pobranie danych o budynkach z modelu
            require __DIR__ . '/../views/buildings/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addBuildingView: Wyświetla formularz dodawania nowego budynku.
    // 1. Pobiera listę miejscowości z tabeli `locations` za pomocą metody `getAllLocations` w modelu.
    // 2. Przekazuje te dane do widoku `add_building.php` w katalogu `views/buildings`.
    public function addBuildingView() {
        try {
            $locations = $this->model->getAllLocations(); // Pobranie listy miejscowości z modelu
            require __DIR__ . '/../views/buildings/add_building.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja saveBuilding: Obsługuje zapis nowego budynku do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Obsługuje dodanie nowej miejscowości, jeśli użytkownik jej nie wybrał z listy.
    // 3. Przekazuje dane do modelu `save` w celu zapisania budynku w tabeli `buildings`.
    // 4. Przekierowuje na formularz dodawania budynku z komunikatem o sukcesie lub błędzie.
    public function saveBuilding($data) {
        try {
            // Walidacja: Sprawdzenie, czy użytkownik wybrał miejscowość lub podał nową.
            if (empty($data['location_id']) && empty($data['new_city'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_building&error=empty_location');
                exit();
            }

            // Obsługa nowej miejscowości: Jeśli użytkownik wpisał nową miejscowość.
            if (!empty($data['new_city'])) {
                // Dodanie nowej miejscowości do tabeli `locations` za pomocą modelu.
                $location_id = $this->model->addLocation([
                    'city' => $data['new_city'], // Nazwa miejscowości
                    'postal_code' => $data['new_postal_code'] ?? null // Opcjonalny kod pocztowy
                ]);
            } else {
                // Jeśli użytkownik wybrał istniejącą miejscowość, użyj jej ID.
                $location_id = $data['location_id'];
            }

            // Walidacja: Sprawdzenie, czy wszystkie pola wymagane są wypełnione.
            if (empty($location_id) || empty($data['street']) || empty($data['building_number']) || empty($data['total_floors']) || empty($data['common_cost'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_building&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisania budynku w tabeli `buildings`.
            $this->model->save([
                'location_id' => $location_id,
                'street' => $data['street'],
                'building_number' => $data['building_number'],
                'total_floors' => $data['total_floors'],
                'common_cost' => $data['common_cost']
            ]);

            // Przekierowanie na formularz dodawania budynku z komunikatem o sukcesie.
            header('Location: index.php?view=add_building&success=building_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_building&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
