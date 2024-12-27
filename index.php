<!DOCTYPE html>
<html lang="pl"> <!-- Zmieniono język na polski -->
<head>
    <meta charset="UTF-8"> <!-- Ustawienie kodowania znaków -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsywność strony -->
    <title>MyRentSpace</title> <!-- Tytuł strony -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Własne style -->
    <link href="assets/custom.css" rel="stylesheet"> <!-- Dodanie pliku z własnymi stylami -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Własne skrypty -->
    <script src="assets/custom.js"></script>
</head>
<body>
<?php include 'partials/header.php'; ?> <!-- Dołączenie nagłówka -->
<?php include 'partials/menu.php'; ?> <!-- Dołączenie menu -->
<div class="container mt-4"> <!-- Główna zawartość strony -->
    <?php
    // Obsługa błędów PHP (na czas debugowania)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Obsługa routingu
    $view = $_GET['view'] ?? 'home'; // Null coalescing operator (PHP >= 7.0)

    // Ładowanie odpowiednich widoków na podstawie wartości 'view'
    switch ($view) {
        case 'buildings':
            include 'views/buildings.php';
            break;
        case 'add_building':
            include 'views/add_building.php'; // Wczytanie widoku formularza dodawania budynku
            break;
        case 'add_apartment':
            include 'views/add_apartment.php';
            break;
        case 'apartments':
            include 'views/apartments.php'; // Zakładam, że widok mieszkań już istnieje
            break;
        case 'save_apartment':
            include 'controllers/save_apartment.php';
            break;
        case 'add_tenant':
            include 'views/add_tenant.php';
            break;
        case 'tenants':
            include 'views/tenants.php'; // Zakładam, że widok najemców już istnieje
            break;
        case 'save_tenant':
            include 'controllers/save_tenant.php';
            break;
        case 'add_owner':
            include 'views/add_owner.php';
            break;
        case 'owners':
            include 'views/owners.php'; // Zakładam, że widok właścicieli już istnieje
            break;
        case 'save_owner':
            include 'controllers/save_owner.php';
            break;
        case 'add_agreement':
            include 'views/add_agreement.php';
            break;
        case 'agreements':
            include 'views/agreements.php'; // Zakładam, że widok umów najmu już istnieje
            break;
        case 'save_agreement':
            include 'controllers/save_agreement.php';
            break;
        case 'add_payment':
            include 'views/add_payment.php';
            break;
        case 'payments':
            include 'views/payments.php'; // Zakładam, że widok płatności już istnieje
            break;
        case 'save_payment':
            include 'controllers/save_payment.php';
            break;
        case 'add_media_usage':
            include 'views/add_media_usage.php';
            break;
        case 'media':
            include 'views/media.php'; // Zakładam, że widok zużycia mediów już istnieje
            break;
        case 'save_media_usage':
            include 'controllers/save_media_usage.php';
            break;
        case 'add_maintenance':
            include 'views/add_maintenance.php';
            break;
        case 'maintenance':
            include 'views/maintenance.php'; // Zakładam, że widok zgłoszeń serwisowych już istnieje
            break;
        case 'save_maintenance':
            include 'controllers/save_maintenance.php';
            break;
        case 'add_notification':
            include 'views/add_notification.php';
            break;
        case 'notifications':
            include 'views/notifications.php'; // Zakładam, że widok powiadomień już istnieje
            break;
        case 'save_notification':
            include 'controllers/save_notification.php';
            break;
        default:
            include 'views/home.php'; // Widok domyślny
    }
    ?>
</div>
<?php include 'partials/footer.php'; ?> <!-- Dołączenie stopki -->
<?php include 'views/login_modal.php'; ?> <!-- Dołączenie modala logowania -->
</body>
</html>
