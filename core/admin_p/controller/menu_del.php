<?php
# Удаление меню #
include '../../config.php';
$id=$_GET['id'];
$result = $db->query("SELECT `link` FROM `page` WHERE `lang1`='".$name."'");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
    $link = $row['link'];
}
if ($link!='index.php'){
    $db->MenuDel($id);
    $db->CloseDBConnection();
  	echo '1';
}
else{
    echo 'Главную страницу удалить нельзя!! <br /> <a href=../'.$link.'>'.$id.'</a>';
}
?>
