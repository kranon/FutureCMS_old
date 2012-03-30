$(document).ready(function(){
	function getMenu(){
		$.getJSON('../controller/menu_get.php',getContent);	// Получение JSON от сервера
		
		function getContent(data){
			var text='';
			var pub='';
			var inm='';
			$.each(data, function(adata){
				if (this.publ==1){pub='checked="checked"';}
				else{pub='';}
				text+=('<tr><td class="al_center">'+this.id+'</td><td><input class="ed" type="text" name="id_'+this.id+'" value="'+this.num+'"></td><td><input type="text" name="name_lang1_'+this.id+'" value="'+this.name_lang1+'"/></td><td><input type="text" name="name_lang2_'+this.id+'" value="'+this.name_lang2+'"/></td>            <td><input type="text" name="link_'+this.id+'" value="'+this.link+'"/></td><td class="al_center"><input type="text" class="ed" name="in_'+this.id+'" value="'+this.inm+'"></td><td class="al_center"><input type="checkbox" name="'+this.id+'" value="1" '+pub+'/></td><td class="al_center"><a href="../../menuDel.php?id='+this.id+'" class="del" title="Удалить"><img src="../view/del.png" /></a></td></tr>');
			});
			$('#tbody_menu').html(text);
		}
	}
	//вызов паузы на 1с
	function pause(ms){
		var date = new Date();
		var curDate = null;
		do { curDate = new Date(); }
		while(curDate-date < ms);
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer==1){
				getMenu();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(2000);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getMenu();
	// При изменении text сохраняется его значение ("Id", "Вложено в")
	$('#menu_pub :text').live('change',function(){
		//alert(1);
		//pause(1000);
		//alert(2);
		var data2=$('#menu_pub').serialize();
		$.post('../controller/menu_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
		
	// При нажатии на checkbox сохраняется его значение ("Опубликовать")
	$('#menu_pub :checkbox').live('click',function(){
		var data2=$('#menu_pub').serialize();
		$.post('../controller/menu_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
	
	// Удаление меню
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('../controller/menu_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Меню удалено!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	
	// Добавление нового меню
	$('#add_menu_sub').click(function(evt){
		var newMenu=$('#add_menu').serialize();
		$.post('../controller/menu_add.php',newMenu,rep);
		function rep(mess){
			report(mess,'Меню создано!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
});