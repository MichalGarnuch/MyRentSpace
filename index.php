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
        case 'apartments':
            include 'views/apartments.php';
            break;
        case 'tenants':
            include 'views/tenants.php';
            break;
        case 'owners':
            include 'views/owners.php';
            break;
        case 'agreements':
            include 'views/agreements.php';
            break;
        case 'payments':
            include 'views/payments.php';
            break;
        case 'media':
            include 'views/media.php';
            break;
        case 'maintenance':
            include 'views/maintenance.php';
            break;
        case 'notifications':
            include 'views/notifications.php';
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
