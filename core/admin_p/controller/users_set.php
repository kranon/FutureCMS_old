<?php
# обработка listbox "Группа" 
# запись изменений в базу
include '../../config.php';
$result = $db->query("SELECT `id` FROM `users`");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){ 
	$sql="UPDATE `users` SET `group`='".$_POST[$row['id']]."' WHERE `id`='".$row['id']."'";
	$db->query($sql);
}
echo '1';
?>
