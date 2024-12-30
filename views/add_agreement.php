<div class="container mt-4"> <!-- Główny kontener formularza dodawania umowy najmu -->
    <h1 class="mb-4">Dodaj Umowę Najmu</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_agreement.php"> <!-- Formularz przesyła dane do kontrolera save_agreement.php metodą POST -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label> <!-- Etykieta dla pola ID mieszkania -->
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required> <!-- Pole do wprowadzenia ID mieszkania -->
        </div>
        <div class="mb-3">
            <label for="tenant_id" class="form-label">ID Najemcy:</label> <!-- Etykieta dla pola ID najemcy -->
            <input type="number" class="form-control" id="tenant_id" name="tenant_id" placeholder="Podaj ID najemcy" required> <!-- Pole do wprowadzenia ID najemcy -->
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Data Rozpoczęcia:</label> <!-- Etykieta dla pola daty rozpoczęcia -->
            <input type="date" class="form-control" id="start_date" name="start_date" required> <!-- Pole do wyboru daty rozpoczęcia -->
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Data Zakończenia:</label> <!-- Etykieta dla pola daty zakończenia -->
            <input type="date" class="form-control" id="end_date" required name="end_date"> <!-- Pole do wyboru daty zakończenia -->
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Kwota (PLN):</label> <!-- Etykieta dla pola kwoty -->
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Podaj kwotę najmu" required> <!-- Pole do wprowadzenia kwoty najmu -->
        </div>
        <button type="submit" class="btn btn-success">Dodaj Umowę</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_agreement.php` generuje formularz umożliwiający dodanie nowej umowy najmu.-->
<!--- Formularz zawiera pola do wprowadzenia ID mieszkania, ID najemcy, daty rozpoczęcia, daty zakończenia oraz kwoty najmu.-->
<!--- Wszystkie pola są oznaczone jako wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_agreement.php` za pomocą metody POST.-->
<!--*/-->
