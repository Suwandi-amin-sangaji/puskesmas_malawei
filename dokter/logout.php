<?php
// mengaktifkan session
session_start();

$_SESSION = [];

session_unset();

// menghapus semua session
session_destroy();

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

echo "<script language='javascript'>alert('Anda Telah Logout !!!'); document.location.href='../'; </script>";