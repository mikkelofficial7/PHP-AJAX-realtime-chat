<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->
 <?php
session_start();
if(isset($_POST['visible']) && $_POST['visible']==true){
	$chat = fopen("typing.txt", "w");
	$data="<p id='typing-user' style='visibility:hidden'>Someone is typing...</p>";
	fwrite($chat,$data);
	fclose($chat);
	$chat = fopen("typing.txt", "r");
	echo fread($chat,filesize("typing.txt"));
	fclose($chat);
}
if(isset($_POST['visibles']) && $_POST['visibles']==true){
	$chat = fopen("typing.txt", "w");
	$data="<p id='typing-user' style='visibility:visible'>Someone is typing...</p>";
	fwrite($chat,$data);
	fclose($chat);
	$chat = fopen("typing.txt", "r");
	echo fread($chat,filesize("typing.txt"));
	fclose($chat);
}
else if(isset($_POST['read']) && $_POST['read']==true)
{
	$chat = fopen("typing.txt", "r");
	if(filesize("typing.txt") > 0)
	{
		echo fread($chat,filesize("typing.txt"));
	}
	else
	{

	}
	fclose($chat);
}
?>
<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->