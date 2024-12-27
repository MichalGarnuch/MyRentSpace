<header class="d-flex justify-content-between align-items-center p-3 bg-light">
    <h1 class="h4">MyRentSpace</h1> <!-- Logo lub tytuł -->
    <nav>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Dodaj nowe dane
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="index.php?view=add_building">Dodaj budynek</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_apartment">Dodaj mieszkanie</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_tenant">Dodaj najemcę</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_owner">Dodaj właściciela</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_agreement">Dodaj umowę najmu</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_payment">Dodaj płatność</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_media_usage">Dodaj zużycie mediów</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_maintenance">Dodaj zgłoszenie serwisowe</a></li>
                <li><a class="dropdown-item" href="index.php?view=add_notification">Dodaj powiadomienie</a></li>
            </ul>
        </div>
    </nav>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
        Zaloguj się
    </button> <!-- Przycisk otwierający modal logowania -->
</header>
