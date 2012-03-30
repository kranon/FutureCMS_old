<?php
# Удаление меню #
include '../../config.php';
$id=$_POST['id'];
$text=$_POST['text'];

$db->commentEdit($id,$text);
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>
