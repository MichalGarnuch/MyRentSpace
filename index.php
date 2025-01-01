<?php
ob_start(); // Włączenie buforowania wyjścia, aby zapobiec wysyłaniu danych przed funkcją header().
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Metadane strony -->
    <meta charset="UTF-8"> <!-- Kodowanie znaków -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Skalowanie dla urządzeń mobilnych -->
    <title>MyRentSpace</title> <!-- Tytuł strony -->

    <!-- Łączenie stylów Bootstrap i własnych -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link href="assets/custom.css" rel="stylesheet"> <!-- Własny plik CSS -->

    <!-- Łączenie skryptów Bootstrap i własnych -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
    <script src="assets/custom.js"></script> <!-- Własny plik JS -->
</head>
<body>
<?php include 'partials/header.php'; ?> <!-- Włączenie nagłówka strony -->
<?php include 'partials/menu.php'; ?> <!-- Włączenie menu nawigacyjnego -->

<div class="container mt-4">
    <?php
    // Ustawienia debugowania (pokazywanie błędów na stronie)
    ini_set('display_errors', 1); // Włączanie wyświetlania błędów
    ini_set('display_startup_errors', 1); // Włączanie błędów startowych
    error_reporting(E_ALL); // Wyświetlanie wszystkich poziomów błędów

    // Wczytywanie połączenia z bazą danych oraz kontrolerów
    require_once 'config/db.php'; // Łączenie z bazą danych
    require_once 'controllers/agreementsController.php'; // Kontroler obsługujący umowy najmu
    require_once 'controllers/buildingsController.php'; // Kontroler obsługujący budynki
    require_once 'controllers/apartmentsController.php'; // Kontroler obsługujący mieszkania
    require_once 'controllers/tenantsController.php'; // Kontroler obsługujący najemców
    require_once 'controllers/ownersController.php'; // Kontroler obsługujący właścicieli

    // Obsługa routingu:
    // Pobranie wartości `view` (widok) i `action` (akcja) z URL
    $view = filter_input(INPUT_GET, 'view', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'home'; // Widok domyślny to "home"
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS); // Akcja (np. zapis danych)

    // Inicjalizacja kontrolerów
    $agreementsController = new AgreementsController($conn); // Inicjalizacja kontrolera umów
    $buildingsController = new BuildingsController($conn); // Inicjalizacja kontrolera budynków
    $apartmentsController = new ApartmentsController($conn); // Inicjalizacja kontrolera mieszkań
    $tenantsController = new TenantsController($conn); // Inicjalizacja kontrolera najemców
    $ownersController = new OwnersController($conn); // Inicjalizacja kontrolera właścicieli

    // Obsługa akcji (np. zapis danych do bazy)
    try {
        if ($action) {
            // Sprawdzanie, jaka akcja została wywołana
            switch ($action) {
                case 'save_agreement':
                    $agreementsController->saveAgreement($_POST); // Zapis nowej umowy
                    break;
                case 'save_building':
                    $buildingsController->saveBuilding($_POST); // Zapis nowego budynku
                    break;
                case 'save_apartment':
                    $apartmentsController->saveApartment($_POST); // Zapis nowego mieszkania
                    break;
                    case 'save_tenant':
                $tenantsController->saveTenant($_POST); // Zapis nowego najemcy
                    break;
                case 'save_owner':
                    $ownersController->saveOwner($_POST); // Zapis nowego właściciela
                    break;
                default:
                    throw new Exception("Nieznana akcja: $action"); // Obsługa nieznanej akcji
            }
        } else {
            // Obsługa widoków (np. lista budynków, formularz dodawania)
            switch ($view) {
                case 'agreements':
                    $agreementsController->listAgreements(); // Wyświetlenie listy umów najmu
                    break;
                case 'add_agreement':
                    $agreementsController->addAgreementView(); // Formularz dodawania nowej umowy najmu
                    break;
                case 'buildings':
                    $buildingsController->listBuildings(); // Wyświetlenie listy budynków
                    break;
                case 'add_building':
                    $buildingsController->addBuildingView(); // Formularz dodawania nowego budynku
                    break;
                case 'apartments':
                    $apartmentsController->listApartments(); // Wyświetlenie listy mieszkań
                    break;
                case 'add_apartment':
                    $apartmentsController->addApartmentView(); // Formularz dodawania nowego mieszkania
                    break;
                case 'tenants':
                    $tenantsController->listTenants(); // Wyświetlenie listy najemców
                    break;
                case 'add_tenant':
                    $tenantsController->addTenantView(); // Formularz dodawania nowego najemcy
                    break;
                case 'owners':
                    $ownersController->listOwners(); // Wyświetlenie listy właścicieli
                    break;
                case 'add_owner':
                    $ownersController->addOwnerView(); // Formularz dodawania nowego właściciela
                    break;
                default:
                    include 'views/home.php'; // Widok domyślny (np. strona główna)
            }
        }
    } catch (Exception $e) {
        // Wyświetlanie błędu w przypadku wyjątku
        echo "<div class='alert alert-danger'>Błąd: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    ?>
</div>

<?php include 'partials/footer.php'; ?> <!-- Włączenie stopki -->
<?php include 'views/login_modal.php'; ?> <!-- Włączenie modala logowania -->
</body>
</html>
<?php
ob_end_flush(); // Wysłanie buforowanej zawartości do przeglądarki (koniec buforowania)
?>
