<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->
<?php
session_start();
//Create a session of username and logging in the user to the chat room
if(isset($_POST['username']))
{
	$_SESSION['username']=$_POST['username'];
	$nama = $_SESSION['username'];
	$chat = fopen("listonline.txt", "a");
	$data="<div id='aa'><img src='images/onlinelogo.png' style='width:12px; height:12px; margin-right:4px;'><b>".$nama.'</b></div><br>';
	fwrite($chat,$data);
	fclose($chat);
	header("location: index.php");
}

//Unset session and logging out user from the chat room
if(isset($_GET['logout'])){

	$clock = date("h:i:sa");
	$chat = fopen("chatdata.txt", "a");
	$data="<div id='aa'><p id='clock'>".$clock."</p><b><p id='text'>".$_SESSION['username']."</b> has left the chat</p></div>";
	fwrite($chat,$data);
	fclose($chat);

	//delete particular name from .txt file
	$content = file_get_contents("listonline.txt");
	$newcontent = str_replace("<div id='aa'><img src='images/onlinelogo.png' style='width:12px; height:12px; margin-right:4px;'><b>".$_SESSION['username'].'</b></div><br>', "", "$content");
	file_put_contents("listonline.txt", "$newcontent");

	unset($_SESSION['username']);
	header('Location:index.php');
}

?>
<html>
<head>
	<title>Simple Chat Room</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/styles.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js" ></script>
</head>
<body>
<div class='header'>
	<h1>
		SIMPLE CHAT ROOM
		<?php // Adding the logout link only for logged in users  ?>
		<?php if(isset($_SESSION['username'])) { ?>
			<a class='logout' href="?logout">Logout</a>
		<?php } ?>
	</h1>

</div>

<div class='main'>
<?php //Check if the user is logged in or not ?>
<?php if(isset($_SESSION['username'])) { ?>
<div id='user'></div>
<div id='result'></div>
<div class='chatcontrols'>
<div id='box-typing'></div>
<form class = "chatting-form" method="post" onsubmit="return submitchat();">
	<input type='text' name='chat' id='chatbox' autocomplete="off" placeholder="Enter your message.." >
	<input type='submit' name='send' id='send' class='btn btn-send' value='Send' >
	<div id="footer"></div>
	<!--<input type='button' name='clear' class='btn btn-clear' id='clear' value='X' title="Clear Chat" />-->
</form>
<script>
// Javascript function to submit new chat entered by user
function submitchat(){
		if($('#chat').val()=='' || $('#chatbox').val()==' ') return false;
		$.ajax({
			url:'chat.php',
			data:{chat:$('#chatbox').val(),ajaxsend:true},
			method:'post',
			success:function(data){
				$('#result').html(data); // Get the chat records and add it to result div
				//document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; // Bring the scrollbar to bottom of the chat resultbox in case of long chatbox
				$('#chatbox').val(''); //Clear chat box after successful submition
			}
		})
		return false;
};

// Function to continously check the some has submitted any new chat
setInterval(function(){
	$.ajax({
			url:'chat.php',
			data:{ajaxget:true},
			method:'post',
			success:function(data){
				$('#result').html(data);
			}
	})
},1000);

// Function to chat history
$(document).ready(function(){
	$('#clear').click(function(){
		if(!confirm('Are you sure you want to clear chat?'))
			return false;
		$.ajax({
			url:'chat.php',
			data:{username:"<?php echo $_SESSION['username'] ?>",ajaxclear:true},
			method:'post',
			success:function(data){
				$('#result').html(data);
			}
		})
	})
})
/*****************************************************************************/
function submituser(){
		if($('#name').val()=='' || $('#name').val()==' ') return false;
		$.ajax({
			url:'user.php',
			data:{name:$('#name').val(),ajaxsend:true},
			method:'post',
			success:function(data){
				$('#user').html(data); // Get the chat records and add it to result div
				$('#name').val(''); //Clear chat box after successful submition
				document.getElementById('user').scrollTop=document.getElementById('user').scrollHeight; // Bring the scrollbar to bottom of the chat resultbox in case of long chatbox
			}
		})
		return false;
};

// Function to continously check the some has submitted any new chat
setInterval(function(){
	$.ajax({
			url:'user.php',
			data:{ajaxget:true},
			method:'post',
			success:function(data){
				$('#user').html(data);
			}
	})
},1000);

/*******************************************************************************************************************/
$(document).ready(function(){

	$.ajax({
		url:'typing.php',
		data:{read:true},
		method:'post',
		success:function(data){
			$('#box-typing').html(data);
		}
	})
	setInterval(function(){
		$.ajax({
			url:'typing.php',
			data:{read:true},
			method:'post',
			success:function(data){
				$('#box-typing').html(data);
			}
		})
	},200);

	/*******************/

	$('#chatbox').keyup(function(){
		$.ajax({
			url:'typing.php',
			data:{visible:true},
			method:'post',
			success:function(data){
				$('#box-typing').html(data);
			}
		})
	});

	$('#chatbox').keydown(function(){
		$.ajax({
			url:'typing.php',
			data:{visibles:true},
			method:'post',
			success:function(data){
				$('#box-typing').html(data);
			}
		})
	});
	

});
</script>
<?php } else { ?>
<div class='userscreen'>
	<img class="js-logo" src="images/javascript.png" >
	<form method="post" onsubmit="return submituser();">
		<input type='text' class='input-user' id="name" placeholder="Enter your name" name='username'/>
		<br>
		<input type='submit' class='btn btn-user' id="btn-name" name="btn-submit" value='Join Now' />
		<input type='hidden' id="hide"/>
	</form>
</div>
<?php } ?>

</div>
</body>
</html>
<!--

AUTHOR : MIKKEL SEPTIANO (WWW.GITHUB.COM/MIKKELOFFICIAL7)

 -->