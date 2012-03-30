<?php
include 'classes/base.class.php';
$db = new DataBase('localhost','root','root');
$db->SelectDataBase('future_cms');

// !!! сохранить данные в файле для уменьшения запросов к БД
$sql="SELECT `id`,`siteName`,`siteHeader`,`siteFooter`,`metaTitle`,`metaKeywords`,`metaDescription`,`metaCharset` FROM `settings`";
$res=$db->query($sql);
while ($row = mysql_fetch_array($res)){
	$meta['lang'.$row['id']]=array(
			'title'=>$row['metaTitle'],
			'keywords'=>$row['metaKeywords'],
			'description'=>$row['metaDescription'],
			'charset'=>$row['metaCharset']
	);
	$site['lang'.$row['id']]=array(
			'name'=>$row['siteName'],
			'header'=>$row['siteHeader'],
			'footer'=>$row['siteFooter']
		);
}
// год - № недели - день недели
$site['version']='12.13.5';
?>
