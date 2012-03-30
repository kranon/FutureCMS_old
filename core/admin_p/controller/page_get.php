<?php session_start();
# Чтение данных из базы для "Редактирование страниц" #
include '../../config.php';
$json='';
$result = mysql_query("SELECT `id`, `lang1`, `link`,`in_menu` FROM `page` ORDER BY `lang1` ASC;") or die(mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
    $json.='{"id":"'.$row['id'].'","name":"'.$row['lang1'].'","link":"'.$row['link'].'","publ":"'.$row['published'].'","in_menu":"'.$row['in_menu'].'", "group":"'.$_SESSION['group'].'"},';
}
$db->CloseDBConnection();
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '['.$json.']';
?>