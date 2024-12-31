<div class="container mt-4"> <!-- Główny kontener formularza dodawania mieszkania -->
    <h1 class="mb-4">Dodaj Mieszkanie</h1> <!-- Nagłówek strony -->
    <form method="POST" action="index.php?action=save_agreement"> <!-- Formularz przesyła dane do kontrolera save_apartment.php metodą POST -->
        <div class="mb-3">
            <label for="building_id" class="form-label">ID Budynku:</label> <!-- Etykieta dla pola ID budynku -->
            <input type="number" class="form-control" id="building_id" name="building_id" placeholder="Podaj ID budynku" required> <!-- Pole do wprowadzenia ID budynku -->
        </div>
        <div class="mb-3">
            <label for="apartment_number" class="form-label">Numer Mieszkania:</label> <!-- Etykieta dla pola numeru mieszkania -->
            <input type="text" class="form-control" id="apartment_number" name="apartment_number" placeholder="Podaj numer mieszkania" required> <!-- Pole do wprowadzenia numeru mieszkania -->
        </div>
        <div class="mb-3">
            <label for="floor_number" class="form-label">Numer Piętra:</label> <!-- Etykieta dla pola numeru piętra -->
            <input type="number" class="form-control" id="floor_number" name="floor_number" placeholder="Podaj numer piętra" required> <!-- Pole do wprowadzenia numeru piętra -->
        </div>
        <div class="mb-3">
            <label for="size_sqm" class="form-label">Powierzchnia (m²):</label> <!-- Etykieta dla pola powierzchni mieszkania -->
            <input type="number" class="form-control" id="size_sqm" name="size_sqm" placeholder="Podaj powierzchnię w m²" required> <!-- Pole do wprowadzenia powierzchni mieszkania -->
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label> <!-- Etykieta dla pola statusu mieszkania -->
            <select class="form-select" id="status" name="status" required> <!-- Lista rozwijana do wyboru statusu mieszkania -->
                <option value="available">Dostępne</option> <!-- Opcja: mieszkanie dostępne -->
                <option value="rented">Wynajęte</option> <!-- Opcja: mieszkanie wynajęte -->
                <option value="maintenance">W trakcie naprawy</option> <!-- Opcja: mieszkanie w trakcie naprawy -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Mieszkanie</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_apartment.php` generuje formularz umożliwiający dodanie nowego mieszkania.-->
<!--- Formularz zawiera pola do wprowadzenia ID budynku, numeru mieszkania, numeru piętra, powierzchni mieszkania oraz statusu.-->
<!--- Status można wybrać z listy rozwijanej, zawierającej opcje: dostępne, wynajęte i w trakcie naprawy.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_apartment.php` za pomocą metody POST.-->
<!--*/-->
