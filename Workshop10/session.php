<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true, // set true if HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();
