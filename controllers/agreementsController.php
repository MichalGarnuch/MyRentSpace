<?php
// Import modelu AgreementsModel, który obsługuje dane z bazy dotyczące umów najmu
require_once __DIR__ . '/../models/agreementsModel.php';

// Klasa AgreementsController obsługuje logikę biznesową dotyczącą umów najmu.
// Kontroler łączy dane z modelu i przekazuje je do widoków.
class AgreementsController {
    // Prywatna zmienna $model przechowuje instancję modelu AgreementsModel.
    private $model;

    // Konstruktor klasy, który tworzy instancję modelu AgreementsModel i przekazuje połączenie z bazą ($db).
    public function __construct($db) {
        $this->model = new AgreementsModel($db); // Inicjalizacja modelu
    }

    // Funkcja listAgreements: Wyświetla listę umów najmu.
    // 1. Pobiera dane umów z modelu (getAll).
    // 2. Przekazuje dane do widoku `list.php` w katalogu `views/agreements`.
    public function listAgreements() {
        try {
            $agreements = $this->model->getAll(); // Pobranie danych o umowach z modelu
            require __DIR__ . '/../views/agreements/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja addAgreementView: Wyświetla formularz dodawania nowej umowy najmu.
    // 1. Pobiera dane mieszkań i najemców z tabel `apartments` i `tenants`.
    // 2. Przekazuje dane do widoku `add_agreement.php` w katalogu `views/agreements`.
    public function addAgreementView() {
        try {
            $apartments = $this->model->getAllApartments(); // Pobranie listy mieszkań z modelu
            $tenants = $this->model->getAllTenants(); // Pobranie listy najemców z modelu
            $owners = $this->model->getAllOwners(); // Pobranie właścicieli
            require __DIR__ . '/../views/agreements/add_agreement.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie na widok błędu z odpowiednim komunikatem.
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Funkcja saveAgreement: Obsługuje zapis nowej umowy najmu do bazy danych.
    // 1. Waliduje dane z formularza.
    // 2. Przekazuje dane do modelu `save` w celu zapisania umowy w tabeli `rental_agreements`.
    // 3. Przekierowuje na formularz dodawania umowy z komunikatem o sukcesie lub błędzie.
    public function saveAgreement($data) {
        try {
            // Walidacja: Sprawdzenie, czy wszystkie pola wymagane są wypełnione.
            if (empty($data['apartment_id']) || empty($data['tenant_id']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['rent_amount'])) {
                // Przekierowanie na formularz z komunikatem o błędzie.
                header('Location: index.php?view=add_agreement&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisania umowy w tabeli `rental_agreements`.
            $this->model->save([
                'apartment_id' => $data['apartment_id'],
                'tenant_id' => $data['tenant_id'],
                'owner_id' => $data['owner_id'], // Nowe pole dla właściciela
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'rent_amount' => $data['rent_amount'],
                'status' => $data['status'] ?? 'active' // Opcjonalny status, domyślnie "active"
            ]);

            // Przekierowanie na widok listy umów z komunikatem o sukcesie.
            header('Location: index.php?view=agreements&success=agreement_added');
            exit();
        } catch (Exception $e) {
            // Jeśli wystąpi błąd, przekierowanie z komunikatem o błędzie.
            header('Location: index.php?view=add_agreement&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
