<div class="container">
    <h1 class="mb-4">Lista Umów Najmu</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę umów najmu -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID umowy -->
            <th>Mieszkanie</th> <!-- Numer mieszkania -->
            <th>Najemca</th> <!-- Imię i nazwisko najemcy -->
            <th>Właściciel</th> <!-- Imię i nazwisko właściciela -->
            <th>Data Rozpoczęcia</th> <!-- Data rozpoczęcia umowy -->
            <th>Data Zakończenia</th> <!-- Data zakończenia umowy -->
            <th>Czynsz (PLN)</th> <!-- Kwota czynszu w PLN -->
            <th>Status</th> <!-- Status umowy -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $agreements są dane -->
        <?php if (!empty($agreements)): ?>
            <!-- Iteracja przez każdy rekord w tablicy $agreements -->
            <?php foreach ($agreements as $agreement): ?>
                <tr>
                    <!-- Wyświetlenie danych dla każdej umowy -->
                    <td><?= htmlspecialchars($agreement['id'] ?? '-') ?></td> <!-- ID umowy -->
                    <td><?= htmlspecialchars($agreement['apartment_number'] ?? '-') ?></td> <!-- Numer mieszkania -->
                    <td><?= htmlspecialchars($agreement['tenant_first_name'] ?? '-') ?> <?= htmlspecialchars($agreement['tenant_last_name'] ?? '-') ?></td> <!-- Najemca -->
                    <td><?= htmlspecialchars($agreement['owner_first_name'] ?? '-') ?> <?= htmlspecialchars($agreement['owner_last_name'] ?? '-') ?></td> <!-- Właściciel -->
                    <td><?= htmlspecialchars($agreement['start_date'] ?? '-') ?></td> <!-- Data rozpoczęcia -->
                    <td><?= htmlspecialchars($agreement['end_date'] ?? '-') ?></td> <!-- Data zakończenia -->
                    <td><?= htmlspecialchars(number_format($agreement['rent_amount'] ?? 0, 2)) ?> PLN</td> <!-- Kwota czynszu -->
                    <td><?= htmlspecialchars($agreement['status'] ?? '-') ?></td> <!-- Status umowy -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $agreements -->
            <tr>
                <td colspan="8" class="text-center">Brak danych</td> <!-- Komunikat o braku danych -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
