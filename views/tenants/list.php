<div class="container"> <!-- Kontener główny dla zawartości strony -->
    <h1 class="mb-4">Lista Najemców</h1> <!-- Nagłówek strony -->

    <table class="table table-striped"> <!-- Tabela wyświetlająca listę najemców -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID najemcy -->
            <th>Imię</th> <!-- Kolumna imienia -->
            <th>Nazwisko</th> <!-- Kolumna nazwiska -->
            <th>Telefon</th> <!-- Kolumna numeru telefonu -->
            <th>Email</th> <!-- Kolumna adresu email -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $tenants są dane -->
        <?php if (!empty($tenants)): ?>
            <!-- Iteracja przez każdy najemcę w tablicy $tenants -->
            <?php foreach ($tenants as $tenant): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego najemcy -->
                    <td><?= htmlspecialchars($tenant['id'] ?? '-') ?></td> <!-- ID najemcy -->
                    <td><?= htmlspecialchars($tenant['first_name'] ?? '-') ?></td> <!-- Imię -->
                    <td><?= htmlspecialchars($tenant['last_name'] ?? '-') ?></td> <!-- Nazwisko -->
                    <td><?= htmlspecialchars($tenant['phone'] ?? '-') ?></td> <!-- Telefon -->
                    <td><?= htmlspecialchars($tenant['email'] ?? '-') ?></td> <!-- Email -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $tenants -->
            <tr>
                <td colspan="5" class="text-center">Brak najemców do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!--
Komentarze kluczowe:
- Plik generuje listę najemców na podstawie danych z tablicy $tenants.
- Dane są iterowane w pętli foreach, gdzie każdy wiersz reprezentuje jednego najemcę.
- Wyświetlane dane obejmują: ID, imię, nazwisko, numer telefonu oraz adres email.
- W przypadku braku danych w tablicy wyświetlany jest komunikat "Brak najemców do wyświetlenia".
- Kod stosuje funkcję htmlspecialchars() dla zabezpieczenia przed atakami XSS.
-->
