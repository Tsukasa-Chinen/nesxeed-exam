<?php

	ini_set('display_errors', 1);
	date_default_timezone_set('Asia/Tokyo');

	/* Common DB Setting */
	$dbDsn = 'mysql:dbname=nxs_social;host=localhost';
	$dbUser = 'root';
	$dbPassword = '';
	$dbDbh = new PDO($dbDsn, $dbUser, $dbPassword);
	$dbDbh->query('SET NAMES utf8');	


	/* Check already created Admin */
	function db_users_admin(){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$id = 'admin';
		$sql = 'SELECT COUNT(*) AS `num` FROM `nxs_users` WHERE `user_role` LIKE ?';
		$data = array($id);
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec['num'];		
	}

	/* Check user e-mail */
	function db_users_email($email){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$id = $email;
		$sql = 'SELECT COUNT(*) AS `num` FROM `nxs_user` WHERE `user_email` LIKE ?';
		$data = array($id);
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec['num'];		
	}
	
	/* Check user password */
	function db_users_password($password){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$id = $password;
		$sql = 'SELECT COUNT(*) AS `num` FROM `nxs_user` WHERE `user_password` LIKE ?';
		$data = array($id);
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec['num'];		
	}


	/* User Call */
	function db_users_call($email, $id){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		
		if(!empty($email) && empty($id)){
			$email = $email;
			$sql = 'SELECT * FROM `nxs_user` WHERE `user_email` LIKE ?';
			$data = array($email);			
		}elseif(empty($email) && !empty($id)){
			$id = $id;
			$sql = 'SELECT * FROM `nxs_user` WHERE `user_id` LIKE ?';
			$data = array($id);						
		}
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
	
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec;
	}


	/* User Add */
	function db_users_add($name, $password , $email, $role){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$sql= 'INSERT INTO `nxs_users` SET `user_name` = ?, `user_password` = ?, `user_email` = ?, `user_role` = ?';
		$data = array($name, $password , $email, $role);
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$dbDbh = null;	
	}

	/* Comment Add */
	function db_comment_add($commentArticleID, $commentUserID, $commentContent, $commentDate, $commentToken){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$sql= 'INSERT INTO `nxs_comment` SET `comment_article_id` = ?, `comment_user_id` = ?, `comment_content` = ?, `comment_date` = ?, `comment_token` = ?';
		$data = array($commentArticleID, $commentUserID, $commentContent, $commentDate, $commentToken);
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$dbDbh = null;	
	}

	/* Article Add */
	function db_article_add($articleTitle, $articleContent, $articleLike, $articleUser, $articledate, $articleToken){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$sql= 'INSERT INTO `nxs_article` SET `article_title` = ?, `article_content` = ?, `article_like` = ?, `article_user` = ?, `article_modify` = ?, `article_token` = ?';
		$data = array($articleTitle, $articleContent, $articleLike, $articleUser, $articledate, $articleToken);
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$dbDbh = null;	
	}

	/* Get Date without like*/
	function db_all_date($date){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		if($date == 'article'){
			$sql= 'SELECT COUNT(*) AS `num` FROM `nxs_article`';
		}elseif($date == 'user'){
			$sql= 'SELECT COUNT(*) AS `num` FROM `nxs_user`';
		}elseif($date == 'comment'){			
			$sql= 'SELECT COUNT(*) AS `num` FROM `nxs_comment`';
		}	
		$data = array();
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
	
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec['num'];		
	}
?>
