<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];
    $related_id = !empty($_POST['related_id']) ? intval($_POST['related_id']) : NULL;

    if (!empty($username) && strlen($password) >= 6) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, role, related_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $password_hash, $role, $related_id);

        if ($stmt->execute()) {
            header("Location: index.php?view=login&success=registered");
            exit();
        } else {
            $error = "Błąd rejestracji.";
        }
    } else {
        $error = "Niepoprawne dane.";
    }
}
?>

<div class="container">
    <h2>Rejestracja</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Nazwa użytkownika" required class="form-control mb-2">
        <input type="password" name="password" placeholder="Hasło (min. 6 znaków)" required class="form-control mb-2">
        <select name="role" class="form-control mb-2" required>
            <option value="tenant">Najemca</option>
            <option value="owner">Właściciel</option>
            <option value="admin">Administrator</option>
        </select>
        <input type="number" name="related_id" placeholder="Powiązane ID (jeśli dotyczy)" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Zarejestruj się</button>
    </form>
</div>
