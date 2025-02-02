<?php
// Import modelu AgreementsModel
require_once __DIR__ . '/../models/agreementsModel.php';

class AgreementsController {
    private $model;

    public function __construct($db) {
        $this->model = new AgreementsModel($db); // Inicjalizacja modelu
    }

    // Wyświetla listę umów najmu
    public function listAgreements() {
        try {
            $agreements = $this->model->getAll(); // Pobranie danych o umowach
            require __DIR__ . '/../views/agreements/list.php'; // Widok
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania umowy najmu
    public function addAgreementView() {
        try {
            $apartments = $this->model->getAllApartments(); // Pobranie mieszkań
            $tenants = $this->model->getAllTenants(); // Pobranie najemców
            $owners = $this->model->getAllOwners(); // Pobranie właścicieli
            require __DIR__ . '/../views/agreements/add_agreement.php'; // Formularz
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nową umowę najmu
    public function saveAgreement($data) {
        try {
            // Walidacja: Sprawdzanie wymaganych pól
            if (empty($data['apartment_id']) || empty($data['tenant_id']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['rent_amount'])) {
                header('Location: index.php?view=add_agreement&error=empty_fields');
                exit();
            }

            // Zapis umowy w tabeli `rental_agreements`
            $this->model->save([
                'apartment_id' => $data['apartment_id'],
                'tenant_id' => $data['tenant_id'],
                'owner_id' => $data['owner_id'], // Nowe pole dla właściciela
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'rent_amount' => $data['rent_amount'],
                'status' => $data['status'] ?? 'active' // Opcjonalny status
            ]);

            header('Location: index.php?view=agreements&success=agreement_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_agreement&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
