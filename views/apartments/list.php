<div class="container">
    <h1 class="mb-4">Lista Mieszkań</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Numer mieszkania</th>
            <th>Piętro</th>
            <th>Powierzchnia (m²)</th>
            <th>Status</th>
            <th>Budynek</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($apartments)): ?>
            <?php foreach ($apartments as $apartment): ?>
                <tr>
                    <td><?= htmlspecialchars($apartment['id'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($apartment['apartment_number'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($apartment['floor_number'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($apartment['size_sqm'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($apartment['status'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($apartment['street'] ?? '-') ?> <?= htmlspecialchars($apartment['building_number'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Brak danych</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
