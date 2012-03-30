<?php
# сохранение состояния страниц "в меню"(checkbox)

include '../../config.php';

$sql="SELECT `id`,`lang1`,`link`,`in_menu` FROM `page`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	if ($_POST['menu_'.$row['id']]=='1') { $in_menu=1; }
		else { $in_menu=0; }

	if (($row['in_menu']==0) & ($in_menu==1)){
		$menu=array(
			'name'=>$row['lang1'],
			'link'=>$row['link'],
			'publ'=>$in_menu,
			'in'=>'0'
		);
		$db->MenuAdd($menu);
	}
	$db->query("UPDATE `page` SET `in_menu`='".$in_menu."' WHERE `page`.`link`='".$row['link']."'");
	$db->query("UPDATE `menu` SET `published`='".$in_menu."' WHERE `menu`.`link`='".$row['link']."'");
}
$db->CloseDBConnection();
?>