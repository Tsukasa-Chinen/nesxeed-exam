<?php

	ini_set('display_errors', 1);
	date_default_timezone_set('Asia/Tokyo');

	/* Common DB Setting */
	$dbDsn = 'mysql:dbname=nxs_exam;host=localhost';
	$dbUser = 'root';
	$dbPassword = '';
	$dbDbh = new PDO($dbDsn, $dbUser, $dbPassword);
	$dbDbh->query('SET NAMES utf8');	


	/* Check already created Admin */
	function db_user_admin(){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$id = 'admin';
		$sql = 'SELECT COUNT(*) AS `num` FROM `nxs_user` WHERE `user_role` LIKE ?';
		$data = array($id);
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec['num'];		
	}

	/* Check user e-mail */
	function db_user_email($email){
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
	function db_user_password($password){
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
	function db_user_call($email){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$email = $email;
		$sql = 'SELECT * FROM `nxs_user` WHERE `user_email` LIKE ?';
		$data = array($email);
		
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
	
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		return $rec;
	}

	/* User Add */
	function db_user_add($name, $password , $email, $role){
		global $dbDsn, $dbUser, $dbPassword, $dbDbh;
		$sql= 'INSERT INTO `nxs_user` SET `user_name` = ?, `user_password` = ?, `user_email` = ?, `user_role` = ?';
		$data = array($name, $password , $email, $role);
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
	}

?>
