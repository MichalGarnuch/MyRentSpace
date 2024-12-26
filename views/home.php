<div>
    <h2 class="text-center">Lista dostępnych miejsc</h2>
    <table class="table table-striped mt-4"> <!-- Tabela z dynamicznymi danymi -->
        <thead>
        <tr>
            <th>#</th> <!-- Nagłówek numeru -->
            <th>Nazwa</th> <!-- Nagłówek nazwy -->
            <th>Opis</th> <!-- Nagłówek opisu -->
        </tr>
        </thead>
        <tbody>
        <?php
        // Generowanie wierszy za pomocą PHP
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>
                      <td>{$i}</td>
                      <td>Nazwa {$i}</td>
                      <td>Opis dla wiersza {$i}</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
