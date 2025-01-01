<div class="container"> <!-- Kontener dla listy właścicieli -->
    <h1 class="mb-4">Lista Właścicieli</h1> <!-- Nagłówek strony -->

    <table class="table table-striped"> <!-- Tabela z listą właścicieli -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna ID właściciela -->
            <th>Imię</th> <!-- Kolumna imię -->
            <th>Nazwisko</th> <!-- Kolumna nazwisko -->
            <th>Telefon</th> <!-- Kolumna telefonu -->
            <th>Email</th> <!-- Kolumna adresu e-mail -->
            <th>Procent prowizji</th> <!-- Kolumna procentu prowizji -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $owners są dane -->
        <?php if (!empty($owners)): ?>
            <!-- Iteracja przez każdego właściciela w tablicy $owners -->
            <?php foreach ($owners as $owner): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego właściciela -->
                    <td><?= htmlspecialchars($owner['id'] ?? '-') ?></td> <!-- ID właściciela -->
                    <td><?= htmlspecialchars($owner['first_name'] ?? '-') ?></td> <!-- Imię -->
                    <td><?= htmlspecialchars($owner['last_name'] ?? '-') ?></td> <!-- Nazwisko -->
                    <td><?= htmlspecialchars($owner['phone'] ?? '-') ?></td> <!-- Telefon -->
                    <td><?= htmlspecialchars($owner['email'] ?? '-') ?></td> <!-- Email -->
                    <td><?= htmlspecialchars($owner['commission_rate'] ?? '-') ?>%</td> <!-- Procent prowizji -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $owners -->
            <tr>
                <td colspan="6" class="text-center">Brak właścicieli do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!--
Komentarze kluczowe:
- Plik generuje listę właścicieli nieruchomości na podstawie danych z tablicy $owners.
- Dane są iterowane w pętli foreach, gdzie każdy wiersz reprezentuje jednego właściciela.
- Wyświetlane dane obejmują: ID, imię, nazwisko, numer telefonu, adres e-mail oraz procent prowizji.
- W przypadku braku danych w tablicy wyświetlany jest komunikat "Brak właścicieli do wyświetlenia".
- Kod stosuje funkcję htmlspecialchars() dla zabezpieczenia przed atakami XSS.
-->
