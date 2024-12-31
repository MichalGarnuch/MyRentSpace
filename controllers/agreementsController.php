<?php
require_once __DIR__ . '/../models/agreementsModel.php';

class AgreementsController {
    private $model;

    public function __construct($db) {
        $this->model = new AgreementsModel($db);
    }

    public function listAgreements() {
        try {
            $agreements = $this->model->getAll();
            require __DIR__ . '/../views/agreements/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja do zapisywania nowej umowy
    public function saveAgreement($data) {
        try {
            if (empty($data['apartment_id']) || empty($data['tenant_id']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['rent_amount'])) {
                header('Location: ../index.php?view=add_agreement&error=empty_fields');
                exit();
            }

            $this->model->save($data);
            header('Location: ../index.php?view=agreements&success=agreement_added');
        } catch (Exception $e) {
            header('Location: ../index.php?view=add_agreement&error=' . urlencode($e->getMessage()));
        }
    }
}
