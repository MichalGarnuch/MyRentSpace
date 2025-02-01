<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success text-center" id="login-success" role="alert">
            ✅ Zalogowano pomyślnie!
          </div>';
}
?>
<?php
if (isset($_GET['logout'])) {
    echo '<div class="alert alert-info text-center" id="logout-message">
            ℹ️ Wylogowano pomyślnie
          </div>';
}
?>

<script>
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

    <!-- Łączenie stylów Bootstrap i własnych -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/custom.css" rel="stylesheet">

    <!-- Łączenie skryptów Bootstrap i własnych -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/custom.js"></script>
</head>
<body>
<?php include 'partials/header.php'; ?> <!-- Włączenie nagłówka strony -->
<?php include 'partials/menu.php'; ?> <!-- Włączenie menu nawigacyjnego -->

<div class="container mt-4">
    <?php
    // Ustawienia debugowania
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Wczytywanie połączenia z bazą danych oraz kontrolerów
    require_once 'config/db.php';
    require_once 'controllers/agreementsController.php';
    require_once 'controllers/buildingsController.php';
    require_once 'controllers/apartmentsController.php';
    require_once 'controllers/tenantsController.php';
    require_once 'controllers/ownersController.php';
    require_once 'controllers/paymentsController.php';
    require_once 'controllers/mediaController.php';
    require_once 'controllers/maintenanceController.php';
    require_once 'controllers/notificationsController.php'; // Dodano kontroler powiadomień

    // Obsługa routingu
    $view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'home';
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    // Inicjalizacja kontrolerów
    $agreementsController = new AgreementsController($conn);
    $buildingsController = new BuildingsController($conn);
    $apartmentsController = new ApartmentsController($conn);
    $tenantsController = new TenantsController($conn);
    $ownersController = new OwnersController($conn);
    $paymentsController = new PaymentsController($conn);
    $mediaController = new MediaController($conn);
    $maintenanceController = new MaintenanceController($conn);
    $notificationsController = new NotificationsController($conn); // Inicjalizacja kontrolera powiadomień

    // Obsługa akcji i widoków
    try {
        if ($action) {
            // Obsługa akcji
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
            // Obsługa widoków
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
                    include 'views/home.php';
            }
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    ?>
</div>

<?php include 'partials/footer.php'; ?> <!-- Włączenie stopki -->
<?php include 'views/login_modal.php'; ?> <!-- Włączenie modala logowania -->
</body>
</html>
<?php
ob_end_flush(); // Wysłanie buforowanej zawartości
?>
