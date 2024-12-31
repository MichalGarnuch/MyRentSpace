<?php
require_once __DIR__ . '/../models/apartmentsModel.php';

class ApartmentsController {
    private $model;

    public function __construct($db) {
        $this->model = new ApartmentsModel($db);
    }

    // Wyświetlenie listy mieszkań
    public function listApartments() {
        try {
            $apartments = $this->model->getAll();
            require __DIR__ . '/../views/apartments/list.php';
        } catch (Exception $e) {
            header('Location: ../index.php?view=error&message=' . urlencode($e->getMessage()));
        }
    }

    // Dodanie nowego mieszkania
    public function addApartment($data) {
        try {
            if (empty($data['apartment_number']) || empty($data['floor_number']) || empty($data['size_sqm']) || empty($data['status']) || empty($data['building_id'])) {
                header('Location: ../index.php?view=add_apartment&error=empty_fields');
                exit();
            }

            $this->model->save($data);
            header('Location: ../index.php?view=apartments&success=apartment_added');
        } catch (Exception $e) {
            header('Location: ../index.php?view=add_apartment&error=' . urlencode($e->getMessage()));
        }
    }
}
