<?php
require_once __DIR__ . '/../helpers/functions.php';
?>

<header class="d-flex justify-content-between align-items-center p-3 bg-light">
    <a href="index.php">
        <img src="assets/icon2.jpeg" alt="Logo" style="width: 80px;"> <!-- Ikona zamiast napisu -->
    </a> <!-- Nagłówek strony z nazwą aplikacji -->

    <nav>
        <!-- Sprawdza, czy użytkownik jest zalogowany -->
        <?php if (isLoggedIn()): ?>
            <!-- Dropdown z opcjami do dodania nowych danych -->
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/icon3.jpg" alt="Dodaj nowe dane" style="width: 190px; height: auto;">
                </button>
                <!-- Lista opcji w dropdownie -->
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="index.php?view=add_building">Dodaj budynek</a></li> <!-- Opcja dodania budynku -->
                    <li><a class="dropdown-item" href="index.php?view=add_apartment">Dodaj mieszkanie</a></li> <!-- Opcja dodania mieszkania -->
                    <li><a class="dropdown-item" href="index.php?view=add_tenant">Dodaj najemcę</a></li> <!-- Opcja dodania najemcy -->
                    <li><a class="dropdown-item" href="index.php?view=add_owner">Dodaj właściciela</a></li> <!-- Opcja dodania właściciela -->
                    <li><a class="dropdown-item" href="index.php?view=add_agreement">Dodaj umowę najmu</a></li> <!-- Opcja dodania umowy najmu -->
                    <li><a class="dropdown-item" href="index.php?view=add_payment">Dodaj płatność</a></li> <!-- Opcja dodania płatności -->
                    <li><a class="dropdown-item" href="index.php?view=add_media_usage">Dodaj zużycie mediów</a></li> <!-- Opcja dodania zużycia mediów -->
                    <li><a class="dropdown-item" href="index.php?view=add_maintenance">Dodaj zgłoszenie serwisowe</a></li> <!-- Opcja dodania zgłoszenia serwisowego -->
                    <li><a class="dropdown-item" href="index.php?view=add_notification">Dodaj powiadomienie</a></li> <!-- Opcja dodania powiadomienia -->
                </ul>
            </div>
        <?php endif; ?>
    </nav>

    <!-- Sekcja przycisków logowania i wylogowania -->
    <div>
        <!-- Jeśli użytkownik jest zalogowany, pokazuje jego nazwę i przycisk wylogowania -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="me-3">👤 <?= htmlspecialchars($_SESSION['username']) ?></span> <!-- Wyświetlenie nazwy użytkownika -->
            <a href="auth/logout.php" class="btn btn-dark">Wyloguj się</a> <!-- Przycisk wylogowania -->
        <?php else: ?>
            <!-- Jeśli użytkownik nie jest zalogowany, pokazuje przycisk do logowania -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#loginModal">
                Zaloguj się
            </button> <!-- Przycisk logowania -->
        <?php endif; ?>
    </div>
</header>
