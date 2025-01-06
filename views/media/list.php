<div class="container">
    <h1 class="mb-4">Lista Zużycia Mediów</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca zużycie mediów -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID zużycia -->
            <th>Numer mieszkania</th> <!-- Numer mieszkania -->
            <th>Medium</th> <!-- Typ medium -->
            <th>Data odczytu</th> <!-- Data odczytu -->
            <th>Wartość</th> <!-- Wartość zużycia -->
            <th>Zarchiwizowane</th> <!-- Status archiwizacji -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $mediaUsage są dane -->
        <?php if (!empty($mediaUsage)): ?>
            <!-- Iteracja przez każdy rekord w tablicy $mediaUsage -->
            <?php foreach ($mediaUsage as $usage): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego odczytu -->
                    <td><?= htmlspecialchars($usage['id'] ?? '-') ?></td> <!-- ID zużycia -->
                    <td><?= htmlspecialchars('Mieszkanie #' . ($usage['apartment_number'] ?? '-')) ?></td> <!-- Numer mieszkania -->
                    <td><?= htmlspecialchars($usage['media_name'] ?? '-') ?></td> <!-- Typ medium -->
                    <td><?= htmlspecialchars($usage['reading_date'] ?? '-') ?></td> <!-- Data odczytu -->
                    <td><?= htmlspecialchars($usage['value'] ?? '-') ?> <?= htmlspecialchars($usage['unit'] ?? '') ?></td> <!-- Wartość zużycia -->
                    <td><?= htmlspecialchars($usage['archived'] ? 'Tak' : 'Nie') ?></td> <!-- Status archiwizacji -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $mediaUsage -->
            <tr>
                <td colspan="6" class="text-center">Brak danych</td> <!-- Komunikat o braku danych -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
