<!DOCTYPE html>
<html lang="pl"> <!-- Określenie języka dokumentu na polski -->
<head>
    <meta charset="UTF-8"> <!-- Ustawienie kodowania znaków na UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Zapewnienie responsywności strony -->
    <title>MyRentSpace</title> <!-- Tytuł strony widoczny w przeglądarce -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Własne style -->
    <link href="assets/custom.css" rel="stylesheet"> <!-- Podłączenie niestandardowych stylów CSS -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Własne skrypty -->
    <script src="assets/custom.js"></script> <!-- Podłączenie niestandardowych skryptów JS -->
</head>
<body>
<?php include 'partials/header.php'; ?> <!-- Dołączenie nagłówka strony -->
<?php include 'partials/menu.php'; ?> <!-- Dołączenie menu nawigacyjnego -->
<div class="container mt-4"> <!-- Kontener Bootstrap dla głównej treści -->
    <?php
    // Obsługa błędów PHP (na czas debugowania)
    ini_set('display_errors', 1); // Włączanie wyświetlania błędów
    ini_set('display_startup_errors', 1); // Włączanie wyświetlania błędów startowych
    error_reporting(E_ALL); // Wyświetlanie wszystkich poziomów błędów

    // Obsługa routingu
    $view = $_GET['view'] ?? 'home'; // Ustawienie domyślnej wartości 'home', jeśli brak parametru 'view'
    $action = $_GET['action'] ?? null; // Pobieranie parametru akcji

    // Ładowanie odpowiednich widoków na podstawie wartości 'view'
    switch ($view) {
        case 'buildings':
            include 'views/buildings.php';
            break;
        case 'add_building':
            include 'views/add_building.php'; // Widok formularza dodawania budynku
            break;
        case 'add_apartment':
            include 'views/add_apartment.php';
            break;
        case 'apartments':
            include 'views/apartments.php'; // Widok mieszkań
            break;
        case 'save_apartment':
            include 'controllers/save_apartment.php';
            break;
        case 'add_tenant':
            include 'views/add_tenant.php';
            break;
        case 'tenants':
            include 'views/tenants.php'; // Widok najemców
            break;
        case 'save_tenant':
            include 'controllers/save_tenant.php';
            break;
        case 'add_owner':
            include 'views/add_owner.php';
            break;
        case 'owners':
            include 'views/owners.php'; // Widok właścicieli
            break;
        case 'save_owner':
            include 'controllers/save_owner.php';
            break;
        case 'add_agreement':
            include 'views/add_agreement.php';
            break;
        case 'agreements':
            include 'views/agreements.php'; // Widok umów najmu
            break;
        case 'save_agreement':
            include 'controllers/save_agreement.php';
            break;
        case 'add_payment':
            include 'views/add_payment.php';
            break;
        case 'payments':
            include 'views/payments.php'; // Widok płatności
            break;
        case 'save_payment':
            include 'controllers/save_payment.php';
            break;
        case 'add_media_usage':
            include 'views/add_media_usage.php';
            break;
        case 'media':
            include 'views/media.php'; // Widok zużycia mediów
            break;
        case 'save_media_usage':
            include 'controllers/save_media_usage.php';
            break;
        case 'add_maintenance':
            include 'views/add_maintenance.php';
            break;
        case 'maintenance':
            include 'views/maintenance.php'; // Widok zgłoszeń serwisowych
            break;
        case 'save_maintenance':
            include 'controllers/save_maintenance.php';
            break;
        case 'add_notification':
            include 'views/add_notification.php';
            break;
        case 'notifications':
            include 'views/notifications.php'; // Widok powiadomień
            break;
        case 'save_notification':
            include 'controllers/save_notification.php';
            break;
        default:
            include 'views/home.php'; // Widok domyślny
    }
    // Obsługa akcji (np. zapis budynku)
    if ($action === 'save_building') {
        include 'controllers/buildingsController.php'; // Kontroler budynków obsługuje zapis
    }
    ?>
</div>
<?php include 'partials/footer.php'; ?> <!-- Dołączenie stopki -->
<?php include 'views/login_modal.php'; ?> <!-- Dołączenie modala logowania -->
</body>
</html>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `index.php` to główny plik odpowiadający za routing aplikacji.-->
<!--- Routing odbywa się poprzez parametr `view` przekazywany w adresie URL.-->
<!--- Wyświetlane są dynamicznie ładowane widoki i kontrolery zgodnie z wartością `view`.-->
<!--- Domyślny widok: `home.php`.-->
<!--- Debugowanie włączone za pomocą `ini_set` i `error_reporting`.-->
<!--*/-->
