<?php
require_once 'helpers/functions.php'; // Załadowanie funkcji pomocniczych
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Rozpoczyna sesję, jeśli jeszcze nie jest aktywna
}

error_reporting(E_ALL); // Włączenie raportowania błędów
ini_set('display_errors', 1); // Ustawienie wyświetlania błędów na stronie
?>

<?php
// Sprawdzenie, czy użytkownik zalogował się pomyślnie
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success text-center" id="login-success" role="alert">
            ✅ Zalogowano pomyślnie!
          </div>';
}
?>

<?php
// Komunikat po wylogowaniu
if (isset($_GET['logout'])) {
    echo '<div class="alert alert-info text-center" id="logout-message">
            ℹ️ Wylogowano pomyślnie
          </div>';
}
?>

<script>
    // Ukrywanie komunikatu o logowaniu po 5 sekundach
    setTimeout(() => {
        const alert = document.getElementById('login-success');
        if (alert) alert.style.display = 'none';
    }, 5000);
</script>

<?php
ob_start(); // Włączenie buforowania wyjścia
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Metadane strony -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRentSpace</title>

    <!-- Łączenie stylów i skryptów -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/custom.css" rel="stylesheet"> <!-- Własny arkusz stylów -->

    <!-- Łączenie skryptów -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/custom.js"></script> <!-- Własny skrypt -->
</head>
<body>
<div class="overlay"></div> <!-- Warstwa przyciemnienia -->
<?php include 'partials/header.php'; ?> <!-- Włączenie nagłówka -->
<?php include 'partials/menu.php'; ?> <!-- Włączenie menu nawigacyjnego -->

<div class="container mt-4">
    <?php
    // Wczytanie połączenia z bazą danych oraz kontrolerów
    require_once 'config/db.php'; // Połączenie z bazą
    require_once 'controllers/agreementsController.php'; // Kontroler dla umów
    require_once 'controllers/buildingsController.php'; // Kontroler dla budynków
    require_once 'controllers/apartmentsController.php'; // Kontroler dla mieszkań
    require_once 'controllers/tenantsController.php'; // Kontroler dla najemców
    require_once 'controllers/ownersController.php'; // Kontroler dla właścicieli
    require_once 'controllers/paymentsController.php'; // Kontroler dla płatności
    require_once 'controllers/mediaController.php'; // Kontroler dla mediów
    require_once 'controllers/maintenanceController.php'; // Kontroler dla serwisów
    require_once 'controllers/notificationsController.php'; // Kontroler dla powiadomień

    // Obsługa routingu (sprawdzanie akcji i widoków)
    $view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'home'; // Domyślny widok
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS); // Sprawdzanie akcji

    // Inicjalizacja kontrolerów
    $agreementsController = new AgreementsController($conn);
    $buildingsController = new BuildingsController($conn);
    $apartmentsController = new ApartmentsController($conn);
    $tenantsController = new TenantsController($conn);
    $ownersController = new OwnersController($conn);
    $paymentsController = new PaymentsController($conn);
    $mediaController = new MediaController($conn);
    $maintenanceController = new MaintenanceController($conn);
    $notificationsController = new NotificationsController($conn); // Kontroler powiadomień

    // Obsługa akcji i widoków
    try {
        if ($action) {
            // Obsługa akcji (np. zapisywanie danych)
            switch ($action) {
                case 'save_agreement':
                    $agreementsController->saveAgreement($_POST);
                    break;
                case 'save_building':
                    $buildingsController->saveBuilding($_POST);
                    break;
                case 'save_apartment':
                    $apartmentsController->saveApartment($_POST);
                    break;
                case 'save_tenant':
                    $tenantsController->saveTenant($_POST);
                    break;
                case 'save_owner':
                    $ownersController->saveOwner($_POST);
                    break;
                case 'save_payment':
                    $paymentsController->savePayment($_POST);
                    break;
                case 'save_media_usage':
                    $mediaController->saveMediaUsage($_POST);
                    break;
                case 'save_maintenance':
                    $maintenanceController->saveMaintenance($_POST);
                    break;
                case 'save_notification': // Obsługa zapisu powiadomienia
                    $notificationsController->saveNotification($_POST);
                    break;
                default:
                    throw new Exception("Nieznana akcja: $action");
            }
        } else {
            // Obsługa widoków (np. wyświetlanie list)
            switch ($view) {
                case 'agreements':
                    $agreementsController->listAgreements();
                    break;
                case 'add_agreement':
                    $agreementsController->addAgreementView();
                    break;
                case 'buildings':
                    $buildingsController->listBuildings();
                    break;
                case 'add_building':
                    $buildingsController->addBuildingView();
                    break;
                case 'apartments':
                    $apartmentsController->listApartments();
                    break;
                case 'add_apartment':
                    $apartmentsController->addApartmentView();
                    break;
                case 'tenants':
                    $tenantsController->listTenants();
                    break;
                case 'add_tenant':
                    $tenantsController->addTenantView();
                    break;
                case 'owners':
                    $ownersController->listOwners();
                    break;
                case 'add_owner':
                    $ownersController->addOwnerView();
                    break;
                case 'payments':
                    $paymentsController->listPayments();
                    break;
                case 'add_payment':
                    $paymentsController->addPaymentView();
                    break;
                case 'media':
                    $mediaController->listMediaUsage();
                    break;
                case 'add_media_usage':
                    $mediaController->addMediaUsageView();
                    break;
                case 'maintenance':
                    $maintenanceController->listMaintenance();
                    break;
                case 'add_maintenance':
                    $maintenanceController->addMaintenanceView();
                    break;
                case 'notifications': // Widok listy powiadomień
                    $notificationsController->listNotifications();
                    break;
                case 'add_notification': // Widok formularza dodawania powiadomienia
                    $notificationsController->addNotificationView();
                    break;
                default:
                    include 'views/home.php'; // Domyślny widok
            }
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>"; // Obsługa błędów
    }
    ?>
</div>

<?php include 'partials/footer.php'; ?> <!-- Stopka -->
<?php include 'views/login_modal.php'; ?> <!-- Modal logowania -->
</body>
</html>

<?php
ob_end_flush(); // Zakończenie buforowania
?>
