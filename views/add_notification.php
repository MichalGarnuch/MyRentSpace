<div class="container mt-4"> <!-- Główny kontener formularza dodawania powiadomienia -->
    <h1 class="mb-4">Dodaj Powiadomienie</h1> <!-- Nagłówek strony -->
    <form method="POST" action="controllers/save_notification.php"> <!-- Formularz przesyła dane do kontrolera save_notification.php metodą POST -->
        <div class="mb-3">
            <label for="user_id" class="form-label">ID Użytkownika:</label> <!-- Etykieta dla pola ID użytkownika -->
            <input type="number" class="form-control" id="user_id" name="user_id" placeholder="Podaj ID użytkownika" required> <!-- Pole do wprowadzenia ID użytkownika -->
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Treść Powiadomienia:</label> <!-- Etykieta dla pola treści powiadomienia -->
            <textarea class="form-control" id="message" name="message" placeholder="Podaj treść powiadomienia" required></textarea> <!-- Pole do wprowadzenia treści powiadomienia -->
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Typ Powiadomienia:</label> <!-- Etykieta dla pola typu powiadomienia -->
            <select class="form-select" id="type" name="type" required> <!-- Lista rozwijana do wyboru typu powiadomienia -->
                <option value="reminder">Przypomnienie</option> <!-- Opcja: przypomnienie -->
                <option value="info">Informacja</option> <!-- Opcja: informacja -->
                <option value="alert">Alert</option> <!-- Opcja: alert -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Dodaj Powiadomienie</button> <!-- Przycisk wysyłający formularz -->
    </form>
</div>

<!--/*-->
<!--Kluczowe informacje:-->
<!--- Plik `add_notification.php` generuje formularz umożliwiający dodanie nowego powiadomienia.-->
<!--- Formularz zawiera pola do wprowadzenia ID użytkownika, treści powiadomienia oraz typu powiadomienia.-->
<!--- Typ powiadomienia można wybrać z listy rozwijanej, zawierającej opcje: przypomnienie, informacja oraz alert.-->
<!--- Wszystkie pola są wymagane (`required`), co wymusza ich wypełnienie przed wysłaniem formularza.-->
<!--- Dane są przesyłane do kontrolera `save_notification.php` za pomocą metody POST.-->
<!--*/-->
