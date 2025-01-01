<div class="container"> <!-- Główny kontener strony -->
    <h1 class="mb-4">Lista Płatności</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę płatności -->
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
        <!-- Jeśli w zmiennej $payments są dane -->
        <?php if (!empty($payments)): ?>
            <!-- Iteracja przez każdą płatność w tablicy $payments -->
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <!-- Wyświetlenie danych każdej płatności -->
                    <td><?= htmlspecialchars($payment['id'] ?? '-') ?></td> <!-- ID płatności -->
                    <td><?= htmlspecialchars('Umowa #' . ($payment['agreement_id'] ?? '-')) ?></td> <!-- Opis umowy -->
                    <td><?= htmlspecialchars($payment['payment_date'] ?? '-') ?></td> <!-- Data płatności -->
                    <td><?= htmlspecialchars(number_format($payment['amount'] ?? 0, 2)) ?> PLN</td> <!-- Kwota -->
                    <td><?= htmlspecialchars($payment['type'] ?? '-') ?></td> <!-- Typ -->
                    <td><?= htmlspecialchars($payment['status'] ?? '-') ?></td> <!-- Status -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $payments -->
            <tr>
                <td colspan="6" class="text-center">Brak płatności do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!--
Komentarze kluczowe:
1. Plik generuje listę płatności na podstawie danych przechowywanych w zmiennej $payments.
2. Dane są iterowane w pętli foreach, gdzie każdy wiersz reprezentuje jedną płatność.
3. Funkcja htmlspecialchars() zabezpiecza dane przed atakami XSS.
4. W przypadku braku danych w tablicy wyświetlany jest komunikat "Brak płatności do wyświetlenia".
5. Kwoty płatności są formatowane za pomocą number_format() do dwóch miejsc po przecinku.
6. Struktura i styl tabeli odpowiadają schematowi używanemu w widoku buildings/list.
-->
