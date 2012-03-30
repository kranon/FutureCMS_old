<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';

$id=$_POST['id'];
$name_lang1=$_POST['name_lang1'];
$name_lang2=$_POST['name_lang2'];

$sql="UPDATE `gallery` SET 
						`name_lang1`='".$name_lang1."',
						`name_lang2`='".$name_lang2."'
	WHERE `id`='".$id."'";
$db->query($sql);
?>