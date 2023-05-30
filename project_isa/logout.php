<?php
session_start();

// Hapus session login_user
unset($_SESSION['login_user']);

// Redirect ke halaman login
header("location: login.php");
exit;
?>
