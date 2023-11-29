<?php
session_start();

session_destroy();
setcookie('token', expires_or_options: time()-1, httponly: true);

header('Location: /index.php');
exit;