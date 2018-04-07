<?php 
	require_once('functions.php');	
	if(empty($_POST['article_token'])){
		header('Location: list.php');		
	}else{
		db_article_add($_POST['article_titel'], $_POST['article_content'], $_POST['article_like'], $_POST['article_user'], $_POST['article_date'], $_POST['article_token']);
		echo $_POST['article_token'];
	}
?>