<div class="container">
    <h1 class="mb-4">Lista Powiadomień</h1> <!-- Nagłówek strony -->

    <!-- Tabela wyświetlająca listę powiadomień -->
    <table class="table table-striped">
        <thead>
        <tr>
            <!-- Nagłówki tabeli -->
            <th>ID</th> <!-- ID powiadomienia -->
            <th>Użytkownik</th> <!-- Nazwa użytkownika -->
            <th>Treść powiadomienia</th> <!-- Treść powiadomienia -->
            <th>Typ</th> <!-- Typ powiadomienia -->
            <th>Data wysłania</th> <!-- Data wysłania -->
            <th>Status</th> <!-- Status powiadomienia -->
        </tr>
        </thead>
        <tbody>
        <!-- Jeśli w zmiennej $notifications są dane -->
        <?php if (!empty($notifications)): ?>
            <!-- Iteracja przez każde powiadomienie w tablicy $notifications -->
            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <!-- Wyświetlenie danych każdego powiadomienia -->
                    <td><?= htmlspecialchars($notification['id'] ?? '-') ?></td> <!-- ID powiadomienia -->
                    <td><?= htmlspecialchars($notification['username'] ?? '-') ?></td> <!-- Użytkownik -->
                    <td><?= htmlspecialchars($notification['message'] ?? '-') ?></td> <!-- Treść powiadomienia -->
                    <td><?= htmlspecialchars($notification['type'] ?? '-') ?></td> <!-- Typ powiadomienia -->
                    <td><?= htmlspecialchars($notification['sent_at'] ?? '-') ?></td> <!-- Data wysłania -->
                    <td>
                        <?= htmlspecialchars($notification['status'] === 'unread' ? 'Nieprzeczytane' : 'Przeczytane') ?>
                    </td> <!-- Status powiadomienia -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Jeśli brak danych w $notifications -->
            <tr>
                <td colspan="6" class="text-center">Brak powiadomień do wyświetlenia</td> <!-- Komunikat -->
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
