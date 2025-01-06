<?php
// Import modelu MediaModel, który obsługuje dane z bazy dotyczące zużycia mediów
require_once __DIR__ . '/../models/mediaModel.php';
// Import modelu ApartmentsModel, który obsługuje dane mieszkań
require_once __DIR__ . '/../models/apartmentsModel.php';

// Klasa MediaController obsługuje logikę biznesową dotyczącą zużycia mediów.
class MediaController {
    private $model; // Instancja MediaModel
    private $apartmentsModel; // Instancja ApartmentsModel

    // Konstruktor: Inicjalizacja modelu MediaModel oraz ApartmentsModel
    public function __construct($db) {
        $this->model = new MediaModel($db);
        $this->apartmentsModel = new ApartmentsModel($db);
    }

    // Wyświetla listę zużycia mediów
    public function listMediaUsage() {
        try {
            $mediaUsage = $this->model->getAll(); // Pobranie danych o zużyciu mediów
            require __DIR__ . '/../views/media/list.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            header('Location: index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania nowego odczytu zużycia mediów
    public function addMediaUsageView() {
        try {
            $apartments = $this->apartmentsModel->getAllApartments(); // Pobranie mieszkań z pełnym adresem
            $mediaTypes = $this->model->getAllMediaTypes(); // Pobranie dostępnych typów mediów
            $rentalAgreements = []; // Lista umów najmu ładowana dynamicznie w widoku
            require __DIR__ . '/../views/media/add_media_usage.php'; // Przekazanie danych do widoku
        } catch (Exception $e) {
            header('Location: index.php?view=error&message=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Obsługuje zapis nowego odczytu zużycia mediów do bazy danych
    public function saveMediaUsage($data) {
        try {
            // Walidacja: Sprawdzenie wymaganych pól
            if (empty($data['apartment_id']) || empty($data['media_type_id']) || empty($data['reading_date']) || empty($data['value'])) {
                header('Location: index.php?view=add_media_usage&error=empty_fields');
                exit();
            }

            // Przekazanie danych do modelu w celu zapisu
            $this->model->save([
                'apartment_id' => $data['apartment_id'],
                'media_type_id' => $data['media_type_id'],
                'rental_agreement_id' => $data['rental_agreement_id'] ?? null, // Opcjonalne
                'reading_date' => $data['reading_date'],
                'value' => $data['value'],
                'archived' => $data['archived'] ?? 0
            ]);

            header('Location: index.php?view=add_media_usage&success=media_usage_added');
            exit();
        } catch (Exception $e) {
            header('Location: index.php?view=add_media_usage&error=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Pobiera listę umów najmu dla konkretnego mieszkania (AJAX)
    public function getRentalAgreementsByApartment($apartmentId) {
        try {
            if (empty($apartmentId)) {
                throw new Exception("Nie podano ID mieszkania.");
            }

            $agreements = $this->model->getRentalAgreementsByApartment($apartmentId); // Pobranie umów najmu
            header('Content-Type: application/json');
            echo json_encode($agreements);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
}
