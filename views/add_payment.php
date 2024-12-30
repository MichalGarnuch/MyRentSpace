<div class="container mt-4"> <!-- Główny kontener formularza dodawania płatności -->
    <h1 class="mb-4">Dodaj Płatność</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_payment.php"> <!-- Formularz przesyła dane do kontrolera save_payment.php metodą POST -->
        <div class="mb-3">
            <label for="rental_agreement_id" class="form-label">ID Umowy Najmu:</label> <!-- Etykieta dla pola ID umowy najmu -->
            <input type="number" class="form-control" id="rental_agreement_id" name="rental_agreement_id" placeholder="Podaj ID umowy najmu" required> <!-- Pole do wprowadzenia ID umowy najmu -->
        </div>
        <div class="mb-3">
            <label for="payment_date" class="form-label">Data Płatności:</label> <!-- Etykieta dla pola daty płatności -->
            <input type="date" class="form-control" id="payment_date" name="payment_date" required> <!-- Pole do wprowadzenia daty płatności -->
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Kwota (PLN):</label> <!-- Etykieta dla pola kwoty płatności -->
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Podaj kwotę płatności" required> <!-- Pole do wprowadzenia kwoty płatności -->
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Typ Płatności:</label> <!-- Etykieta dla pola typu płatności -->
            <select class="form-select" id="type" name="type" required> <!-- Lista rozwijana do wyboru typu płatności -->
                <option value="rent">Czynsz</option> <!-- Opcja: czynsz -->
                <option value="owner_rent">Wynajem dla właściciela</option> <!-- Opcja: wynajem dla właściciela -->
                <option value="media">Media</option> <!-- Opcja: media -->
                <option value="commission">Prowizja</option> <!-- Opcja: prowizja -->
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label> <!-- Etykieta dla pola statusu płatności -->
            <select class="form-select" id="status" name="status" required> <!-- Lista rozwijana do wyboru statusu płatności -->
                <option value="paid">Zapłacone</option> <!-- Opcja: zapłacone -->
                <option value="pending">Oczekujące</option> <!-- Opcja: oczekujące -->
                <option value="overdue">Zaległe</option> <!-- Opcja: zaległe -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Płatność</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_payment.php` generuje formularz umożliwiający dodanie nowej płatności.-->
<!--- Formularz zawiera pola do wprowadzenia ID umowy najmu, daty płatności, kwoty, typu płatności oraz statusu płatności.-->
<!--- Typ płatności można wybrać z listy rozwijanej, zawierającej opcje: czynsz, wynajem dla właściciela, media oraz prowizja.-->
<!--- Status płatności można wybrać z listy rozwijanej, zawierającej opcje: zapłacone, oczekujące oraz zaległe.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_payment.php` za pomocą metody POST.-->
<!--*/-->
