<?php $group=$_SESSION['group'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $title;?></title>
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
		<link href="../view/tabs.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../../js/jquery.js"></script>
		<script type="text/javascript" src="../controller/uploadify/swfobject.js"></script>
		<script type="text/javascript" src="../controller/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
		<script type="text/javascript" src="../controller/js/ui.core.js"></script>
		<script type="text/javascript" src="../controller/js/ui.tabs.js"></script>
				
		<style>
			body{
				width: 100%;
				height: 100%;
			}
			.user{
				margin-top: 10px;
			}
			.ed{
				width: 10px;
			}
			#wrapper{
				min-height: 62em;
				height: 100%;
			}
			#site_link{
				position:absolute;
				margin-top: 10px;
				right: 25%;
			}
			#show_link{
				margin: -10px 0 7px 10px;
			}
			#mess{
				position: fixed;
				background-color: #005580;
				top: 0px;
				left: 50%;
				color: white;
			}
			.comment{
				position: relative;
				min-height: 60px;
				width:95%;
				border: #C5C5C5 solid 1px;
				margin:5px 0 5px 0;
				border-radius: 5px;
			}
			.com_text{
				position: absolute;
				top:22px;
				left:120px;
			}
			.com_name_date{
				position: absolute;
				top:3px;
				left:120px;
				font-size: 0.8em;
			}
			.com_ava{
				margin: 5px;
			}
			.com_del{
				position: absolute;
				top:10px;
				right:10px;
			}
			.comm_news_submit{
				position: absolute;
				right:3px;
				top: 80px;
			}
		</style>
	</head>
