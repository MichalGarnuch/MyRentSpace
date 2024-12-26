<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Ustawienie kodowania znaków -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsywność strony -->
    <title>MyRentSpace</title> <!-- Tytuł strony -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Własne style -->
    <link href="styles.css" rel="stylesheet"> <!-- Dodanie pliku z własnymi stylami -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php include 'header.php'; ?> <!-- Dołączenie nagłówka -->
<div class="container mt-4"> <!-- Główna zawartość strony -->
    <?php include 'home.php'; ?> <!-- Dołączenie sekcji "home" -->
</div>
<?php include 'footer.php'; ?> <!-- Dołączenie stopki -->
<?php include 'login_modal.php'; ?> <!-- Dołączenie modala logowania -->
</body>
</html>
