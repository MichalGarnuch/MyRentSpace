<div class="container"> <!-- Kontener na zawartość strony -->
    <h1 class="mb-4">Lista Najemców</h1> <!-- Nagłówek sekcji -->

    <table class="table table-striped"> <!-- Tabela wyświetlająca listę najemców -->
        <thead>
        <tr>
            <th>ID</th> <!-- Kolumna na ID najemcy -->
            <th>Imię</th> <!-- Kolumna na imię -->
            <th>Nazwisko</th> <!-- Kolumna na nazwisko -->
            <th>Telefon</th> <!-- Kolumna na numer telefonu -->
            <th>Email</th> <!-- Kolumna na adres email -->
        </tr>
        </thead>
        <tbody>
        <!-- Sprawdzenie, czy są dostępni najemcy w zmiennej $tenants -->
        <?php if (!empty($tenants)): ?>
            <!-- Iteracja przez wszystkich najemców w tablicy $tenants -->
            <?php foreach ($tenants as $tenant): ?>
                <tr>
                    <!-- Wyświetlenie danych najemcy w każdej komórce -->
                    <td><?= htmlspecialchars($tenant['id'] ?? '-') ?></td> <!-- Wyświetlenie ID najemcy -->
                    <td><?= htmlspecialchars($tenant['first_name'] ?? '-') ?></td> <!-- Wyświetlenie imienia -->
                    <td><?= htmlspecialchars($tenant['last_name'] ?? '-') ?></td> <!-- Wyświetlenie nazwiska -->
                    <td><?= htmlspecialchars($tenant['phone'] ?? '-') ?></td> <!-- Wyświetlenie numeru telefonu -->
                    <td><?= htmlspecialchars($tenant['email'] ?? '-') ?></td> <!-- Wyświetlenie adresu email -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli nie ma danych w $tenants, wyświetl komunikat -->
            <tr>
                <td colspan="5" class="text-center">Brak najemców do wyświetlenia</td> <!-- Komunikat o braku danych -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
