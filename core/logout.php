<?php
session_start();
unset($_SESSION['ava']);
unset($_SESSION['login']);
unset($_SESSION['group']);
session_destroy();
header('Location: ../Avtorizatsiya.php');
exit;
?>
