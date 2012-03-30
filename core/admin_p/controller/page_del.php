<?php
# Удаление страницы #
include '../../config.php';
$id=$_GET['id'];
$result = mysql_query("SELECT `link`,`lang1` FROM `page` WHERE `id`='".$id."'");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$link = $row['link'];
	$name=$row['lang1'];
}
// Проверка, чтобы не удалить главную страницу и другие
if (($link!='index.php')&&($link!='Avtorizatsiya.php')&&($link!='Registratsiya.php')&&($link!='Galereya.php'))
{
	$result = mysql_query("SELECT `menu`.`id` FROM `menu`,`page` WHERE `page`.`id`=".$id." and `menu`.`link`=`page`.`link`");
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
		$id_menu = $row['id'];
	}
	$db->MenuDel($id_menu);
	$db->PageDel($id);
	$db->CloseDBConnection();
	//header('Location: admin_p/view/pages.php?content=pages');
	echo '1';
}
else
{
	//echo 'Страницу '.$name.' удалить нельзя!! <br /> <a href='.$_SERVER['HTTP_REFERER'].'>Назад</a>';
	echo 'Страницу '.$name.' удалить нельзя!!';
}
?>
