<div class="container mt-4"> <!-- Główny kontener formularza dodawania zgłoszenia serwisowego -->
    <h1 class="mb-4">Dodaj Zgłoszenie Serwisowe</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_maintenance.php"> <!-- Formularz przesyła dane do kontrolera save_maintenance.php metodą POST -->
        <div class="mb-3">
            <label for="apartment_id" class="form-label">ID Mieszkania:</label> <!-- Etykieta dla pola ID mieszkania -->
            <input type="number" class="form-control" id="apartment_id" name="apartment_id" placeholder="Podaj ID mieszkania" required> <!-- Pole do wprowadzenia ID mieszkania -->
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Opis:</label> <!-- Etykieta dla pola opisu problemów -->
            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Opisz problem" required></textarea> <!-- Pole do wprowadzenia opisu zgłoszenia -->
        </div>
        <div class="mb-3">
            <label for="request_date" class="form-label">Data Zgłoszenia:</label> <!-- Etykieta dla pola daty zgłoszenia -->
            <input type="date" class="form-control" id="request_date" name="request_date" required> <!-- Pole do wprowadzenia daty zgłoszenia -->
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label> <!-- Etykieta dla pola statusu zgłoszenia -->
            <select class="form-select" id="status" name="status" required> <!-- Lista rozwijana do wyboru statusu zgłoszenia -->
                <option value="open">Otwarte</option> <!-- Opcja: zgłoszenie otwarte -->
                <option value="in_progress">W trakcie realizacji</option> <!-- Opcja: zgłoszenie w trakcie realizacji -->
                <option value="closed">Zamknięte</option> <!-- Opcja: zgłoszenie zamknięte -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Zgłoszenie</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_maintenance.php` generuje formularz umożliwiający dodanie nowego zgłoszenia serwisowego.-->
<!--- Formularz zawiera pola do wprowadzenia ID mieszkania, opisu problemów, daty zgłoszenia oraz statusu zgłoszenia.-->
<!--- Status można wybrać z listy rozwijanej, zawierającej opcje: otwarte, w trakcie realizacji i zamknięte.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_maintenance.php` za pomocą metody POST.-->
<!--*/-->
