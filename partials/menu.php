<nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- Pasek nawigacyjny aplikacji -->
    <div class="container-fluid"> <!-- Kontener dla elementów paska nawigacyjnego -->
        <!-- Logo aplikacji lub link do strony głównej -->
        <a class="navbar-brand" href="index.php">MyRentSpace</a>

        <!-- Przycisk rozwijania menu dla urządzeń mobilnych -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span> <!-- Ikona rozwijania menu -->
        </button>

        <!-- Rozwijane menu nawigacyjne -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Linki do poszczególnych widoków aplikacji -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=buildings">Budynki</a> <!-- Link do widoku budynków -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=apartments">Mieszkania</a> <!-- Link do widoku mieszkań -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=tenants">Najemcy</a> <!-- Link do widoku najemców -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=owners">Właściciele</a> <!-- Link do widoku właścicieli -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=agreements">Umowy Najmu</a> <!-- Link do widoku umów najmu -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=payments">Płatności</a> <!-- Link do widoku płatności -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=media">Zużycie Mediów</a> <!-- Link do widoku zużycia mediów -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=maintenance">Zgłoszenia Serwisowe</a> <!-- Link do widoku zgłoszeń serwisowych -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=notifications">Powiadomienia</a> <!-- Link do widoku powiadomień -->
                </li>
            </ul>
        </div>
    </div>
</nav>
