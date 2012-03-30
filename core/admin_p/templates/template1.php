<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <title>'.$title.'</title>
            <meta name="title" content="" />
            <meta name="keywords" content="" />
            <meta name="description" content="" />
            <link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />
            <link href="tabs.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="../../js/jquery.js"></script>
			<script type="text/javascript" src="../controller/js/tableLine.js"></script>
			<script type="text/javascript" src="../controller/uploadify/swfobject.js"></script>
			<script type="text/javascript" src="../controller/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
			<script type="text/javascript" src="../controller/js/ui.core.js"></script>
			<script type="text/javascript" src="../controller/js/ui.tabs.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					$(\'#tabSet\').tabs();
				});
			</script>
		
		</head>
        <body>
        <div id="wrapper">
            <div id="header">
                '.$header.'
				<a href="../../../index.php" target="_blank">Посмотреть сайт</a>
                <div id="user">'.$logout.'</div>
            </div><!-- #header-->
            <div id="middle">
                <div id="container">
                    <div id="content">
					<div id="mess"></div>';
  // Редактирование страниц
    if ($content=='pages'){
		echo '<script type="text/javascript" src="../controller/js/ajax_page.js"></script>
		<form enctype="multipart/form-data" action="../controller/page_pub.php" method="post" name="page_pub" id="page_pub">
			<table border="1" cellpadding="0" cellspacing="0">
				<thead id="head">
					<th><b>&nbsp;Редактирование&nbsp;</b></th>
					<th><b>&nbsp;Ссылка&nbsp;</b></th>';
		if ($_SESSION['group']=='1'){
			echo '<th><b>&nbsp;В меню&nbsp;</b></th><th><b>&nbsp;Del&nbsp;</b></th>';
		}
		echo'</thead><tbody id="tbody"></tbody></table></form>';
	    // Добавление страницы
		if ($_SESSION['group']=='1'){
			echo '<div id="add_pg">
                    <form method="post" action="../../page_add.php" name="add_page" id="add_page" class="form">
                        <b>Введите имя новой страницы:</b><br />
                        <input type="text" name="name" class="in_text"/><br />
                        <input type="checkbox" name="add_in_menu" /><b>Добавить в меню</b><br />
                        <input type="submit" id="add_page_sub" value=" Добавить страницу "/>
                    </form>
                </div><br />';
 		}
    }
   	// Редактирование новостей
    if ($content=='news'){
    	echo '<script type="text/javascript" src="../controller/js/ajax_news.js"></script>
			<table border="1" cellpadding="0" cellspacing="0">
				<thead id="head">
					<th><b>&nbsp;ID&nbsp;</b></th>
					<th><b>&nbsp;Редактирование&nbsp;</b></th>
					<th><b>&nbsp;Дата&nbsp;</b></th>';
		if ($_SESSION['group']=='1'){
			echo '<th><b>&nbsp;Удаление&nbsp;</b></th>';
		}
		echo'</thead><tbody id="tbody"></tbody></table>';
	    // Добавление новости
		if ($_SESSION['group']=='1'){
			echo '<div id="add_nws">
                    <form method="post" action="../controller/add_news.php" name="add_news" id="add_news" class="form">
                        <b>Введите заголовок новости:</b><br />
                        <input type="text" name="caption" class="in_text"/><br />
                        <input type="submit" id="add_news_sub" value=" Добавить новость "/>
                    </form>
                </div><br />';
        }
    }

