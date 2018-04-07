<?php 
	require_once('functions.php');
	$commentSQL = 'SELECT * FROM `nxs_comment` WHERE `comment_token` LIKE ?';		
	$commentData = array($_POST['comment_token']);
	$commentStmt = $dbDbh->prepare($commentSQL);
	$commentStmt->execute($commentData);
	
	$comments = array();
	
	/* Loop Start */		
	while (1) {
		$commentRecord = $commentStmt->fetch(PDO::FETCH_ASSOC);
		if($commentRecord == false){
			break;
		}
		$comments[] = $commentRecord;
	}
	foreach($comments as $comment):
		$usersCallID = db_users_call('', $comment['comment_user_id']);
?>
				<ul class="comment_list_content current">
					<li><span class="comment_list_content_author"><?php echo $usersCallID['user_name']; ?></span><i class="comment_list_content_date">（<?php echo $comment['comment_date']; ?>）</i></li>
					<li class="comment_list_content_text"><?php echo $comment['comment_content']; ?></li>
				</ul>
<?php 
	endforeach;
	/* DB disconnect */
	$dbDbh = null;	
?>