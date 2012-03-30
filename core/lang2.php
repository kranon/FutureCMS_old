<?php
session_start();
$_SESSION['lang']='lang2';
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>
