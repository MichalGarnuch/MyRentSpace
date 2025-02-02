<?php
session_start();

/**
 * Sprawdza, czy użytkownik jest zalogowany.
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Sprawdza, czy użytkownik ma rolę administratora.
 * @return bool
 */
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Sprawdza, czy użytkownik może dodawać dane.
 * @return bool
 */
function canAddData() {
    return isLoggedIn(); // Każdy zalogowany użytkownik może dodawać dane
}
?>
