<div class="container mt-4">
    <h1 class="mb-4">Dodaj Właściciela</h1>
    <form method="POST" action="controllers/save_owner.php">
        <div class="mb-3">
            <label for="first_name" class="form-label">Imię:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Podaj imię" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nazwisko:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Podaj nazwisko" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj adres e-mail" required>
        </div>
        <div class="mb-3">
            <label for="commission_rate" class="form-label">Procent Prowizji (%):</label>
            <input type="number" step="0.01" class="form-control" id="commission_rate" name="commission_rate" placeholder="Podaj procent prowizji" required>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Właściciela</button>
    </form>
</div>
