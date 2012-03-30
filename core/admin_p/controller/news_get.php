<?php session_start();
# Чтение данных из базы для "Редактирование новостей" #
include '../../config.php';
$json='';

$sql="SELECT `id`, `caption_lang1`, `date` FROM `news` ORDER BY `date` DESC;";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
    $json.='{"id":"'.$row['id'].'","caption":"'.$row['caption_lang1'].'","date":"'.$row['date'].'","count":"X"},';
}
$db->CloseDBConnection();
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '['.$json.']';
?>
