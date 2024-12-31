<?php
// Import modelu ApartmentsModel, który obsługuje dane z bazy dotyczące mieszkań
require_once __DIR__ . '/../models/apartmentsModel.php';

// Klasa ApartmentsController obsługuje logikę biznesową dotyczącą mieszkań.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class ApartmentsController {
    // Prywatna zmienna $model przechowuje instancję modelu ApartmentsModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu ApartmentsModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new ApartmentsModel($db); // Inicjalizacja modelu
    }

    // Funkcja listApartments: Wyświetla listę mieszkań.
    // 1. Pobiera dane mieszkań z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/apartments`.
    public function listApartments() {
        try {
            $apartments = $this->model->getAll(); // Pobranie danych o mieszkaniach z modelu
            require __DIR__ . '/../views/apartments/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addApartmentView: Wyświetla formularz dodawania nowego mieszkania.
    // 1. Pobiera listę budynków z tabeli `buildings` za pomocą metody `getAllBuildings` w modelu.
    // 2. Przekazuje te dane do widoku `add_apartment.php` w katalogu `views/apartments`.
    public function addApartmentView() {
        try {
            $locations = $this->model->getAllLocations(); // Pobranie lokalizacji
            $buildings = $this->model->getAllBuildings(); // Pobranie listy budynków z modelu
            require __DIR__ . '/../views/apartments/add_apartment.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja saveApartment: Obsługuje zapis nowego mieszkania do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Przekazuje dane do modelu `save` w celu zapisania mieszkania w tabeli `apartments`.
    // 3. Przekierowuje na formularz dodawania mieszkania z komunikatem o sukcesie lub błędzie.
    public function saveApartment($data) {
        try {
            // Walidacja: Sprawdzenie, czy wszystkie pola wymagane są wypełnione.
            if (empty($data['apartment_number']) || empty($data['floor_number']) || empty($data['size_sqm']) || empty($data['status']) || empty($data['building_id'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_apartment&error=empty_fields');
                exit();
            }

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

            // Przekazanie danych do modelu w celu zapisania mieszkania w tabeli `apartments`.
            $this->model->save([
                'apartment_number' => $data['apartment_number'],
                'floor_number' => $data['floor_number'],
                'size_sqm' => $data['size_sqm'],
                'status' => $data['status'],
                'building_id' => $data['building_id'],
                'location_id' => $location_id // Przekazanie ID lokalizacji
            ]);

            // Przekierowanie na formularz dodawania mieszkania z komunikatem o sukcesie.
            header('Location: index.php?view=add_apartment&success=apartment_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_apartment&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
