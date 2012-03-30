<?php
# Удаление меню #
include '../../config.php';
$id=$_GET['id'];

$db->query("DELETE FROM `news_comments` WHERE `id` = '".$id."'");
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>
