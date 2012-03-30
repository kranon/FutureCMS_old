<?php
# Чтение данных из базы для "Редактирование меню" #
include '../../config.php';
//$grop=$_POST['grop'];
$sql="SELECT `id`,`num`,`lang1`,`lang2`,`link`,`published`,`in` FROM `menu` ORDER BY `num`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$json.='{"id":"'.$row['id'].'","name_lang1":"'.$row['lang1'].'","name_lang2":"'.$row['lang2'].'","link":"'.$row['link'].'","inm":"'.$row['in'].'","publ":"'.$row['published'].'","num":"'.$row['num'].'"},';
}	
$db->CloseDBConnection();
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '['.$json.']';
?>