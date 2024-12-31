<?php
ob_start(); // Włączenie buforowania wyjścia
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRentSpace</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Własne style -->
    <link href="assets/custom.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Własne skrypty -->
    <script src="assets/custom.js"></script>
</head>
<body>
<?php include 'partials/header.php'; ?> <!-- Nagłówek strony -->
<?php include 'partials/menu.php'; ?> <!-- Menu nawigacyjne -->

<div class="container mt-4">
    <?php
    // Debugowanie
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Połączenie z bazą i załadowanie kontrolerów
    require_once 'config/db.php';
    require_once 'controllers/agreementsController.php';
    require_once 'controllers/buildingsController.php';
    require_once 'controllers/apartmentsController.php';

    // Obsługa routingu
    $view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'home';
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    // Inicjalizacja kontrolerów
    $agreementsController = new AgreementsController($conn);
    $buildingsController = new BuildingsController($conn);
    $apartmentsController = new ApartmentsController($conn);

    // Obsługa akcji
    try {
        if ($action) {
            switch ($action) {
                case 'save_agreement':
                    $agreementsController->saveAgreement($_POST);
                    break;
                case 'save_building':
                    $buildingsController->saveBuilding($_POST);
                    break;
                case 'save_apartment':
                    $apartmentsController->addApartment($_POST);
                    break;
                default:
                    throw new Exception("Nieznana akcja: $action");
            }
        } else {
            // Obsługa widoków
            switch ($view) {
                case 'agreements':
                    $agreementsController->listAgreements();
                    break;
                case 'add_agreement':
                    include __DIR__ . '/views/agreements/add_agreement.php';
                    break;
                case 'buildings':
                    $buildingsController->listBuildings();
                    break;
                case 'add_building': // Dodaj ten case
                    $buildingsController->addBuildingView(); // Wywołanie kontrolera
                    break;
                case 'apartments':
                    $apartmentsController->listApartments();
                    break;
                case 'add_apartment':
                    include __DIR__ . '/views/apartments/add_apartment.php';
                    break;
                default:
                    include 'views/home.php';
            }
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    ?>
</div>

<?php include 'partials/footer.php'; ?> <!-- Stopka -->
<?php include 'views/login_modal.php'; ?> <!-- Modal logowania -->
</body>
</html>
<?php
ob_end_flush(); // Wysłanie buforowanej zawartości do przeglądarki
?>
