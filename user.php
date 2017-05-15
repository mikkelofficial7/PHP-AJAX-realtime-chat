<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->
 <?php
session_start();

if(isset($_POST['ajaxsend']) && $_POST['ajaxsend']==true){
	// Code to save and send chat
	$chat = fopen("listonline.txt", "r");
	echo fread($chat,filesize("listonline.txt"));
	fclose($chat);
} else if(isset($_POST['ajaxget']) && $_POST['ajaxget']==true){
	// Code to send chat history to the user
	$chat = fopen("listonline.txt", "r");
	if(filesize("listonline.txt") > 0)
	{
		echo fread($chat,filesize("listonline.txt"));
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