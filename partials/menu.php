<?php
require_once __DIR__ . '/../helpers/functions.php';
?>

<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/icon1.jpeg" alt="MyRentSpace" style="width: 200px;"> <!-- Ikona zamiast napisu -->
        </a><!-- Logo i link do strony głównej -->

        <!-- Przycisk do rozwijania menu na urządzeniach mobilnych -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span> <!-- Ikona przycisku -->
        </button>

        <!-- Menu nawigacyjne -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Linki do poszczególnych widoków -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=buildings">
                        <img src="assets/2.jpg" alt="buildings" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku budynków -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=apartments">
                        <img src="assets/1.jpg" alt="apartments" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku mieszkań -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=tenants">
                        <img src="assets/4.jpg" alt="tenants" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku najemców -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=owners">
                        <img src="assets/7.jpg" alt="owners" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku właścicieli -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=agreements">
                        <img src="assets/9.jpg" alt="agreements" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku umów najmu -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=payments">
                        <img src="assets/8.jpg" alt="payments" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku płatności -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=media">
                        <img src="assets/6.jpg" alt="media" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku zużycia mediów -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=maintenance">
                        <img src="assets/10.jpg" alt="maintenance" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku zgłoszeń serwisowych -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=notifications">
                        <img src="assets/11.jpg" alt="notifications" style="width: 70px;"> <!-- Ikona dla Budynki -->
                    </a> <!-- Link do widoku powiadomień -->
            </ul>
        </div>
    </div>
</nav>
