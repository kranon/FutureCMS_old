<?php
# Удаление пользователя
include '../../config.php';
$id=$_GET['id'];
$id= $db->ClearData($id);
$db->userDel($id);
$db->CloseDBConnection();
echo '1';
?>