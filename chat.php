<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->
<?php
session_start();
?>
<?php
if(isset($_POST['ajaxsend']) && $_POST['ajaxsend']==true){
	//function change emoticon
	function parseString($string ) {
		$my_smilies = array(
	        ':alien' => '<img src="images/alien1.png" alt="" />',
	        ':monsteruniversity' => '<img src="images/alien2.png" alt="" />',
			':/' => '<img src="images/annoyed.png" alt="" />',
			':L' => '<img src="images/annoyed.png" alt="" />',
			'0:3' => '<img src="images/angel.png" alt="" />',
			'0:)' => '<img src="images/angel.png" alt="" />',
			':zzz<' => '<img src="images/zzz.png" alt="" />',
			':blanco' => '<img src="images/blanco.png" alt="" />',
			':zip' => '<img src="images/zip_it.png" alt="" />',
			':boring' => '<img src="images/boring.png" alt="" />',
			':pencil' => '<img src="images/pencil.png" alt="" />',
			':brb' => '<img src="images/brb.png" alt="" />',
			':busy' => '<img src="images/busy.png" alt="" />',
			':cellphone' => '<img src="images/cellphone.png" alt="" />',
			':clock' => '<img src="images/clock.png" alt="" />',
			'B)' => '<img src="images/cool.png" alt="" />',
			'B-)' => '<img src="images/cool.png" alt="" />',
			':crazy' => '<img src="images/crazy.png" alt="" />',
			':camera' => '<img src="images/photo_camera.png" alt="" />',
			":'(" => '<img src="images/cry.png" alt="" />',
			":-'(" => '<img src="images/cry.png" alt="" />',
			":|" => '<img src="images/palm.png" alt="" />',
			'>:)' => '<img src="images/devil.png" alt="" />',
			'>:-)' => '<img src="images/devil.png" alt="" />',
			'>:D' => '<img src="images/devil_laugh.png" alt="" />',
			'>:-D' => '<img src="images/devil_laugh.png" alt="" />',
			':blush' => '<img src="images/blush.png" alt="" />',
			':stop' => '<img src="images/dnd.png" alt="" />',
			':flower' => '<img src="images/flower.png" alt="" />',
			'<3' => '<img src="images/heart.png" alt="" />',
			'8)' => '<img src="images/geek.png" alt="" />',
			'8-)' => '<img src="images/geek.png" alt="" />',
			':gift' => '<img src="images/gift.png" alt="" />',
			':ill' => '<img src="images/ill.png" alt="" />',
			':inlove' => '<img src="images/in_love.png" alt="" />',
			':file' => '<img src="images/text_file.png" alt="" />',
			':*' => '<img src="images/kissy.png" alt="" />',
			':-*' => '<img src="images/kissy.png" alt="" />',
			':D' => '<img src="images/laugh.png" alt="" />',
			':-D' => '<img src="images/laugh.png" alt="" />',
			':mail' => '<img src="images/mail.png" alt="" />',
			':music' => '<img src="images/music2.png" alt="" />',
			':notguilty' => '<img src="images/not_guilty.png" alt="" />',
			':please' => '<img src="images/please.png" alt="" />',
			':info' => '<img src="images/info.png" alt="" />',
			':(' => '<img src="images/sad.png" alt="" />',
			':-(' => '<img src="images/sad.png" alt="" />',
			':p' => '<img src="images/silly.png" alt="" />',
			':-p' => '<img src="images/silly.png" alt="" />',
			':v' => '<img src="images/oh.png" alt="" />',
			':speechless' => '<img src="images/speechless.png" alt="" />',
			':o' => '<img src="images/surprised.png" alt="" />',
			':-o' => '<img src="images/surprised.png" alt="" />',
			':tease' => '<img src="images/tease.png" alt="" />',
			';)' => '<img src="images/wink.png" alt="" />',
			';-)' => '<img src="images/wink.png" alt="" />',
			'xD' => '<img src="images/xd.png" alt="" />',
			'XD' => '<img src="images/xd.png" alt="" />',
			'x-D' => '<img src="images/xd.png" alt="" />',
			'X-D' => '<img src="images/xd.png" alt="" />',
			':fool' => '<img src="images/fools.png" alt="" />',
			':ghost' => '<img src="images/fools.png" alt="" />',
			':yummy' => '<img src="images/nomnomnom.png" alt="" />',
			':mario' => '<img src="images/mario.png" alt="" />'
	    );
		return str_replace( array_keys($my_smilies), array_values($my_smilies), $string);
	}
	$isichat = $_POST["chat"];
	// Code to save and send chat
	$clock = date("h:i:sa");
	$chat = fopen("chatdata.txt", "a");
	$data="<div id='aa'><p id='clock'>".$clock."</p><b>".$_SESSION['username'].' : </b><p id="text">'.parseString($isichat)."</p></div>";
	fwrite($chat,$data);
	fclose($chat);

	$chat = fopen("chatdata.txt", "r");
	echo fread($chat,filesize("chatdata.txt"));
	fclose($chat);
} else if(isset($_POST['ajaxget']) && $_POST['ajaxget']==true){
	// Code to send chat history to the user
	$chat = fopen("chatdata.txt", "r");
	if(filesize("chatdata.txt") > 0)
	{
		echo fread($chat,filesize("chatdata.txt"));
	}
	else
	{

	}
	fclose($chat);
} else if(isset($_POST['ajaxclear']) && $_POST['ajaxclear']==true){
	// Code to clear chat history
	$chat = fopen("chatdata.txt", "w");
	$data="<div id='aa'><b>".$_SESSION['username'].'</b> cleared chat</div><br>';
	fwrite($chat,$data);
	fclose($chat);
}
?>
<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->