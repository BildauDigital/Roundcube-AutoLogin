<?php

require_once('../../config.php');
require_once('RoundcubeAutoLogin.php');
session_start();
$email_permission = (int)($_SESSION['user_settings']['email_permission'] ?? 0);

if ($email_permission === 0) {
        header('Location: ' . BASE_URL);
} else {
    $rc = new RoundcubeAutoLogin(BASE_URL . 'public/mail/');
    $cookies = $rc->login('user', 'pass');
    foreach($cookies as $cookie_name => $cookie_value) {
        setcookie($cookie_name, $cookie_value, 0, '/', '');
    }
    $rc->redirect();
}
