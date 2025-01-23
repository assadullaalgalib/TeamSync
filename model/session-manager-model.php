<?php

function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function setSession($key, $value) {
    startSession();
    $_SESSION[$key] = $value;
}

function getSession($key) {
    startSession();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

function sessionExists($key) {
    startSession();
    return isset($_SESSION[$key]);
}

function removeSession($key) {
    startSession();
    unset($_SESSION[$key]);
}

function destroySession() {
    startSession();
    session_unset();
    session_destroy();
}

?>