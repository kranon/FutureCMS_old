<?php
session_start();
$_SESSION['lang']='lang1';
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>