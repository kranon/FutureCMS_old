<?php
# Чтение данных из базы для "Настройки" #
include '../../config.php';
$sql="SELECT * FROM `settings`";
$result = $db->query($sql);
$i=1;
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$json.='"lang'.$i.'":{"siteName":"'.$row['siteName'].'","siteHeader":"'.$row['siteHeader'].'","siteFooter":"'.$row['siteFooter'].'","metaTitle":"'.$row['metaTitle'].'","metaKeywords":"'.$row['metaKeywords'].'","metaDescription":"'.$row['metaDescription'].'","metaCharset":"'.$row['metaCharset'].'"},';
	$i++;
}
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '[{'.$json.'}]';
?>