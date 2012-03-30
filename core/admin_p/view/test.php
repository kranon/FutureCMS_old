<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../../js/jquery.js"></script>
				
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<script src="bootstrap/js/bootstrap.js"></script>
		
	</head>
	
	<body>
		<div class="container">
			<table class="table-bordered table table-condensed table-striped">
				<thead>
					<th><b>Редактирование</b></th>
					<th><b>Ссылка</b></th>
					<th><b>В меню</b></th>
					<th><b>Del</b></th>
				</thead>
				<tbody>
					<tr>
						<td><input type="text" name="name" class="span1"/></td>
						<td><input type="text" name="name" class="in_text"/></td>
						<td><input type="text" name="name" class="in_text"/></td>
						<td><input type="text" name="name" class="in_text"/></td>
					</tr>

					<tr>
						<td>2</td>
						<td>2</td>
						<td>2</td>
						<td>2</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="container">
			<div>
				<ul class="nav-tabs nav">
					<li><a href="pages.php?content=pages">Страницы</a></li>
					<li><a href="pages.php?content=news">Новости</a></li>
					<li><a href="pages.php?content=menu">Меню</a></li>
					<li><a href="pages.php?content=users">Пользователи</a></li>
					<li><a href="pages.php?content=gallery">Галерея</a></li>
					<li><a href="pages.php?content=settings">Настройки</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<form class="well form-inline" action="#" method="post" name="page_pub" id="page_pub">
				<p><b>Введите имя новой страницы:</b><br />
				<input type="text" name="name" class="in_text"/></p>
                <p><input type="checkbox" name="add_in_menu" /><b> Добавить в меню</b></p>
                <input type="submit" class="btn-success" id="add_page_sub" value="Добавить страницу"/>
			</form>
		</div>
		
		<!--<div class="container">
			<ul id="tab" class="nav nav-tabs">
				<li><a href="#home" data-toggle="tab">Home</a></li>
				<li><a href="#profile" data-toggle="tab">Profile</a></li>
				<li><a href="#messages" data-toggle="tab">Messages</a></li>
				<li><a href="#settings" data-toggle="tab">Settings</a></li>
			</ul>
			
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active" id="home">1.</div>
				<div class="tab-pane" id="profile">2.</div>
				<div class="tab-pane" id="messages">3.</div>
				<div class="tab-pane" id="settings">4.</div>
			</div>
		</div>
		<script>
			$('#tab').tab('show')
		</script>-->
		
		<h2>Example tabs</h2>
          <p>Click the tabs below to toggle between hidden panes, even via dropdown menus.</p>
          <ul id="tab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
            <li><a href="#profile" data-toggle="tab">Profile</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
              </ul>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
              <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
            </div>
            <div class="tab-pane fade" id="profile">
              <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            <div class="tab-pane fade" id="dropdown1">
              <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
              <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
            </div>
          </div>
         
		
		
	</body>
</html>