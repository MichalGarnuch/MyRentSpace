<header class="d-flex justify-content-between align-items-center p-3 bg-light"> <!-- Nagłówek strony -->
    <h1 class="h4">MyRentSpace</h1> <!-- Logo lub tytuł aplikacji -->
    <nav>
        <div class="dropdown"> <!-- Dropdown menu dla opcji dodawania danych -->
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Dodaj nowe dane <!-- Tekst przycisku rozwijanego menu -->
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="index.php?view=add_building">Dodaj budynek</a></li> <!-- Link do formularza dodawania budynku -->
                <li><a class="dropdown-item" href="index.php?view=add_apartment">Dodaj mieszkanie</a></li> <!-- Link do formularza dodawania mieszkania -->
                <li><a class="dropdown-item" href="index.php?view=add_tenant">Dodaj najemcę</a></li> <!-- Link do formularza dodawania najemcy -->
                <li><a class="dropdown-item" href="index.php?view=add_owner">Dodaj właściciela</a></li> <!-- Link do formularza dodawania właściciela -->
                <li><a class="dropdown-item" href="index.php?view=add_agreement">Dodaj umowę najmu</a></li> <!-- Link do formularza dodawania umowy najmu -->
                <li><a class="dropdown-item" href="index.php?view=add_payment">Dodaj płatność</a></li> <!-- Link do formularza dodawania płatności -->
                <li><a class="dropdown-item" href="index.php?view=add_media_usage">Dodaj zużycie mediów</a></li> <!-- Link do formularza dodawania zużycia mediów -->
                <li><a class="dropdown-item" href="index.php?view=add_maintenance">Dodaj zgłoszenie serwisowe</a></li> <!-- Link do formularza dodawania zgłoszenia serwisowego -->
                <li><a class="dropdown-item" href="index.php?view=add_notification">Dodaj powiadomienie</a></li> <!-- Link do formularza dodawania powiadomienia -->
            </ul>
        </div>
    </nav>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
        Zaloguj się <!-- Przycisk otwierający modal logowania -->
    </button>
</header>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `header.php` generuje nagłówek aplikacji.-->
<!--- Zawiera tytuł aplikacji ("MyRentSpace") oraz menu rozwijane umożliwiające dodawanie danych do różnych modułów aplikacji.-->
<!--- Przyciski w menu są dynamiczne i odwołują się do odpowiednich widoków w `index.php`.-->
<!--- Przycisk "Zaloguj się" otwiera modal logowania.-->
<!--*/-->
