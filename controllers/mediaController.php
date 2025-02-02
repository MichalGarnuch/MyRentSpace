<?php
// Import modelu MediaModel i ApartmentsModel
require_once __DIR__ . '/../models/mediaModel.php';
require_once __DIR__ . '/../models/apartmentsModel.php';

class MediaController {
    private $model; // Instancja MediaModel
    private $apartmentsModel; // Instancja ApartmentsModel

    // Konstruktor: Inicjalizacja modeli
    public function __construct($db) {
        $this->model = new MediaModel($db);
        $this->apartmentsModel = new ApartmentsModel($db);
    }

    // Wyświetla listę zużycia mediów
    public function listMediaUsage() {
        try {
            $mediaUsage = $this->model->getAll();
            require __DIR__ . '/../views/media/list.php';
        } catch (Exception $e) {
            header('Location: index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Wyświetla formularz dodawania odczytu zużycia mediów
    public function addMediaUsageView() {
        try {
            $apartments = $this->apartmentsModel->getAllApartments();
            $mediaTypes = $this->model->getAllMediaTypes();
            $rentalAgreements = [];
            require __DIR__ . '/../views/media/add_media_usage.php';
        } catch (Exception $e) {
            header('Location: index.php?view=error&message=' . urlencode($e->getMessage()));
            exit();
        }
    }

    // Zapisuje odczyt zużycia mediów do bazy
    public function saveMediaUsage($data) {
        try {
            if (empty($data['apartment_id']) || empty($data['media_type_id']) || empty($data['reading_date']) || empty($data['value'])) {
                header('Location: index.php?view=add_media_usage&error=empty_fields');
                exit();
            }

            $this->model->save([
                'apartment_id' => $data['apartment_id'],
                'media_type_id' => $data['media_type_id'],
                'rental_agreement_id' => $data['rental_agreement_id'] ?? null,
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

    // Pobiera umowy najmu dla mieszkania (AJAX)
    public function getRentalAgreementsByApartment($apartmentId) {
        try {
            if (empty($apartmentId)) {
                throw new Exception("Nie podano ID mieszkania.");
            }

            $agreements = $this->model->getRentalAgreementsByApartment($apartmentId);
            header('Content-Type: application/json');
            echo json_encode($agreements);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }
}
?>
