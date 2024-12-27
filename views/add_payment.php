<div class="container mt-4">
    <h1 class="mb-4">Dodaj Płatność</h1>
    <form method="POST" action="controllers/save_payment.php">
        <div class="mb-3">
            <label for="rental_agreement_id" class="form-label">ID Umowy Najmu:</label>
            <input type="number" class="form-control" id="rental_agreement_id" name="rental_agreement_id" placeholder="Podaj ID umowy najmu" required>
        </div>
        <div class="mb-3">
            <label for="payment_date" class="form-label">Data Płatności:</label>
            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Kwota (PLN):</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Podaj kwotę płatności" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Typ Płatności:</label>
            <select class="form-select" id="type" name="type" required>
                <option value="rent">Czynsz</option>
                <option value="owner_rent">Wynajem dla właściciela</option>
                <option value="media">Media</option>
                <option value="commission">Prowizja</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status" required>
                <option value="paid">Zapłacone</option>
                <option value="pending">Oczekujące</option>
                <option value="overdue">Zaległe</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Płatność</button>
    </form>
</div>
