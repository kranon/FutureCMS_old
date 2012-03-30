<?php
# Удаление новости #
include('../../config.php');
$id=$_GET['id'];
$db->DelNews($id);
$db->CloseDBConnection();
echo '1';
//header('Location: ../view/pages.php?content=users'); 
?>
