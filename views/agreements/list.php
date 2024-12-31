<div class="container">
    <h1 class="mb-4">Lista Umów Najmu</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Mieszkanie</th>
            <th>Najemca</th>
            <th>Właściciel</th>
            <th>Data Rozpoczęcia</th>
            <th>Data Zakończenia</th>
            <th>Czynsz (PLN)</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($agreements)): ?>
            <?php foreach ($agreements as $agreement): ?>
                <tr>
                    <td><?= htmlspecialchars($agreement['id'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($agreement['apartment_number'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($agreement['tenant_first_name'] ?? '-') ?> <?= htmlspecialchars($agreement['tenant_last_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($agreement['owner_first_name'] ?? '-') ?> <?= htmlspecialchars($agreement['owner_last_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($agreement['start_date'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($agreement['end_date'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(number_format($agreement['rent_amount'] ?? 0, 2)) ?> PLN</td>
                    <td><?= htmlspecialchars($agreement['status'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Brak danych</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
