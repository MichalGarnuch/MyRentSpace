<?php
// agreementsController.php
// Kontroler obsługujący logikę dla umów najmu.

require_once '../models/agreementsModel.php';

class AgreementsController {
    private $model; // Instancja modelu AgreementsModel

    public function __construct($db) {
        $this->model = new AgreementsModel($db);
    }

    // Funkcja do zapisu nowej umowy najmu
    // Parametry:
    // - $data (array): Dane wejściowe z formularza
    public function saveAgreement($data) {
        try {
            // Walidacja danych
            if (empty($data['apartment_id']) || empty($data['tenant_id']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['amount'])) {
                header('Location: ../index.php?view=add_agreement&error=empty_fields');
                exit();
            }

            // Zapis danych do modelu
            $this->model->save($data);
            header('Location: ../index.php?view=agreements&success=agreement_added');
        } catch (Exception $e) {
            header('Location: ../index.php?view=add_agreement&error=' . urlencode($e->getMessage()));
        }
    }
}

?>
