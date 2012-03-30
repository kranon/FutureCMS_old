<?php
session_start();
include 'config.php';

$comm_text=$db->clearData($_POST['comment_text']);

$userId=$_POST['curr_user_id'];
$newsId=$_POST['news_id'];

if (isset($comm_text)&($comm_text!='')){
	$db->commentAdd($newsId, $userId, $comm_text);
}
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>
