<?php 
	require_once('functions.php');	
	if(empty($_POST['comment_token'])){
		header('Location: list.php');		
	}else{
		db_comment_add($_POST['comment_article_id'], $_POST['comment_user_id'], $_POST['comment_content'], $_POST['comment_date'], $_POST['comment_token']);		
		echo $_POST['comment_token'];		
	}
?>