<body>
	<div id="wrapper">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<?php echo $menu;?>
				<div id="site_link">
					<a href="../../../index.php" target="_blank">Посмотреть сайт</a><br />
				</div>
				<div class="user">
					<div class="pull-right"><?php echo $logout;?></div>
				</div>
            </div>
		</div>
	</div>
	<div id="mess"></div>
	
	<div class="container">
		<div class="row">
			<div id="show_link" class="muted">
				<?php echo '<b>'.$header.'</b>';?>
			</div>
		</div>
		<?php
			switch($content){
// pages (all) ------------------------------------------------------------------------------
				case 'pages':?>
					<script type="text/javascript" src="../controller/js/ajax_page.js"></script>
					<div class="row">
						<div class="span24">
							<form class="form-inline" enctype="multipart/form-data" action="../controller/page_pub.php" method="post" name="page_pub" id="page_pub">
								<table class="table table-striped table-bordered">
									<thead id="head">
										<th><b>№</b></th>
										<th><b>Редактирование</b></th>
										<th><b>Ссылка</b></th>
										<?php if ($group==1){?>
										<th><b>В меню</b></th>
										<th><b>Del</b></th>
										<?php }?>
									</thead>
									<tbody id="tbody"></tbody>
								</table>
							</form>
						</div>
					
						<div class="span4">
							<form method="post" class="well form-inline" action="../../page_add.php" name="add_page" id="add_page" class="form">
								<p><b>Введите имя новой страницы:</b><br />
								<input type="text" name="name" class="in_text"/></p>
								<p><input type="checkbox" name="add_in_menu" /><b> Добавить в меню</b></p>
								<input type="submit" class="btn-success" id="add_page_sub" value=" Добавить страницу "/>
							</form>
						</div>
					</div>
				<?php break;
// news (all) ------------------------------------------------------------------------------
				case 'news':?>
					<script type="text/javascript" src="../controller/js/ajax_news.js"></script>
					<div class="row">
						<div class="span24">
							<table class="table table-striped table-bordered">
								<thead>
									<th><b>№</b></th>
									<th><b>Редактирование</b></th>
									<th><b>Комментариев</b></th>
									<th><b>Дата</b></th>
									<th><b>Удаление</b></th>
								</thead>
								<tbody id="tbody"></tbody>
							</table>
						</div>
					
						<div class="span4">
							<form method="post" class="well form-inline" action="../controller/add_news.php" name="add_news" id="add_news" class="form">
								<p><b>Введите заголовок новости:</b></p>
								<p><input type="text" name="caption" class="in_text"/></p>
								<input type="submit" class="btn-success" id="add_news_sub" value=" Добавить новость "/>
							</form>
						</div>
					</div>
				<?php break;
// menu (admin) ------------------------------------------------------------------------------
				case 'menu':
					if ($group==1){?>
					<script type="text/javascript" src="../controller/js/ajax_menu.js"></script>
					<div class="row">
						<div class="span24">
							<form class="form-inline" action="../controller/menu_pub_set.php" method="post" name="menu_pub" id="menu_pub">
								<table class="table table-striped">
									<thead>
										<th title="Уникальный идентификатор меню"><b>ID</b></th>
										<th title="Порядковый номер меню"><b>№</b></th>
										<th><b>Имя lang1</b></th>
										<th><b>Имя lang2</b></th>
										<th><b>Ссылка</b></th>
										<th title="ID меню, внутрь которого вложить"><b>В меню</b></th>
										<th title="Опубликовать в меню"><b>Опубл.</b></th>
										<th></th>
									</thead>
									<tbody id="tbody_menu"></tbody>
								</table>
							</form>
						</div>
					</div>
						<div class="row">
						<form method="post" class="well form-inline" action="../controller/menu_add.php" name="add_menu" id="add_menu" onclick="" class="form">
							<p><b>Введите имя меню:</b><br />
							<input type="text" name="name" class="in_text"/></p>
							<p><b>Ссылка:</b><br />
							<input type="text" name="link" class="in_text"/></p>
							<p><input type="checkbox" name="publ" /> <b>Опубликовать</b></p>
							<p><input type="text" class="span1" name="in" /> <b>Вложено в</b></p>
							<input type="submit" id="add_menu_sub" class="btn-success" value=" Добавить меню "/>
						</form>
					</div>							
				<?php
				}
				else{
					header('Location: pages.php');
				}
				break;
// users (admin) ------------------------------------------------------------------------------
				case 'users':
					if ($group==1){?>
					<script type="text/javascript" src="../controller/js/ajax_user.js"></script>
					<div class="row">
						<div class="span24">
							<i class="icon-user"></i> <span id="users_count"></span>
							<form class="form-inline" action="../controller/user_save.php" method="post" name="user_inf" id="user_inf">
								<table class="table table-striped table-bordered">
									<thead>
										<th><b>ID</b></th>
										<th><b>Логин</b></th>
										<th><b>Пароль</b></th>
										<th><b>E-mail</b></th>
										<th><b>Пол</b></th>
										<th><b>Группа</b></th>
										<th><b>Дата регистрации</b></th>
										<th><b>Аватар</b></th>
										<th><b>Удаление</b></th>
									</thead>
									<tbody id="tbody"></tbody>
									</table>
							</form>
						</div>
					</div>
					<div class="row">
						<?php 
							$all='<option value=1>Администратор</option><option value=2>Модератор</option><option value=3 selected>Пользователь</option>';
							include '../../classes/auth.class.php';
							$word=$db->WordsTranslate('lang2');
							echo Auth::ShowRegForm($word,'../controller/users_add.php');
						?>
					</div>
				<?php 
				}
				else{
					header('Location: pages.php');
					exit;
				}
				break;
// gallery (admin) ------------------------------------------------------------------------------
				case 'gallery':
					if ($group==1){?>
					<script type="text/javascript" src="../controller/js/ajax_gallery.js"></script>
					<div class="row">
						<div class="span24">
							<form class="form-inline" action="../controller/album_pub.php" method="post" name="gallery_ed">
								<table class="table table-striped table-bordered">
									<thead>
										<th><b>№</b></th>
										<th><b>Имя (язык1)</b></th>
										<th><b>Имя (язык2)</b></th>
										<th><b>Дата</b></th>
										<th><b>Удалить</b></th>
									</thead>
								<tbody id="tbody_gallery"></tbody>
								</table>
							</form>
						</div>
					
						<div class="span4">
							<form class="well form-inline" method="post" action="../controller/album_add.php" name="add_album" id="add_album" onclick="" class="form">
								<p><b>Введите имя нового альбома:</b><br />
								<input type="text" name="name" class="in_text"/></p>
								<input type="submit" class="btn-success" id="add_album_sub" value=" Добавить альбом "/>
							</form>
						</div>
					</div>
				<?php 
				}
				else{
					header('Location: pages.php');
					exit;
				}
				break;
// settings (admin) ------------------------------------------------------------------------------
				case 'settings':if ($group==1){
					$f=file_get_contents('../../html_templates/html_template.php');
					?>
					<script type="text/javascript" src="../controller/js/ajax_settings.js"></script>
					<script type="text/javascript">
						$(document).ready(function(){
							$('#tabSet').tabs();
							$('#tabSet2').tabs();
						});
					</script>
					<div class="row">
						<div class="span24">
							<ul id="tabSet">
								<li><a href="#lang1">Язык 1</a></li>
								<li><a href="#lang2">Язык 2</a></li>
							</ul>
							<div id="lang1">
								<b>Сайт:</b>
								<form method="post" action="#" name="edit_settings_lang1" id="edit_settings_lang1" class="form">
								Name:<br />
								<input type="text" name="site_name_lang1" id="site_name_lang1" /><br />
								Header:<br />
								<textarea name="site_header_lang1" rows="4" class="span4" id="site_header_lang1"></textarea><br />
								Footer:<br />
								<textarea name="site_footer_lang1" rows="4" class="span4" id="site_footer_lang1"></textarea><br />
								<br />
								<b>Мета теги:</b><br />
								Title:<br />
								<textarea name="meta_title_lang1" rows="4" class="span4" id="meta_title_lang1"></textarea><br />
								Keywords:<br />
								<textarea name="meta_keywords_lang1" rows="4" class="span4" id="meta_keywords_lang1"></textarea><br />
								Description:<br />
								<textarea name="meta_description_lang1" rows="4" class="span4" id="meta_description_lang1"></textarea><br />
								Charset:<br />
								<input type="text" name="meta_charset_lang1" id="meta_charset_lang1" /><br />
								<input type="hidden" name="lang" value="lang1"><br />
								</form>
							</div>
							<div id="lang2">
								<b>Сайт:</b>
								<form method="post" action="#" name="edit_settings_lang2" id="edit_settings_lang2" class="form">
								Name:<br />
								<input type="text" name="site_name_lang2" id="site_name_lang2"><br />
								Header:<br />
								<textarea name="site_header_lang2" rows="4" class="span4" id="site_header_lang2"></textarea><br />
								Footer:<br />
								<textarea name="site_footer_lang2" rows="4" class="span4" id="site_footer_lang2"></textarea><br />
								<br />
								<b>Мета теги:</b><br />
								Title:<br />
								<textarea name="meta_title_lang2" rows="4" class="span4" id="meta_title_lang2"></textarea><br />
								Keywords:<br />
								<textarea name="meta_keywords_lang2" rows="4" class="span4" id="meta_keywords_lang2"></textarea><br />
								Description:<br />
								<textarea name="meta_description_lang2" rows="4" class="span4" id="meta_description_lang2"></textarea><br />
								Charset:<br />
								<input type="text" name="meta_charset_lang2" id="meta_charset_lang2"><br />
								<input type="hidden" name="lang" value="lang2"><br />
								</form>
							</div><br />
						</div>
						<div class="span16">
							<ul id="tabSet2">
								<li><a href="#main_html">HTML-шаблон главной страницы</a></li>
								<li><a href="#other_html">HTML-шаблон остальных страниц</a></li>
							</ul>
							<form method="post" action="#" name="edit_settings_html" id="edit_settings_html" class="form">	
								<div id="main_html">
									<textarea rows="40" class="span7" name="main_html_data" id="main_html_data" ><?php echo $f;?></textarea>
								</div>
								<div id="other_html">
									<textarea rows="40" class="span7" name="other_html_data" id="other_html_data"></textarea>
								</div><br />
								<input type="button" class="btn-success" id="save_btn" value="Сохранить" />
							</form>
						</div>
					</div>
				<?php 
				}
				else{
					header('Location: pages.php');
					exit;
				}
				break;
// album (admin) ------------------------------------------------------------------------------
				case 'album':
					if ($group==1){
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
					$n=(int)count($mas);?>
					<script type="text/javascript" src="../controller/js/ajax_gallery.js"></script>
					<div class="row">
						<div class="span24">
						<?php
						if ($n>0){?>
							<i class="icon-picture"></i> Всего фотографий: <?php echo $n;?>
							<table class="table table-striped table-bordered">
								<thead>
									<th><b>Фото</b></th>
									<th><b>Имя</b></th>
									<th><b>Удалить</b></th>
								</thead>
								<tbody>
									<?php 
									// !!! сделать предпросмотр фото  !!!!
										foreach($mas as $fileName){
											echo '<tr><td><a href="#"><img src="../../../gallery/'.$album_data['link'].'/thumbs/'.$fileName.'"width="100" height="100"></a></td>
											<td align="center" width="250">'.$fileName.'</td>
											<td align="center"><a href="../controller/foto_del.php?album='.$album_data['link'].'&name='.$fileName.'">Удалить</a></td></tr>';
										}?>
								</tbody></table>
						<?php }?>
							
					
						</div>
						<div class="span24">
							<form class="well form-inline" method="post" action="../controller/album_edit.php" name="edit_album" id="edit_album" class="form">
								<b>Название альбома:</b><br />
								Язык 1<br />
								<input type="text" name="name_lang1" value="<?php echo $album_data['name_lang1'];?>"><br />
								Язык 2<br />
								<input type="text" name="name_lang2" value="<?php echo $album_data['name_lang2'];?>"><br />
								<input type="hidden" name="id" value="<?php echo $album_id;?>">
							</form>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#file_upload').uploadify({
										'uploader'  : '../controller/uploadify/uploadify.swf',
										'script'    : '../controller/foto_load.php?link=<?php echo $album_data['link']?>',
										'cancelImg' : '../controller/uploadify/cancel.png',
										'folder'    : '../controller/uploads',
										'auto'      : true,
										'multi'     : true,
										'fileDesc'  : 'Images (jpg, jpeg)',						
										'fileExt'   : '*.jpeg;*.jpg;*.JPG;'
									});
								});
							</script>
							<input id="file_upload" type="file" name="file_upload" />
						</div>
					</div>
				<?php 
				}
				else{
					header('Location: pages.php');
					exit;
				}
				break;
