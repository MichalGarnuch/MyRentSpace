<div class="container">
    <h1 class="mb-4">Lista Budynków</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę budynków -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID budynku -->
            <th>Miejscowość</th> <!-- Nazwa miejscowości i kod pocztowy -->
            <th>Ulica</th> <!-- Nazwa ulicy -->
            <th>Numer budynku</th> <!-- Numer budynku -->
            <th>Liczba pięter</th> <!-- Liczba pięter w budynku -->
            <th>Koszty wspólne (PLN)</th> <!-- Koszty wspólne w PLN -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $buildings są dane -->
        <?php if (!empty($buildings)): ?>
            <!-- Iteracja przez każdy budynek w tablicy $buildings -->
            <?php foreach ($buildings as $building): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego budynku -->
                    <td><?= htmlspecialchars($building['id'] ?? '-') ?></td> <!-- ID budynku -->
                    <td><?= htmlspecialchars($building['city'] . ' (' . $building['postal_code'] . ')') ?></td> <!-- Miejscowość i kod pocztowy -->
                    <td><?= htmlspecialchars($building['street'] ?? '-') ?></td> <!-- Ulica -->
                    <td><?= htmlspecialchars($building['building_number'] ?? '-') ?></td> <!-- Numer budynku -->
                    <td><?= htmlspecialchars($building['total_floors'] ?? '-') ?></td> <!-- Liczba pięter -->
                    <td><?= htmlspecialchars(number_format($building['common_cost'] ?? 0, 2)) ?> PLN</td> <!-- Koszty wspólne -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $buildings -->
            <tr>
                <td colspan="6" class="text-center">Brak budynków do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
