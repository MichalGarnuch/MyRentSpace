<div class="container">
    <h1 class="mb-4">Lista Zgłoszeń Serwisowych</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę zgłoszeń serwisowych -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID zgłoszenia -->
            <th>Mieszkanie</th> <!-- Numer mieszkania -->
            <th>Piętro</th> <!-- Numer piętra -->
            <th>Budynek</th> <!-- Adres budynku -->
            <th>Miejscowość</th> <!-- Miejscowość -->
            <th>Opis</th> <!-- Opis zgłoszenia -->
            <th>Data zgłoszenia</th> <!-- Data zgłoszenia -->
            <th>Status</th> <!-- Status zgłoszenia -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $maintenance_requests są dane -->
        <?php if (!empty($maintenance_requests)): ?>
            <!-- Iteracja przez każde zgłoszenie w tablicy $maintenance_requests -->
            <?php foreach ($maintenance_requests as $request): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego zgłoszenia -->
                    <td><?= htmlspecialchars($request['id'] ?? '-') ?></td> <!-- ID zgłoszenia -->
                    <td><?= htmlspecialchars($request['apartment_number'] ?? '-') ?></td> <!-- Numer mieszkania -->
                    <td><?= htmlspecialchars($request['floor_number'] ?? '-') ?></td> <!-- Numer piętra -->
                    <td><?= htmlspecialchars($request['street'] ?? '-') ?> <?= htmlspecialchars($request['building_number'] ?? '-') ?></td> <!-- Adres budynku -->
                    <td><?= htmlspecialchars($request['city'] ?? '-') ?> (<?= htmlspecialchars($request['postal_code'] ?? '-') ?>)</td> <!-- Miejscowość -->
                    <td><?= htmlspecialchars($request['description'] ?? '-') ?></td> <!-- Opis zgłoszenia -->
                    <td><?= htmlspecialchars($request['request_date'] ?? '-') ?></td> <!-- Data zgłoszenia -->
                    <td><?= htmlspecialchars($request['status'] ?? '-') ?></td> <!-- Status zgłoszenia -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $maintenance_requests -->
            <tr>
                <td colspan="8" class="text-center">Brak zgłoszeń serwisowych do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
