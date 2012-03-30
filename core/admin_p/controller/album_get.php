<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';
$grop=$_POST['grop'];

$sql="SELECT `id`,`name_lang1`,`name_lang2`,`link`,`date` FROM `gallery` ORDER BY `date`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$json.='{"id":"'.$row['id'].'","name_lang1":"'.$row['name_lang1'].'","name_lang2":"'.$row['name_lang2'].'","link":"'.$row['link'].'","date":"'.$row['date'].'"},';
}	
$db->CloseDBConnection();
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '['.$json.']';
?>