<div class="modal fade <?php if (isset($_GET['error'])) echo 'show d-block'; ?>" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Nagłówek modala -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
            </div>

            <!-- Treść modala -->
            <div class="modal-body">
                <!-- Sekcja komunikatu błędu (jeśli wystąpił) -->
                <?php if (isset($_GET['error'])): ?>
                    <div id="login-message" class="alert alert-danger text-center" role="alert">
                        ❌ <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <!-- Formularz logowania -->
                <form method="POST" action="auth/login.php">
                    <!-- Pole na nazwę użytkownika -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Nazwa użytkownika</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Wpisz nazwę użytkownika" required autofocus>
                    </div>

                    <!-- Pole na hasło -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Wpisz hasło" required>
                    </div>

                    <!-- Przycisk logowania -->
                    <button type="submit" class="btn btn-primary w-100">Zaloguj się</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Skrypt uruchamiany po załadowaniu strony
    document.addEventListener("DOMContentLoaded", function () {
        let loginModalEl = document.getElementById('loginModal'); // Pobranie elementu modala
        let loginModal = new bootstrap.Modal(loginModalEl); // Inicjalizacja modala

        // Sprawdzanie, czy URL zawiera parametr success=1
        if (window.location.href.includes("success=1")) {
            setTimeout(() => {
                loginModal.hide(); // Zamknięcie modala po 1 sekundzie
                window.location.href = "index.php"; // Przekierowanie na stronę główną
            }, 1000);
        }

        // Jeśli URL zawiera parametr error, modal zostaje pokazany
        if (window.location.href.includes("error=")) {
            loginModal.show(); // Pokazanie modala w przypadku błędu logowania
        }
    });
</script>
