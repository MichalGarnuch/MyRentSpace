<div class="container mt-4">
    <h1 class="mb-4">Dodaj Najemcę</h1>
    <form method="POST" action="controllers/save_tenant.php">
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
        <button type="submit" class="btn btn-success">Dodaj Najemcę</button>
    </form>
</div>
