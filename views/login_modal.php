<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"> <!-- Modal logowania -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> <!-- Nagłówek modala -->
                <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5> <!-- Tytuł okna logowania -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> <!-- Przycisk zamykania -->
            </div>
            <div class="modal-body">
                <!-- Formularz logowania -->
                <form>
                    <div class="mb-3"> <!-- Pole nazwy użytkownika -->
                        <label for="username" class="form-label">Nazwa użytkownika</label>
                        <input type="text" class="form-control" id="username" placeholder="Wpisz nazwę użytkownika">
                    </div>
                    <div class="mb-3"> <!-- Pole hasła -->
                        <label for="password" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="password" placeholder="Wpisz hasło">
                    </div>
                    <div class="mb-3"> <!-- Pole emaila -->
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Wpisz swój email">
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj się</button> <!-- Przycisk logowania -->
                </form>
            </div>
        </div>
    </div>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `login_modal.php` generuje modal logowania.-->
<!--- Modal zawiera formularz z polami: nazwa użytkownika, hasło oraz email.-->
<!--- Formularz może być rozbudowany o obsługę sesji i uwierzytelniania.-->
<!--- Zamykanie modala obsługiwane jest przez Bootstrap za pomocą klasy `btn-close`.-->
<!--*/-->
