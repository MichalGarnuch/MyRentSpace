<?php
require_once __DIR__ . '/../helpers/functions.php';
?>

<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyRentSpace</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php?view=buildings">Budynki</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=apartments">Mieszkania</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=tenants">Najemcy</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=owners">Właściciele</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=agreements">Umowy Najmu</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=payments">Płatności</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=media">Zużycie Mediów</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=maintenance">Zgłoszenia Serwisowe</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?view=notifications">Powiadomienia</a></li>
            </ul>
        </div>
    </div>
</nav>
