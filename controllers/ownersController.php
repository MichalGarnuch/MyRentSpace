<?php
// Import modelu OwnersModel do obsługi danych o właścicielach
require_once __DIR__ . '/../models/ownersModel.php';

class OwnersController {
    private $model;

    // Konstruktor tworzy instancję modelu OwnersModel z połączeniem do bazy
    public function __construct($db) {
        $this->model = new OwnersModel($db);
    }

    // Wyświetla listę właścicieli
    public function listOwners() {
        try {
            $owners = $this->model->getAll();
            require __DIR__ . '/../views/owners/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania właściciela
    public function addOwnerView() {
        try {
            require __DIR__ . '/../views/owners/add_owner.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nowego właściciela w bazie po walidacji danych
    public function saveOwner($data) {
        try {
            if (empty($data['first_name']) || empty($data['last_name']) || empty($data['phone']) || empty($data['email']) || empty($data['commission_rate'])) {
                header('Location: index.php?view=add_owner&error=empty_fields');
                exit();
            }

            $this->model->save([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'commission_rate' => $data['commission_rate']
            ]);

            header('Location: index.php?view=add_owner&success=owner_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_owner&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
