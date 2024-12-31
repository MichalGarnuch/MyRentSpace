<div class="container">
    <h1 class="mb-4">Lista Budynków</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Miejscowość</th>
            <th>Ulica</th>
            <th>Numer budynku</th>
            <th>Liczba pięter</th>
            <th>Koszty wspólne (PLN)</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($buildings)): ?>
            <?php foreach ($buildings as $building): ?>
                <tr>
                    <td><?= htmlspecialchars($building['id'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($building['city'] . ' (' . $building['postal_code'] . ')') ?></td>
                    <td><?= htmlspecialchars($building['street'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($building['building_number'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($building['total_floors'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(number_format($building['common_cost'] ?? 0, 2)) ?> PLN</td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Brak budynków do wyświetlenia</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
