<?php
// Import modelu PaymentsModel, który obsługuje dane z bazy dotyczące płatności
require_once __DIR__ . '/../models/paymentsModel.php';

// Klasa PaymentsController obsługuje logikę biznesową dotyczącą płatności.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class PaymentsController {
    // Prywatna zmienna $model przechowuje instancję modelu PaymentsModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu PaymentsModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new PaymentsModel($db); // Inicjalizacja modelu
    }

    // Funkcja listPayments: Wyświetla listę płatności.
    // 1. Pobiera dane płatności z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/payments`.
    public function listPayments() {
        try {
            $payments = $this->model->getAll(); // Pobranie danych o płatnościach z modelu
            require __DIR__ . '/../views/payments/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addPaymentView: Wyświetla formularz dodawania nowej płatności.
    // 1. Pobiera listę umów najmu za pomocą metody `getAllAgreements` w modelu.
    // 2. Przekazuje te dane do widoku `add_payment.php` w katalogu `views/payments`.
    public function addPaymentView() {
        try {
            $agreements = $this->model->getAllAgreements(); // Pobranie listy umów z modelu
            require __DIR__ . '/../views/payments/add_payment.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja savePayment: Obsługuje zapis nowej płatności do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Przekazuje dane do modelu `save` w celu zapisania płatności w tabeli `rent_payments`.
    // 3. Przekierowuje na formularz dodawania płatności z komunikatem o sukcesie lub błędzie.
    public function savePayment($data) {
        try {
            // Walidacja: Sprawdzenie, czy wszystkie wymagane pola są wypełnione.
            if (empty($data['rental_agreement_id']) || empty($data['payment_date']) || empty($data['amount']) || empty($data['type']) || empty($data['status'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_payment&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisania płatności.
            $this->model->save([
                'rental_agreement_id' => $data['rental_agreement_id'],
                'payment_date' => $data['payment_date'],
                'amount' => $data['amount'],
                'type' => $data['type'],
                'status' => $data['status']
            ]);

            // Przekierowanie na formularz dodawania płatności z komunikatem o sukcesie.
            header('Location: index.php?view=add_payment&success=payment_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_payment&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