if ($_SESSION['group']=='1'){
  // Редактирование пользователей
	if ($content=='users'){
		echo '<script type="text/javascript" src="../controller/js/ajax_user.js"></script>
		<span id="users_count"></span>
        <form enctype="multipart/form-data" action="../controller/user_save.php" method="post" name="user_inf" id="user_inf">
        <table border="1" cellpadding="0" cellspacing="0">
            <thead class="head">
                <th><b>&nbsp;ID&nbsp;</b></th>
                <th><b>&nbsp;Логин&nbsp;</b></th>
                <th><b>&nbsp;Пароль&nbsp;</b></th>
                <th><b>&nbsp;E-mail&nbsp;</b></th>
                <th><b>&nbsp;Пол&nbsp;</b></th>
                <th><b>&nbsp;Группа&nbsp;</b></th>
                <th><b>&nbsp;Дата регистрации&nbsp;</b></th>
                <th><b>&nbsp;Аватар&nbsp;</b></th>
                <th><b>&nbsp;Удаление&nbsp;</b></th>
            </thead><tbody id="tbody"></tbody>
            </table></form>';
        // Добавление нового пользователя
        $all='<option value=1>Администратор</option><option value=2>Модератор</option><option value=3 selected>Пользователь</option>';
		include '../../classes/auth.class.php';
		$word=$db->WordsTranslate('lang2');
		Auth::ShowRegForm($word,'../controller/users_add.php');
    }
   // Редактирование меню
    if ($content=='menu'){
		echo '<script type="text/javascript" src="../controller/js/ajax_menu.js"></script>
		<form enctype="multipart/form-data" action="../controller/menu_pub_set.php" method="post" name="menu_pub" id="menu_pub">
		<table border="1" cellpadding="0" cellspacing="0">
		<thead class="head">
			<th><b>&nbsp;ID&nbsp;</b></th>
			<th><b>&nbsp;№&nbsp;</b></th>
			<th><b>&nbsp;Имя BY&nbsp;</b></th>
			<th><b>&nbsp;Имя RU&nbsp;</b></th>
			<th><b>&nbsp;Ссылка&nbsp;</b></th>
			<th><b>&nbsp;Вложено в &nbsp;</b></th>
			<th><b>&nbsp;Опубликовать&nbsp;</b></th>
			<th><b>&nbsp;Удалить&nbsp;</b></th>
		</thead><tbody id="tbody_menu"></tbody>
		</table></form>
		
		<div id="add_mn">
            <form method="post" action="../controller/menu_add.php" name="add_menu" id="add_menu" onclick="" class="form">
                <b>Введите имя меню:</b><br />
				<input type="text" name="name" class="in_text"/><br />
                <b>Ссылка:</b><br />
                <input type="text" name="link" class="in_text"/><br />
   				<input type="checkbox" name="publ" /> <b>Опубликовать</b><br />
                <input type="text" name="in" size="3" /> <b>Вложено в</b><br />
                <input type="submit" id="add_menu_sub" value=" Добавить меню "/>
            </form></div><br />';
    }
   //Редактирование галереи
    if ($content=='gallery'){
        echo '<script type="text/javascript" src="../controller/js/ajax_gallery.js"></script>
			<form enctype="multipart/form-data" action="../controller/album_pub.php" method="post" name="gallery_ed">
            <table border="1" cellpadding="0" cellspacing="0">
            <thead class="head">
                <th><b>&nbsp;ID&nbsp;</b></th>
                <th><b>&nbsp;Имя (язык1)&nbsp;</b></th>
                <th><b>&nbsp;Имя (язык2)&nbsp;</b></th>
				<th><b>&nbsp;Дата&nbsp;</b></th>
                <th><b>&nbsp;Удалить&nbsp;</b></th>
            </thead>
		<tbody id="tbody_gallery"></tbody>';
		echo '</table></form>';

        // Добавление альбома    
        echo '<br /><div id="add_menu">
            <form method="post" action="../controller/album_add.php" name="add_album" id="add_album" onclick="" class="form">
				<b>Введите имя нового альбома:</b><br />
                <input type="text" name="name" class="in_text"/><br />
                <input type="submit" id="add_album_sub" value=" Добавить альбом "/>
            </form></div>';
    }
    //Редактирование альбома
    if ($content=='album'){
        $album_id=$_GET['id'];
		$sql="SELECT `name_lang1`,`name_lang2`,`link` FROM `gallery` WHERE `id`=".$album_id;
        $result = $db->query($sql);
        while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
			$album_data=array(
				'name_lang1'=>$row['name_lang1'],
				'name_lang2'=>$row['name_lang2'],
				'link'=>$row['link']
			);
        }
        $mas=$db->OpenAlbum($album_id,'../../../');
        $n=(int)count($mas);
		echo '<script type="text/javascript" src="../controller/js/ajax_gallery.js"></script>
			<form method="post" action="../controller/album_edit.php" name="edit_album" id="edit_album" class="form">
			Название альбома:<br />
			Язык 1<br />
			<input type="text" name="name_lang1" value="'.$album_data['name_lang1'].'"><br />
			Язык 2<br />
			<input type="text" name="name_lang2" value="'.$album_data['name_lang2'].'"><br />
			<input type="hidden" name="id" value="'.$album_id.'"><br />
		</form>';
		if ($n>0){
			echo 'Всего фотографий: '.$n.'
			<table border="1" cellpadding="0" cellspacing="0">
            <thead class="head">
                <th><b>&nbsp;Фото&nbsp;</b></th>
                <th><b>&nbsp;Имя&nbsp;</b></th>
				<th><b>&nbsp;Удалить&nbsp;</b></th>
			</thead><tbody>';
			foreach($mas as $fileName){
				echo '<tr><td><img src="../../../gallery/'.$album_data['link'].'/thumbs/'.$fileName.'"width="100" height="100"></td>
					<td align="center" width="250">'.$fileName.'</td>
					<td align="center"><a href="../controller/foto_del.php?album='.$album_data['link'].'&name='.$fileName.'">Удалить</a></td></tr>';
			}
			echo '</tbody></table>';
		}
        
        // Добавление фотографии
		echo '<script type="text/javascript">
				// <![CDATA[
				$(document).ready(function(){
					$(\'#file_upload\').uploadify({
						\'uploader\'  : \'../controller/uploadify/uploadify.swf\',
						\'script\'    : \'../controller/foto_load.php?link='.$album_data['link'].'\',
						\'cancelImg\' : \'../controller/uploadify/cancel.png\',
						\'folder\'    : \'../controller/uploads\',
						\'auto\'      : true,
						\'multi\'     : true,
						\'fileDesc\'  : \'Images (jpg, jpeg)\',						
						\'fileExt\'   : \'*.jpeg;*.jpg;*.JPG;\'
					});
				});
				// ]]>
			</script>';
		echo '<input id="file_upload" type="file" name="file_upload" />';
    }
	//Настройки сайта
    if ($content=='settings'){
		echo '<link href="../view/tabs.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" src="../controller/js/ui.core.js"></script>
		<script type="text/javascript" src="../controller/js/ui.tabs.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
			  $(\'#tabSet\').tabs();
			  $(\'#tabSet2\').tabs();
			});
		</script>';
		echo '<script type="text/javascript" src="../controller/js/ajax_settings.js"></script>
			<ul id="tabSet">
					<li><a href="#lang1">Язык 1</a></li>
					<li><a href="#lang2">Язык 2</a></li>
				</ul>
			<div id="lang1">
				<b>Сайт:</b>
				<form method="post" action="#" name="edit_settings_lang1" id="edit_settings_lang1" class="form">
				Name:<br />
				<input type="text" name="site_name_lang1" id="site_name_lang1"><br />
				Header:<br />
				<textarea name="site_header_lang1" id="site_header_lang1"></textarea><br />
				Footer:<br />
				<textarea name="site_footer_lang1" id="site_footer_lang1"></textarea>
				<br />
				
				<b>Мета теги:</b><br />
				Title:<br />
				<textarea name="meta_title_lang1" id="meta_title_lang1"></textarea>
				Keywords:<br />
				<textarea name="meta_keywords_lang1" id="meta_keywords_lang1"></textarea>
				Description:<br />
				<textarea name="meta_description_lang1" id="meta_description_lang1"></textarea>
				Charset:<br />
				<input type="text" name="meta_charset_lang1" id="meta_charset_lang1"><br />
				<input type="hidden" name="lang" value="lang1"><br />
				</form>
			</div>
			
			<div id="lang2">
				<b>Сайт:</b>
				<form method="post" action="#" name="edit_settings_lang2" id="edit_settings_lang2" class="form">
				Name:<br />
				<input type="text" name="site_name_lang2" id="site_name_lang2"><br />
				Header:<br />
				<textarea name="site_header_lang2" id="site_header_lang2"></textarea><br />
				Footer:<br />
				<textarea name="site_footer_lang2" id="site_footer_lang2"></textarea>
				<br />
				
				<b>Мета теги:</b><br />
				Title:<br />
				<textarea name="meta_title_lang2" id="meta_title_lang2"></textarea>
				Keywords:<br />
				<textarea name="meta_keywords_lang2" id="meta_keywords_lang2"></textarea>
				Description:<br />
				<textarea name="meta_description_lang2" id="meta_description_lang2"></textarea>
				Charset:<br />
				<input type="text" name="meta_charset_lang2" id="meta_charset_lang2"><br />
				<input type="hidden" name="lang" value="lang2"><br />
				</form>
			</div><br />';
		
		echo '<ul id="tabSet2">
					<li><a href="#main_html">HTML-шаблон главной страницы</a></li>
					<li><a href="#other_html">HTML-шаблон остальных страниц</a></li>
			</ul>
			<form method="post" action="#" name="edit_settings_html" id="edit_settings_html" class="form">	
				<div id="main_html">
					<textarea rows="40" cols="89" name="main_html_data" id="main_html_data" ></textarea>
				</div>
				<div id="other_html">
					<textarea rows="40" cols="89" name="other_html_data" id="other_html_data"></textarea>
				</div><br />
				<input type="button" id="save_btn" value=" Сохранить ">
			</form>';
	}
	if ($content=='page_edit'){
		echo 'Редактирование новостей <a href="../../../read_news.php?id='.$id.'" target="_blank">Посмотреть страницу</a>';
		$id = $_GET['id'];
		
		$sql="SELECT `lang1`,`lang2`,`text_lang1`,`text_lang2`,`link` FROM `page` WHERE `id` = '" . $id . "'";
		$result = $db->query($sql);
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			$text = array(
				'lang1'=>$row['text_lang1'],
				'lang2'=>$row['text_lang2']
			);
			$name=array(
				'lang1'=>$row['lang1'],
				'lang2'=>$row['lang2']
			);

			$link = $row['link'];
		}
		
		
		echo '<ul id="tabSet">
					<li><a href="#lang1">Язык 1</a></li>
					<li><a href="#lang2">Язык 2</a></li>
				</ul>
				<div id="lang1">';

		include '../../../fckeditor/fckeditor_php5.php';
		echo '<form method="post" name="about" id="about" action="page_data_edit.php">
		Имя страницы <br />
		<textarea name="name_lang1" rows="2" cols="89">'.$name['lang1'].'</textarea><br /><br />
		Текст страницы<br />';

		$dd = new FCKeditor("editor_lang1");
		$dd->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
		$dd->Value = $text['lang1'];
		$dd->Create();

		echo '<input type="hidden" name="id" value="'.$id.'"></div>
		<div id="lang2">
		Имя страницы <br />
		<textarea name="name_lang2" rows="2" cols="89">'.$name['lang2'].'</textarea><br /><br />
		Текст страницы<br />';

		$dd_ru = new FCKeditor("editor_lang2");
		$dd_ru->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
		$dd_ru->Value = $text['lang2'];
		$dd_ru->Create();
		echo '<input type="hidden" name="id" value="' . $id . '">
		</div>
		<input type="submit" id="addText" value="Сохранить">
		</form>
		</div><!-- #content-->
				</div><!-- #container-->
				<div class="sidebar" id="sideLeft">
					<div id="menu">
						'.$menu.'
					</div><br /><div id="pages"><p>Список страниц:<br />';
		// Создания списка страниц
		$sql="SELECT `id`,`lang1` FROM `page` ORDER BY `lang1` ASC;";
		$result = $db->query($sql);
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
			echo '<a href="../view/pages.php?content=page_edit&id='.$row['id'].'">'.$row['lang1'].'</a><br />';
		}
	}
	if ($content=='news_edit'){
		
		$id=$_GET['id'];
		$sql="SELECT `caption_lang1`,`text_lang1`,`caption_lang2`,`text_lang2` FROM `news` WHERE `id` = ".$id.";";
		$result = $db->query($sql);
		while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
			$text = array(
				'lang1'=>$row['text_lang1'],
				'lang2'=>$row['text_lang2']
			);

			$caption = array(
				'lang1'=>$row['caption_lang1'],
				'lang2'=>$row['caption_lang2']
			);
		}
		
		
		echo '<ul id="tabSet">
				<li><a href="#lang1">Язык 1</a></li>
				<li><a href="#lang2">Язык 2</a></li>
			</ul>';

		include '../../../fckeditor/fckeditor_php5.php'; 
		echo '<form method="post" name="about" id="about" action="news_edit_data.php">
		<div id="lang1">
		Заголовок<br /><textarea name="caption_lang1" rows="3" cols="100">'.$caption['lang1'].'</textarea><br /><br />';

		$dd = new FCKeditor("editor_lang1");
		$dd->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
		$dd->Value = $text['lang1'];    
		$dd->Create();
		echo '<input type="hidden" name="id" value="'.$id.'"></div>
			<div id="lang2">
		Заголовок <br /><textarea name="caption_lang2" rows="3" cols="100">'.$caption['lang2'].'</textarea><br /><br />';

		$dd2 = new FCKeditor("editor_lang2");
		$dd2->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
		$dd2->Value = $text['lang2'];
		$dd2->Create();

		echo '<input type="hidden" name="id" value="'.$id.'"></div>    
		<input type="submit" id="addText" value="Сохранить">
		</form><br />
		<p>Комментарии:</p>';
		$mas=$db->commentRead($id);
		if (isset($mas)){
			foreach ($mas as $val){
				echo '<div class="comment">
				<div class="com_ava"><a href="O_polzovatele.php?login='.$val['users_login'].'"><img src="../../../'.$val['users_ava'].'" /></a></div>
				<div class="com_name_date">
					<a href="O_polzovatele.php?login='.$val['users_login'].'">
					<span class="com_username">'.$val['users_login'].'</span>
					</a> | 
					<span class="com_date">'.$val['datetime'].'</span>
				</div>
				<span class="com_del"><a href="news_comment_del.php?id='.$val['id'].'" class="news_comment_del"><img src="../view/del.png"></a></span>
				<span class="com_text"><textarea rows="5" cols="87">'.$val['text'].'</textarea></span>
				</div>';
			}
		}
		echo '</div><!-- #content-->
</div><!-- #container-->
<div class="sidebar" id="sideLeft">
<div id="menu">'.$menu.'</div><br />
<div id="pages"><p>Список новостей:<br />';

// Создания списка новостей
$sql="SELECT `id`,`caption_lang1` FROM `news`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	echo '<a href="../view/pages.php?content=news_edit&id='.$row['id'].'">'.$row['id'].' - '.$row['caption_lang1'].'</a><br />';
}
		
		
		
	}
}

echo'</div><!-- #content-->
</div><!-- #container-->
<div class="sidebar" id="sideLeft">
<div id="menu">'.$menu.'</div>
</div><!-- .sidebar#sideLeft -->
</div><!-- #middle-->
</div><!-- #wrapper -->
<div id="footer">'.$footer.'</div><!-- #footer -->
</body>
</html>';
?>