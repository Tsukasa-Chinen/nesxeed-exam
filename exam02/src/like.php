<?php 
	require_once('functions.php');	
	if(empty($_POST['articleID'])){
		header('Location: list.php');		
	}else{
		$sql = 'SELECT `article_like` FROM `nxs_article` WHERE `article_id` LIKE ?';
		$data = array($_POST['articleID']);						
		$stmt = $dbDbh->prepare($sql);
		$stmt->execute($data);
	
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$dbh = null;
		
		$plusLikeCount = $rec['article_like'] + 1;
		
		$updateSQL = 'UPDATE `nxs_article` SET `article_like`=? WHERE `article_id` LIKE ?';											
		$updateData = array(
			 $plusLikeCount
			,$_POST['articleID']
		);						
	
		$updateStmt = $dbDbh->prepare($updateSQL);
		$updateStmt->execute($updateData);
	
		/* DB disconnect */
		$dbDbh = null;	
		
		echo $plusLikeCount;
	}
?>
