<?php session_start();
include 'core/config.php';
if ($_SESSION['lang']=='lang2'){
	$lang='lang2';
	$name='Новости';
}
else { 
	$lang='lang1'; 
	$name='Навiны';
}

$link='index.php';

$title=$site[$lang]['name'];
$header=$site[$lang]['header'];
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);

$news_id=$_GET['id'];


// Если id - число и больше нуля
if ((settype($news_id,int))|($news_id>=0)){
	if ($news_id==0){
	}
	else{
		$result = $db->query("SELECT `id` FROM `news` WHERE `id`='".$news_id."';");
		if (mysql_num_rows($result)==0){
			$form.= 'Новости с таким ID не существует!';
		}
		else{
			$error='';
			// Чтение данных новостей
			$sql="SELECT `caption_".$lang."`, `text_".$lang."` FROM `news` WHERE `id`=".$news_id;
			$result = $db->query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$name=$row['caption_'.$lang];
			}
			$title .=' - '.$name;
		}
	}
}
else{
	header('Location: index.php');
	exit;
}

if ($news_id==0){
	$form.=$db->ReadNews('all',$lang);
}
else{
	$form.=$db->ReadNewsText($news_id,$lang);
	$form.=$error;
	$mas=$db->commentRead($news_id);
	if (isset($mas)){
		$form.= '<p id="comm_title">Комментарии:</p>';
		foreach ($mas as $val){
			$form.= '<div class="comment">
				<div class="com_ava"><a href="O_polzovatele.php?login='.$val['users_login'].'"><img src="'.$val['users_ava'].'" /></a></div>
				<div class="com_name_date">
				<a href="O_polzovatele.php?login='.$val['users_login'].'">
				<span class="com_username">'.$val['users_login'].'</span>
				</a> | 
				<span class="com_date">'.$val['datetime'].'</span>
				</div>
				<span class="com_text">'.$val['text'].'</span>
				</div>';
		}
	}
	if ($_SESSION['login']==NULL){
		echo $word[20].' <a href="Avtorizatsiya.php">'.$word[1].'</a> '.$word[21].' <a href="Registratsiya.php">'.$word[2].'</a>';
	}
	else{
		$sql="SELECT `id` FROM `users` WHERE `login`='".$_SESSION['login']."';";
		$res=$db->query($sql);
		while ($row = mysql_fetch_array($res, MYSQL_BOTH)){
			$curr_user_id=$row['id'];
		}
		$form.= '<div>
			'.$word[19].'<br />
			<form method="post" action="core/commentAdd.php">
			<textarea rows="6" cols="100" name="comment_text" ></textarea><br />
			<input type="hidden" name="curr_user_id" value="'.$curr_user_id.'">
			<input type="hidden" name="news_id" value="'.$news_id.'">
			<input type="submit" value="'.$word[18].'">
			</form>
			</div>';
		}
}

include 'core/html_templates/other_page_html.php';
?>