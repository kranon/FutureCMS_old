<?php
# Добавление нового альбома #
include '../../config.php';
// проверить входные данные !!!!
$name = $_POST['name'];

$link=$db->translitIt($name);

$sql="INSERT INTO `gallery` (
							`name_lang1`,
							`link`,
							`date`
							)
					VALUES (
							'".$name."',
							'".$link."',
							NOW()
						)";
$db->query($sql);

// Данная функция не будет работать если в php включен безопасный режим (safe_mode = on)
mkdir('../../../gallery/'.$link);
mkdir('../../../gallery/'.$link.'/thumbs');
echo '1';
?>