// page_edit (all) ------------------------------------------------------------------------------
				case 'page_edit':
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
					include '../../../fckeditor/fckeditor_php5.php';
						?>
					<div class="row">
						<div class="span24">
							<div id="show_link">
								<?php echo '<a href="../../../'.$link.'" target="_blank"><b>'.$name['lang1'].'</b></a>';?>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#tabSet').tabs();
						});
					</script>
					
					<div class="row">
						<div class="span2 well">
							<p><b>Список страниц:</b></p>
							<?php
								$sql="SELECT `id`,`lang1` FROM `page` ORDER BY `lang1` ASC;";
								$result = $db->query($sql);
								$i=1;
								while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
									echo '<a href="../view/pages.php?content=page_edit&id='.$row['id'].'">'.$i.' - '.$row['lang1'].'</a><br />';
									$i++;
								}
							?>
						</div>
						<div class="span9">
							<form  method="post" name="about" id="about" action="../controller/page_data_edit.php">
								<ul id="tabSet">
									<li><a href="#lang1">Язык 1</a></li>
									<li><a href="#lang2">Язык 2</a></li>
								</ul>
								<div id="lang1">
									Имя страницы: <br />
									<textarea name="name_lang1" rows="2" class="span8"><?php echo $name['lang1'];?></textarea><br /><br />
									Текст страницы:<br />
									<?php 
										$dd_lang1 = new FCKeditor("editor_lang1");
										$dd_lang1->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
										$dd_lang1->Value = $text['lang1'];
										$dd_lang1->Create();
									?>
									<input type="hidden" name="id" value="<?php echo $id;?>" />
								</div>
								<div id="lang2">
								Имя страницы: <br />
									<textarea name="name_lang2" rows="2" class="span8"><?php echo $name['lang2'];?></textarea><br /><br />
									Текст страницы:<br />
									<?php
										$dd_lang2 = new FCKeditor("editor_lang2");
										$dd_lang2->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
										$dd_lang2->Value = $text['lang2'];
										$dd_lang2->Create();
									?>
									<input type="hidden" name="id" value="<?php echo $id;?>" />
								</div><br />
								<p><input type="submit" id="addText" class="btn-success" value="Сохранить" /></p>
							</form>
						</div>
					</div>
				<?php break;
