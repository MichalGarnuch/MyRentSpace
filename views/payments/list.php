<div class="container"> <!-- Kontener na stronę wyświetlającą listę płatności -->
    <h1 class="mb-4">Lista Płatności</h1> <!-- Nagłówek strony -->

    <!-- Tabela do wyświetlania listy płatności -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID płatności -->
            <th>Umowa</th> <!-- Opis umowy najmu -->
            <th>Data płatności</th> <!-- Data płatności -->
            <th>Kwota</th> <!-- Kwota płatności -->
            <th>Typ</th> <!-- Typ płatności -->
            <th>Status</th> <!-- Status płatności -->
        </tr>
        </thead>
        <tbody>
        <!-- Sprawdzanie, czy są dane w zmiennej $payments -->
        <?php if (!empty($payments)): ?>
            <!-- Iteracja po każdej płatności w tablicy $payments -->
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <!-- Wyświetlanie danych dla każdej płatności -->
                    <td><?= htmlspecialchars($payment['id'] ?? '-') ?></td> <!-- ID płatności -->
                    <td><?= htmlspecialchars('Umowa #' . ($payment['agreement_id'] ?? '-')) ?></td> <!-- Opis umowy -->
                    <td><?= htmlspecialchars($payment['payment_date'] ?? '-') ?></td> <!-- Data płatności -->
                    <td><?= htmlspecialchars(number_format($payment['amount'] ?? 0, 2)) ?> PLN</td> <!-- Kwota z formatowaniem -->
                    <td><?= htmlspecialchars($payment['type'] ?? '-') ?></td> <!-- Typ płatności -->
                    <td><?= htmlspecialchars($payment['status'] ?? '-') ?></td> <!-- Status płatności -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $payments, wyświetl komunikat -->
            <tr>
                <td colspan="6" class="text-center">Brak płatności do wyświetlenia</td> <!-- Komunikat o braku danych -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
