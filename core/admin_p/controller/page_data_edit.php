<?php
# сохранение изменений на странице
include '../../config.php';

$id=$_POST['id'];

$page=array(
	'id'=>$id,
	'name'=>array(
		'lang1'=>$_POST['name_lang1'],
		'lang2'=>$_POST['name_lang2']
	),
	'text'=>array(
		'lang1'=>$_POST['editor_lang1'],
		'lang2'=>$_POST['editor_lang2']
	)
);

//print_r($page);
$db->AddText($page);

$db->CloseDBConnection();
header('Location: ../view/pages.php?content=page_edit&id='.$id);
exit;
?>