<?php
# Редактирование настроек сайта.
include '../../config.php';

$mainPage=$_POST['main_html_data'];
$otherPage=$_POST['other_html_data'];

$handle = fopen("../../html_templates/html_template.php".$link, "w");
	fwrite($handle, $mainPage);
	fclose($handle);
echo '1';
?> 