<?php
$album=$_GET['album'];
$name=$_GET['name'];

unlink("../../../gallery/$album/$name") or die("Ошибка удаления foto!");
unlink("../../../gallery/$album/thumbs/$name") or die("Ошибка удаления thumb!");

header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>