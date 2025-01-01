<?php
// Import modelu OwnersModel, który obsługuje dane z bazy dotyczące właścicieli
require_once __DIR__ . '/../models/ownersModel.php';

// Klasa OwnersController obsługuje logikę biznesową dotyczącą właścicieli.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class OwnersController {
    // Prywatna zmienna $model przechowuje instancję modelu OwnersModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu OwnersModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new OwnersModel($db); // Inicjalizacja modelu
    }

    // Funkcja listOwners: Wyświetla listę właścicieli.
    // 1. Pobiera dane właścicieli z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/owners`.
    public function listOwners() {
        try {
            $owners = $this->model->getAll(); // Pobranie danych o właścicielach z modelu
            require __DIR__ . '/../views/owners/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addOwnerView: Wyświetla formularz dodawania nowego właściciela.
    // 1. Przekazuje dane do widoku `add_owner.php` w katalogu `views/owners`.
    public function addOwnerView() {
        try {
            require __DIR__ . '/../views/owners/add_owner.php'; // Wyświetlenie formularza
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja saveOwner: Obsługuje zapis nowego właściciela do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Przekazuje dane do modelu `save` w celu zapisania właściciela w tabeli `owners`.
    // 3. Przekierowuje na formularz dodawania właściciela z komunikatem o sukcesie lub błędzie.
    public function saveOwner($data) {
        try {
            // Walidacja: Sprawdzenie, czy wszystkie pola wymagane są wypełnione.
            if (empty($data['first_name']) || empty($data['last_name']) || empty($data['phone']) || empty($data['email']) || empty($data['commission_rate'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_owner&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisania właściciela w tabeli `owners`.
            $this->model->save([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'commission_rate' => $data['commission_rate']
            ]);

            // Przekierowanie na formularz dodawania właściciela z komunikatem o sukcesie.
            header('Location: index.php?view=add_owner&success=owner_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_owner&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
