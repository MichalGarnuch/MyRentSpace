<div class="container mt-4"> <!-- Główny kontener formularza dodawania najemcy -->
    <h1 class="mb-4">Dodaj Najemcę</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_tenant.php"> <!-- Formularz przesyła dane do kontrolera save_tenant.php metodą POST -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Imię:</label> <!-- Etykieta dla pola imię -->
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Podaj imię" required> <!-- Pole do wprowadzenia imię -->
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nazwisko:</label> <!-- Etykieta dla pola nazwisko -->
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Podaj nazwisko" required> <!-- Pole do wprowadzenia nazwiska -->
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon:</label> <!-- Etykieta dla pola numer telefonu -->
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Podaj numer telefonu" required> <!-- Pole do wprowadzenia numeru telefonu -->
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label> <!-- Etykieta dla pola adresu e-mail -->
            <input type="email" class="form-control" id="email" name="email" placeholder="Podaj adres e-mail" required> <!-- Pole do wprowadzenia adresu e-mail -->
        </div>
        <button type="submit" class="btn btn-success">Dodaj Najemcę</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_tenant.php` generuje formularz umożliwiający dodanie nowego najemcy.-->
<!--- Formularz zawiera pola do wprowadzenia imię, nazwiska, numeru telefonu oraz adresu e-mail.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_tenant.php` za pomocą metody POST.-->
<!--*/-->