// news_edit (all) ------------------------------------------------------------------------------
				case 'news_edit':
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
					include '../../../fckeditor/fckeditor_php5.php';
					?>
					<script type="text/javascript">
						$(document).ready(function(){
							$('#tabSet').tabs();
						});
					</script>
					<div class="row">
						<div class="span24">
							<div id="show_link">
								<?php echo '<a href="../../../read_news.php?id='.$id.'"><b>'.$caption['lang1'].'</b></a>';?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span2 well">
							<p><b>Список новостей:</b></p>
							<?php
								$sql="SELECT `id`,`caption_lang1` FROM `news` ORDER BY `id` DESC";
								$result = $db->query($sql);
								$i=1;
								while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
									echo '<a href="../view/pages.php?content=news_edit&id='.$row['id'].'">'.$i.' - '.$row['caption_lang1'].'</a><br />';
									$i++;
								}
							?>
						</div>
						<div class="span9">
							<ul id="tabSet">
								<li><a href="#lang1">Язык 1</a></li>
								<li><a href="#lang2">Язык 2</a></li>
							</ul>
							<form method="post" name="about" id="about" action="../controller/news_edit_data.php">
								<div id="lang1">
									Заголовок:<br />
									<textarea name="caption_lang1" rows="3" class="span8"><?php echo $caption['lang1'];?></textarea><br /><br />
									<?php
									$dd = new FCKeditor("editor_lang1");
									$dd->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
									$dd->Value = $text['lang1'];    
									$dd->Create();
									?>
									<input type="hidden" name="id" value=<?php echo $id;?> />
								</div>
								<div id="lang2">
									Заголовок: <br />
									<textarea name="caption_lang2" rows="3" class="span8"><?php echo $caption['lang2']?></textarea><br /><br />
									<?php
									$dd2 = new FCKeditor("editor_lang2");
									$dd2->Config['SkinPath'] = '../../../fckeditor/editor/skins/office2003/';
									$dd2->Value = $text['lang2'];
									$dd2->Create();
									?>
									<input type="hidden" name="id" value=<?php echo $id;?> />
								</div><br />
								<p><input class="btn-success" type="submit" id="addText" value="Сохранить" /></p>
							</form>
							<p><i class="icon-comment"></i> <b>Комментарии:</b></p>
							<?php
							$mas=$db->commentRead($id);
							if (isset($mas)){
								foreach ($mas as $val){?>
									<div class="comment">
										<div class="com_ava">
											<a href="O_polzovatele.php?login=<?php echo $val['users_login'];?>"><img src="../../../<?php echo $val['users_ava'];?>" /></a>
										</div>
										<div class="com_name_date">
											<a href="O_polzovatele.php?login=<?php echo $val['users_login'];?>">
												<span class="com_username"><?php echo $val['users_login'];?></span>
											</a> | 
											<span class="com_date"><?php echo $val['datetime'];?></span>
										</div>
										<span class="com_del"><a href="../controller/news_comment_del.php?id=<?php echo $val['id'];?>" class="news_comment_del"><img src="../view/del.png"></a></span>
										<form class="form" action="../controller/news_comment_edit.php" method="post">
											<span class="com_text"><textarea rows="4" class="span7" name="text"><?php echo $val['text'];?></textarea></span>
											<input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
											<input type="submit" class="btn-success comm_news_submit" value="OK"/>
										</form>
									</div><?php
								}
							}?>
							</div>
					</div>
				<?php break;
				default :
					echo '<p>Панель администратора позволяет добавлять, удалять и редактировать страницы, меню и информация о пользователях и многое другое.</p>
						<p>Для начала работы выберите необходимый пункт меню.</p>';
				}?>
			</div>
		</div>
<div class="container">
	<div class="muted">
		<?php echo $footer;?>
	</div>	
</div>
</body>
</html>