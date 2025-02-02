<!-- Tło na pełnym ekranie z warstwą przyciemnienia -->
<div class="overlay"></div>

<!-- Kontener na treść - centrowanie zawartości na ekranie -->
<div class="container-fluid d-flex justify-content-center align-items-center vh-100"
     style="background: url('assets/background.jpg') no-repeat center center fixed; background-size: cover;">

    <!-- Pudełko z treścią - Wyśrodkowana zawartość z cieniem i przezroczystością -->
    <div class="text-center p-5 rounded shadow-lg"
         style="background: rgba(255, 255, 255, 0.9); max-width: 500px;">

        <!-- Logo - z automatycznym dopasowaniem szerokości -->
        <img src="assets/icon2.jpeg" alt="MyRentSpace" class="mb-4" style="width: 200px;">

        <!-- Nagłówek strony -->
        <h1 class="fw-bold text-primary" style="font-size: 3rem;"> <!-- Pogrubienie i zwiększenie czcionki -->
            <img src="assets/icon1.jpeg" alt="MyRentSpace" style="width: 200px;"> <!-- Ikona zamiast tekstu -->
        </h1>

        <!-- Krótkie info o funkcjonalności aplikacji -->
        <p class="text-muted" style="font-size: 1.25rem; font-weight: 600;">Zarządzaj najmem łatwo i wygodnie</p>

        <div class="mt-4">
            <!-- Przycisk do przeglądania dostępnych budynków -->
            <a href="index.php?view=buildings" class="btn btn-lg btn-primary me-2">Przeglądaj</a>

            <!-- Przycisk otwierający modal logowania -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-lg btn-outline-primary">Zaloguj się</a>
        </div>
    </div>
</div>
