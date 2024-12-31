<div class="container mt-4">
    <h1 class="mb-4">Dodaj Umowę Najmu</h1>
    <form method="POST" action="../../index.php?action=save_agreement">
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label>
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required>
        </div>
        <div class="mb-3">
            <label for="tenant_id" class="form-label">ID Najemcy:</label>
            <input type="number" class="form-control" id="tenant_id" name="tenant_id" placeholder="Podaj ID najemcy" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Data Rozpoczęcia:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Data Zakończenia:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Kwota (PLN):</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Podaj kwotę najmu" required>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Umowę</button>
    </form>
</div>
