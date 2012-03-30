<?php
# Добавление новой новости #
include '../../config.php';
$caption = htmlspecialchars($_POST['caption'], ENT_QUOTES); // замена кавычек соответствующими html сущностями
$db->AddNews($caption);
echo '1';
?>