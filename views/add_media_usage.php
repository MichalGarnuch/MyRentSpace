<div class="container mt-4"> <!-- Główny kontener formularza dodawania zużycia mediów -->
    <h1 class="mb-4">Dodaj Zużycie Mediów</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_media_usage.php"> <!-- Formularz przesyła dane do kontrolera save_media_usage.php metodą POST -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label> <!-- Etykieta dla pola ID mieszkania -->
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required> <!-- Pole do wprowadzenia ID mieszkania -->
        </div>
        <div class="mb-3">
            <label for="media_type_id" class="form-label">ID Typu Medium:</label> <!-- Etykieta dla pola ID typu medium -->
            <input type="number" class="form-control" id="media_type_id" name="media_type_id" placeholder="Podaj ID typu medium" required> <!-- Pole do wprowadzenia ID typu medium -->
        </div>
        <div class="mb-3">
            <label for="reading_date" class="form-label">Data Odczytu:</label> <!-- Etykieta dla pola daty odczytu -->
            <input type="date" class="form-control" id="reading_date" name="reading_date" required> <!-- Pole do wprowadzenia daty odczytu -->
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Zużycie (jednostki):</label> <!-- Etykieta dla pola wartości zużycia -->
            <input type="number" step="0.01" class="form-control" id="value" name="value" placeholder="Podaj wartość zużycia" required> <!-- Pole do wprowadzenia wartości zużycia -->
        </div>
        <button type="submit" class="btn btn-success">Dodaj Zużycie Mediów</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_media_usage.php` generuje formularz umożliwiający dodanie nowego wpisu zużycia mediów.-->
<!--- Formularz zawiera pola do wprowadzenia ID mieszkania, ID typu medium, daty odczytu oraz wartości zużycia.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_media_usage.php` za pomocą metody POST.-->
<!--*/-->
