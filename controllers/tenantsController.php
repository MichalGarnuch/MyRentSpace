<?php
// Import modelu TenantsModel, który obsługuje dane z bazy dotyczące najemców
require_once __DIR__ . '/../models/tenantsModel.php';

// Klasa TenantsController obsługuje logikę biznesową dotyczącą najemców.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class TenantsController {
    // Prywatna zmienna $model przechowuje instancję modelu TenantsModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu TenantsModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new TenantsModel($db); // Inicjalizacja modelu
    }

    // Funkcja listTenants: Wyświetla listę najemców.
    // 1. Pobiera dane najemców z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/tenants`.
    public function listTenants() {
        try {
            $tenants = $this->model->getAll(); // Pobranie danych o najemcach z modelu
            require __DIR__ . '/../views/tenants/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addTenantView: Wyświetla formularz dodawania nowego najemcy.
    // 1. Przekazuje dane do widoku `add_tenant.php` w katalogu `views/tenants`.
    public function addTenantView() {
        try {
            require __DIR__ . '/../views/tenants/add_tenant.php'; // Wyświetlenie formularza
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja saveTenant: Obsługuje zapis nowego najemcy do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Przekazuje dane do modelu `save` w celu zapisania najemcy w tabeli `tenants`.
    // 3. Przekierowuje na formularz dodawania najemcy z komunikatem o sukcesie lub błędzie.
    public function saveTenant($data) {
        try {
            // Walidacja: Sprawdzenie, czy wszystkie pola wymagane są wypełnione.
            if (empty($data['first_name']) || empty($data['last_name']) || empty($data['phone']) || empty($data['email'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_tenant&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisania najemcy w tabeli `tenants`.
            $this->model->save([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email']
            ]);

            // Przekierowanie na formularz dodawania najemcy z komunikatem o sukcesie.
            header('Location: index.php?view=add_tenant&success=tenant_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_tenant&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
