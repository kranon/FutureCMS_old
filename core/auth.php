<?php
echo '<div id="auth">
          <form action="core/autorise.php" method="post" name="autoris" id="autoris">
			'.$word[6].'<br />
			<input type="text" name="login" id="log"/>
			'.$word[7].'<br />
			<input type="password" name="pass" id="ppp"/>
			<input type="submit" name="sub" id="sub" value=" '.$word[1].' "/>
			</form>
        </div>
<script type="text/javascript">$(\'#autoris\').addClass(\'hide_auth\');</script>';
?>
