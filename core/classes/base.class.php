<?php
# Класс 'base' предназначен для работы с БД MySQL #
class DataBase{
    private $host= '';
    private $user= '';
    private $pass= '';
    private $db_name= '';
    private $connection;
    // Конструктор класса
    public function __construct($host="",$user="",$pass=""){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
		$this->connect();
    }
    // Подключение к базе данных
    public function connect(){
		$this->connection = mysql_connect($this->host,$this->user,$this->pass) or die("could not connect to DB");
        self::query("set names utf8");
        return $this->connection;
    }
    // Выбор базы данных
    public function SelectDataBase($db_name){
        if($this->connection){
            mysql_select_db($db_name) or die(mysql_error());
        }
    }
    // Закрытие MySQl
    public function CloseDBConnection(){
        return mysql_close($this->connection);
    }
	public static function query($sql){
		$res=mysql_query($sql) or die(mysql_error());
		return $res;
    }
	// Очистка строк от "мусора"
    public static function ClearData($data){
		$data=stripslashes($data);
		$data=strip_tags($data);
		$data=trim($data);
		$data=mysql_real_escape_string($data);
		if ($data=='') $data=null;
		return $data;
    }
    // Чтение списка новостей
    public function ReadNews($col='',$lang){
    	if($this->connection){
			$sql="SELECT	`id`,
							`caption_".$lang."`,
							`text_".$lang."`,
							DATE_FORMAT(date,'%d.%m.%Y') AS date
				FROM `news` ORDER BY `id` DESC;";
			$result = self::query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$sql2="SELECT COUNT(`id`) as count FROM `news_comments` WHERE `news_id`=".$row['id'];
				$res = self::query($sql2);
				while ($row2 = mysql_fetch_array($res, MYSQL_BOTH)){
					$count=$row2['count'];
				}
				
				$caption=$row['caption_'.$lang];
				$mor['lang1']='Падрабязней';
				$mor['lang2']='Подробней';
				$news.='<div class="news">
				<a href="read_news.php?id='.$row['id'].'"><h4 class="news_caption">'.$caption.'</h4></a>
				<span class="news_date">'.$row['date'].'</span>
				<span class="news_num_comments">Комментариев: '.$count.'</span>
				<span class="news_read"><a href="read_news.php?id='.$row['id'].'">'.$mor[$lang].'</a></span><br />
				</div>';
			}
			return $news;
    	}
    }
    // Добавление новости
    public function AddNews($caption){
    	if($this->connection){
			$sql="INSERT INTO `news` (`caption_lang1` ,`date`)VALUES ('".$caption."', NOW());";
    		self::query($sql);
    	}
    }
    // Удаление новости
    public function DelNews($id){
    	if($this->connection){
    		$result = self::query("DELETE FROM `news` WHERE `news`.`id` = '".$id."';");
    	}
    }
    // Изменение текста новости
    public function UpdateTextNews($news){
    	if($this->connection){
				$sql="UPDATE `news` SET 
								`caption_lang1` = '".$news['caption']['lang1']."',
								`caption_lang2` = '".$news['caption']['lang2']."',
								`text_lang1`='".$news['text']['lang1']."', 								
								`text_lang2`='".$news['text']['lang2']."'
					WHERE `id` = '".$news['id']."'";
			self::query($sql);
		}
    }
    // Чтение текста новости
    public function ReadNewsText($id, $lang){
    	if($this->connection){
			$sql="SELECT `text_".$lang."` FROM `news` WHERE `id`=".$id;
			
    		$result = self::query($sql);
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
           		$news_text=$row[0];
            }
			return $news_text;
    	}
    }
	// Добавление комментария к новости
    public function commentAdd($newsId, $userId, $comment_text){
        if($this->connection){
			$sql="INSERT INTO `news_comments` (`text` ,`news_id` ,`users_id`, `datetime`)VALUES ('".$comment_text."','".$newsId."','".$userId."',NOW());";
			self::query($sql);
        }
    }	
	// Добавление комментария к новости
    public function commentEdit($id,$text){
        if($this->connection){
			$sql="UPDATE `news_comments` SET `text` = '".$text."' WHERE `id`=".$id;
			self::query($sql);
        }
    }	
	// Чтение комментариев к новости
    public function commentRead($newsId){
        if($this->connection){
			$sql="SELECT 
						`news_comments`.`id`,
						`news_comments`.`text`,
						`news_comments`.`news_id`,
						`news_comments`.`users_id`,
						`news_comments`.`datetime`,
						`users`.`login`,
						`users`.`ava`
				FROM `news_comments`,`users` 
					WHERE 
						`news_comments`.`news_id`=".$newsId." 
							AND `users`.`id`=`news_comments`.`users_id`;";
			$res=self::query($sql);
			while ($row = mysql_fetch_array($res, MYSQL_BOTH)){
           		$comment[] = array(
					"id"			=> $row['id'],
					"text"			=> $row['text'],
					"news_id"		=> $row['news_id'],
					"users_login"	=> $row['login'],
					"users_ava"		=> $row['ava'],
					"datetime"		=> $row['datetime']
					);
            }
			return $comment;
        }
    }
    // Чтение меню из БД и вывод его на экран ввиде ссылок
    public function MenuRead($lang,$dir=''){
		if($this->connection){
			$sql="SELECT `id`,`num`,`link`,`".$lang."`,`in` FROM `menu` WHERE `published`='1' ORDER BY `num`;";
            $result = self::query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$menu[$row['num']]=array(
						'id'=>$row['id'],
						'in'=>$row['in'],
						'name'=>$row[$lang],
						'link'=>$row['link']
						);
			}
			
			foreach($menu as $val){
					if ($val['in']==0){
						echo '<li><a href="'.$val['link'].'">'.$val['name'].'</a>';
						echo '<ul>';
						foreach ($menu as $val2){
							if ($val2['in']!=0){
								if ($val2['in']==$val['id']){
									echo '<li><a href="'.$val2['link'].'">'.$val2['name'].'</a></li>';
								}
							}
						}
						echo '</ul></li>';
					}
				}
        }
    }
    //добавление меню в БД
    public function MenuAdd($menu){
        if($this->connection){
			$sql="SELECT `link` FROM `menu` WHERE `lang1`='".$menu['name']."'";
			$result = self::query($sql);
			if (mysql_num_rows($result)==0){
				$sql="SELECT `num` FROM `menu` ORDER BY `num` DESC LIMIT 1";
				$result = self::query($sql);
				while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
					$next_num=$row[0]+1;
				}
				
				$sql="INSERT INTO `menu` (
									`num`,
									`lang1`,
									`link`,
									`published`,
									`in`)
					VALUES (
									".$next_num.",
									'".$menu['name']."',
									'".$menu['link']."',
									'".$menu['publ']."',
									'".$menu['in']."')";
				if ($result = self::query($sql)){
                    echo '1';
                }
				else{
					echo 'Ошибка запроса создания меню';
				}
            }
			else{
				echo 'Такое меню уже существует!';
			}
        }
    }
    //удаление меню
    public function MenuDel($id){
        if($this->connection){
			$sql="SELECT `link` FROM `menu` WHERE `id`=".$id;
			$result=self::query($sql);
			while ($row = mysql_fetch_array($result)){
				$link=$row['link'];
			}
						
			$sql="DELETE FROM `menu` WHERE `menu`.`id` = '".$id."'";
            self::query($sql);
			
			$sql="UPDATE `page` SET `in_menu`='0' WHERE `link`='".$link."'";
            self::query($sql);
        }
    }
    // Изменение имени меню (не задействовано!!!)
    public function MenuNameEd($id,$name){
        if($this->connection){
            if (!$result = self::query("UPDATE `menu` SET `text` = '".$name."' WHERE `id` = '".$id."'")){
                echo 'Ошибка изменения имени меню';
            }
        }
    }
    //удаление страницы
    public function PageDel($id){
		if($this->connection){
            // удаление файла страницы
            $result = self::query("SELECT `link` FROM `page` WHERE `page`.`id` = '".$id."'");
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
                unlink('../../../'.$row['link']) or die("Ошибка удаления файла!");
            }
            mysql_free_result($result);
            // удаление страницы из базы
            $result = self::query("DELETE FROM `page` WHERE `id` = '".$id."'");
        }
    }
	//Чтение данных страницы на беларуском
    public function ReadPageName($PageLink,$lang){
		if($this->connection){
            $sql="SELECT `".$lang."` FROM `page` WHERE `link` = '".$PageLink."'";
			$result=self::query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$pageData=$row[$lang];
			}
			return $pageData;
        }
    }
	
	//чтение переведённых стандартных слов на сайте
    public function WordsTranslate($lang){
		if($this->connection){
			$num=1;
			$sql="SELECT `".$lang."` FROM `language`";
			$result = self::query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$word[$num]=$row[$lang];
				$num++;
			}
			return $word;
        }
    }
    // добавление текста на страницу
    public function AddText($page){
        if($this->connection){
			$sql="UPDATE `page` SET 
								`lang1`='".$page['name']['lang1']."',
								`lang2`='".$page['name']['lang2']."',
								`text_lang1` = '".$page['text']['lang1']."',
								`text_lang2` = '".$page['text']['lang2']."'				
					WHERE `id` = '".$page['id']."'";
			self::query($sql);
        }
    }
    // вывод текста на страницу
    public function TextRead($link, $lang){
       if($this->connection){
			$sql="SELECT `text_".$lang."` FROM `page` WHERE `link` = '".$link."'";
            $result = self::query($sql);
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$text=$row[0];
            }
            mysql_free_result($result);
			return $text;
        }
    }
    // Чтение списка галерей
    public function GalleryRead($lang){
  		if($this->connection){
			$textNumFoto=array(
				'lang1'=>'Колькасць фотаздымкаў: ',
				'lang2'=>'Количество фотографий: '
			);
			$date_lang=array(
					'lang1'=>'Дата:',
					'lang2'=>'Дата:'
				);
			$sql="SELECT `id`,`name_".$lang."`,`link`,`date` FROM `gallery`";
            $result = $this->query($sql);
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
				$mas=$this->OpenAlbum($row['id'],'./');
				$name=array(
					'lang1'=>$row['name_lang1'],
					'lang2'=>$row['name_lang2']
				);
								
				$num=count($mas);
				$gallery.='<div class="album">
						<a href="album.php?id='.$row['id'].'">
							<img src="gallery/'.$row['link'].'/thumbs/'.$mas[0].'">
						</a>
						<a href="album.php?id='.$row['id'].'" class="albumName">'.$name[$lang].'</a>
						<p class="numberFoto">'.$textNumFoto[$lang].$num.'</p>
						<p class="dateFoto">'.$date_lang[$lang].' '.$row['date'].'</p>
					</div>';
            }
            mysql_free_result($result);
			return $gallery;
        }
    }
	// Получение списка фотографий в папке альбома
    public function OpenAlbum($id,$dir){
		if($this->connection){
			$sql="SELECT `link` FROM `gallery` WHERE `id`=$id";
            $result = self::query($sql);
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
                $link=$row['link'];
            }
            mysql_free_result($result);
            //Допустимые расширения файлов:
            $CONF["file_types"] ='JPG|jpg|jpeg|png|bmp|gif';
            //Открываем директорию с фотографиями:
            $dh = opendir($dir.'gallery/'.$link.'/');
            //Читаем директорию:
			while($fname = readdir($dh)){
				//Находим расширение файла :
				$file_array = explode('.', $fname);
                $num = count($file_array);
                $fileres = $file_array[($num - 1)];
                //Доступные расширения:
                $file_types = explode("|", $CONF['file_types']);
                //Если присутсвует файл с таким расширением, то вносим его в массив:
                if(in_array($fileres, $file_types)){
					$files[] = $fname;
                }
			}
            return $files;
        }
    }
    // Удаление альбома
    public function AlbumDel($id){
        if($this->connection){
			$sql="DELETE FROM `gallery` WHERE `id` = ".$id;
            self::query($sql);
        }
    }
	// Функция транслитерации с русского на английский
    public function translitIt($str){
		$tr = array(
			"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
			"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
			"Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
			"ў"=>"y","і"=>"i"," "=>"_","."=>"","/"=>"-"
		);
		return strtr($str,$tr);
    }
	// Добавление нового пользователя
    public function userAdd($login,$pass,$email,$ava="../avatars/default.png" ,$sex='men',$group=3){
		$sql="INSERT INTO `users` (
							`login`,
							`pass`,
							`email`,
							`ava`,
							`sex`,
							`datreg`,
							`group`)
					VALUES (
							'".$login."',
							'".$pass."',
							'".$email."',
							'".$ava."',
							'".$sex."',
							NOW(),
							'".$group."')";
		self::query($sql);
    }
	// Удаление пользователя
    public function userDel($id){
        if($this->connection){
            // удаление аватарки
            $result = self::query("SELECT `ava` FROM `users` WHERE `id` = ".$id);
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
                if (!($row['ava']=='../avatars/default.png')){
                    unlink("../../".$row['ava']);
                }
            }
            // удаление пользователя из базы
            self::query("DELETE FROM `users` WHERE `id` = '".$id."'");
        }
    }
	// Изменение пароля пользователя
    public function EditPassword($login,$new_pass){
        if($this->connection){
			$pass=sha1(sha1($pass).$login);
            $sql="UPDATE `users` SET `pass`='".$pass."' WHERE `login` = '".$login."'";
			self::query($sql);
        }
    }
	// Добавление нового пользователя
    public function EditAvatar($login,$avatar){
        if($this->connection){
			
			$sql="UPDATE `users` SET `ava`='".$avatar."' WHERE `login` = '".$login."'";
			self::query($sql);
        }
    }
}
?>