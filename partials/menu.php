<?php
require_once __DIR__ . '/../helpers/functions.php';
?>

<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyRentSpace</a> <!-- Logo i link do strony głównej -->

        <!-- Przycisk do rozwijania menu na urządzeniach mobilnych -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span> <!-- Ikona przycisku -->
        </button>

        <!-- Menu nawigacyjne -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Linki do poszczególnych widoków -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=buildings">Budynki</a></li> <!-- Link do widoku budynków -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=apartments">Mieszkania</a></li> <!-- Link do widoku mieszkań -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=tenants">Najemcy</a></li> <!-- Link do widoku najemców -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=owners">Właściciele</a></li> <!-- Link do widoku właścicieli -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=agreements">Umowy Najmu</a></li> <!-- Link do widoku umów najmu -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=payments">Płatności</a></li> <!-- Link do widoku płatności -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=media">Zużycie Mediów</a></li> <!-- Link do widoku zużycia mediów -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=maintenance">Zgłoszenia Serwisowe</a></li> <!-- Link do widoku zgłoszeń serwisowych -->
                <li class="nav-item"><a class="nav-link" href="index.php?view=notifications">Powiadomienia</a></li> <!-- Link do widoku powiadomień -->
            </ul>
        </div>
    </div>
</nav>
