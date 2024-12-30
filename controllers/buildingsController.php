<?php
// buildingsController.php
// Kontroler obsługujący logikę dla budynków.
// Odpowiada za komunikację między widokami a modelem budynków.

class BuildingsController {
    private $model; // Instancja modelu BuildingModel

    // Konstruktor przyjmujący połączenie z bazą danych
    public function __construct($db) {
        $this->model = new BuildingModel($db);
    }

    // Funkcja do zapisu nowego budynku
    // Parametry:
    // - $data (array): Dane wejściowe dla nowego budynku
    // Zwraca:
    // - bool: true w przypadku sukcesu, exception w przypadku błędu
    public function saveBuilding($data) {
        try {
            return $this->model->save($data); // Wywołanie metody zapisu z modelu
        } catch (Exception $e) {
            throw new Exception("Błąd zapisu budynku: " . $e->getMessage()); // Obsługa błędu
        }
    }
}

?>
