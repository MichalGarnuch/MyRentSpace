<?php
// Import modelu PaymentsModel do obsługi danych o płatnościach
require_once __DIR__ . '/../models/paymentsModel.php';

class PaymentsController {
    private $model;

    // Konstruktor tworzy instancję modelu PaymentsModel z połączeniem do bazy
    public function __construct($db) {
        $this->model = new PaymentsModel($db);
    }

    // Wyświetla listę płatności
    public function listPayments() {
        try {
            $payments = $this->model->getAll();
            require __DIR__ . '/../views/payments/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania płatności, pobiera umowy najmu
    public function addPaymentView() {
        try {
            $agreements = $this->model->getAllAgreements();
            require __DIR__ . '/../views/payments/add_payment.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Zapisuje nową płatność w bazie po walidacji danych
    public function savePayment($data) {
        try {
            if (empty($data['rental_agreement_id']) || empty($data['payment_date']) || empty($data['amount']) || empty($data['type']) || empty($data['status'])) {
                header('Location: index.php?view=add_payment&error=empty_fields');
                exit();
            }

            $this->model->save([
                'rental_agreement_id' => $data['rental_agreement_id'],
                'payment_date' => $data['payment_date'],
                'amount' => $data['amount'],
                'type' => $data['type'],
                'status' => $data['status']
            ]);

            header('Location: index.php?view=add_payment&success=payment_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_payment&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
