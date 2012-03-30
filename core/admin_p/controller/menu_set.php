<?php
# Редактирование меню. Обработка checkbox "Опубликовать", "Id", "Вложено в"
include '../../config.php';
$result = $db->query("SELECT `id`,`num`,`link`,`in` FROM `menu`");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	if ($_POST[$row['id']]==1) { $pub=1; }
		else { $pub=0; }
	$id_menu=$_POST['id_'.$row['id']];
	$in=$_POST['in_'.$row['id']];
	$name_lang1=$_POST['name_lang1_'.$row['id']];
	$name_lang2=$_POST['name_lang2_'.$row['id']];
	$link=$_POST['link_'.$row['id']];
	
	$sql="UPDATE `menu` SET `num`='".$id_menu."',
							`published`='".$pub."',
							`in`='".$in."',
							`lang1`='".$name_lang1."',
							`lang2`='".$name_lang2."',
							`link`='".$link."' 
		WHERE `id`='".$row['id']."'";
	$db->query($sql);
	
	$sql="UPDATE `page` SET 
							`in_menu`='".$pub."'
		WHERE `link`='".$row['link']."'";
	$db->query($sql);
}
$db->CloseDBConnection();
echo '1';
?>
  