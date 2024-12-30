<div class="container mt-4"> <!-- Główny kontener formularza dodawania budynku -->
    <h1 class="mb-4">Dodaj Budynek</h1> <!-- Nagłówek strony -->
    <form method="POST" action="index.php?action=save_building" <!-- Formularz przesyła dane do kontrolera save_building.php metodą POST -->
        <div class="mb-3">
            <label for="street" class="form-label">Ulica:</label> <!-- Etykieta dla pola ulicy -->
            <input type="text" class="form-control" id="street" name="street" placeholder="Podaj ulicę" required> <!-- Pole do wprowadzenia nazwy ulicy -->
        </div>
        <div class="mb-3">
            <label for="building_number" class="form-label">Numer Budynku:</label> <!-- Etykieta dla pola numeru budynku -->
            <input type="text" class="form-control" id="building_number" name="building_number" placeholder="Podaj numer budynku" required> <!-- Pole do wprowadzenia numeru budynku -->
        </div>
        <div class="mb-3">
            <label for="total_floors" class="form-label">Liczba Pięter:</label> <!-- Etykieta dla pola liczby pięter -->
            <input type="number" class="form-control" id="total_floors" name="total_floors" placeholder="Podaj liczbę pięter" required> <!-- Pole do wprowadzenia liczby pięter -->
        </div>
        <button type="submit" class="btn btn-success">Dodaj</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_building.php` generuje formularz umożliwiający dodanie nowego budynku.-->
<!--- Formularz zawiera pola do wprowadzenia nazwy ulicy, numeru budynku oraz liczby pięter.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_building.php` za pomocą metody POST.-->
<!--*/-->