<div class="container">
    <h1 class="mb-4">Lista Mieszkań</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę mieszkań -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID mieszkania -->
            <th>Numer mieszkania</th> <!-- Numer mieszkania -->
            <th>Piętro</th> <!-- Numer piętra -->
            <th>Powierzchnia (m²)</th> <!-- Powierzchnia mieszkania w m² -->
            <th>Status</th> <!-- Status mieszkania -->
            <th>Budynek</th> <!-- Adres budynku -->
            <th>Miejscowość</th>
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $apartments są dane -->
        <?php if (!empty($apartments)): ?>
            <!-- Iteracja przez każdy rekord w tablicy $apartments -->
            <?php foreach ($apartments as $apartment): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego mieszkania -->
                    <td><?= htmlspecialchars($apartment['id'] ?? '-') ?></td> <!-- ID mieszkania -->
                    <td><?= htmlspecialchars($apartment['apartment_number'] ?? '-') ?></td> <!-- Numer mieszkania -->
                    <td><?= htmlspecialchars($apartment['floor_number'] ?? '-') ?></td> <!-- Numer piętra -->
                    <td><?= htmlspecialchars($apartment['size_sqm'] ?? '-') ?> m²</td> <!-- Powierzchnia mieszkania -->
                    <td><?= htmlspecialchars($apartment['status'] ?? '-') ?></td> <!-- Status mieszkania -->
                    <td><?= htmlspecialchars($apartment['street'] ?? '-') ?> <?= htmlspecialchars($apartment['building_number'] ?? '-') ?></td> <!-- Adres budynku -->
                    <td><?= htmlspecialchars($apartment['city'] ?? '-') ?> (<?= htmlspecialchars($apartment['postal_code'] ?? '-') ?>)</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $apartments -->
            <tr>
                <td colspan="6" class="text-center">Brak danych</td> <!-- Komunikat o braku danych -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
