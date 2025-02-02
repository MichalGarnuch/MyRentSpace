<?php
// Importuje model TenantsModel
require_once __DIR__ . '/../models/tenantsModel.php';

// Klasa obsługująca logikę biznesową najemców
class TenantsController {
    private $model; // Instancja modelu

    // Konstruktor inicjalizujący model
    public function __construct($db) {
        $this->model = new TenantsModel($db);
    }

    // Wyświetla listę najemców
    public function listTenants() {
        try {
            $tenants = $this->model->getAll(); // Pobiera dane
            require __DIR__ . '/../views/tenants/list.php'; // Przekazuje dane do widoku
        } catch (Exception $e) {
            // Obsługuje błędy
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania nowego najemcy
    public function addTenantView() {
        try {
            require __DIR__ . '/../views/tenants/add_tenant.php'; // Formularz
        } catch (Exception $e) {
            // Obsługuje błędy
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nowego najemcę do bazy danych
    public function saveTenant($data) {
        try {
            // Walidacja danych
            if (empty($data['first_name']) || empty($data['last_name']) || empty($data['phone']) || empty($data['email'])) {
                header('Location: index.php?view=add_tenant&error=empty_fields');
                exit();
            }

            // Zapis do modelu
            $this->model->save([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email']
            ]);

            // Przekierowanie po sukcesie
            header('Location: index.php?view=add_tenant&success=tenant_added');
            exit();
        } catch (Exception $e) {
            // Obsługuje błędy
            header('Location: index.php?view=add_tenant&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
