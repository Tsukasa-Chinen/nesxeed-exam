<?php 
	require_once('functions.php');
	session_start();

	if(empty($_SESSION['id'])):
		header('Location: index.php');
	else:
		$title = 'Article List';
		require_once('header.php');

		/* User Data */
		$currentUser = db_users_call($_SESSION['user_email'], '');	

		/* DB nxs_article Conect */
		$articleSQL = 'SELECT * FROM `nxs_article` ORDER BY `article_id` DESC';
		$articleData = array();
		$articleStmt = $dbDbh->prepare($articleSQL);
		$articleStmt->execute($articleData);	
	
		$articles = array();	
		while (1) {
			$articleRecord = $articleStmt->fetch(PDO::FETCH_ASSOC);
			if($articleRecord == false){
				break;
			}
			$articles[] = $articleRecord;
		}
	
		if($currentUser['user_role'] == 'admin'):
		
		/* SUM Like */
		$totalLike = array();		
		foreach((array) $articles as $article){
			$totalLike[] = $article['article_like'];
		}
		$sumLike = array_sum($totalLike);
?>
		<div class="date">
			<ul class="date_list">
				<li class="date_list_user"><i class="fa fa-user">&nbsp;</i><?php echo db_all_date('user'); ?></li>
				<li class="date_list_article"><i class="fa fa-file">&nbsp;</i><?php echo db_all_date('article'); ?></li>
				<li class="date_list_like"><i class="fa fa-heart">&nbsp;</i><?php echo $sumLike; ?></li>
				<li class="date_list_comment"><i class="fa fa-comment">&nbsp;</i><?php echo db_all_date('comment'); ?></li>
				<li class="date_list_new"><a id="jq_add_post_link" class="add_post_link" href="/"><i class="fa fa-plus-circle">&nbsp;</i>新規作成</a></li>
			</ul>
		</div>
		<!-- /.date -->
<?php endif; /* $currentUser['user_role'] == 'admin' */ ?>
		<div id="jq_content" class="content">
<? foreach((array) $articles as $article): ?>
			<article class="article<?php echo $article['article_id']; ?>">
				<header class="article_header">
					<h2 class="article_title"><?php echo $article['article_title']; ?></h2>
				</header>
				<!-- /.article_header -->
				<ul class="article_info">
<?php $author = db_users_call('', $article['article_user']); ?>
					<li><i class="fa fa-user">&nbsp;</i><?php echo $author['user_name']; ?>&nbsp;&nbsp;<i class="fa fa-calendar">&nbsp;</i><?php echo $article['article_modify']; ?>&nbsp;&nbsp;<span class="article_info_like<?php echo $article['article_id']; ?>"><i class="fa fa-heart">&nbsp;</i><?php echo $article['article_like']; ?></span></li>
				</ul>
				<!-- /.article_info -->
				<div class="article_content">
<?php echo nl2br($article['article_content']); ?>				
				</div>
				<!-- /.article_content -->
				<ul class="article_action">
					<li><button class="btn btn_like jq_like" data-article-id="<?php echo $article['article_id']; ?>"><i class="fa fa-thumbs-o-up">&nbsp;</i>いいね！</button></li>
					<li><button class="btn btn_comment jq_comment<?php echo $article['article_id']; ?>" data-article-id="<?php echo $article['article_id']; ?>"><i class="fa fa-comment">&nbsp;</i>コメントする</button></li>
				</ul>
				<!-- /.article_action -->
				<div class="comment_action jq_comment jq_comment_action<?php echo $article['article_id']; ?>">
					<textarea name="comment_content"></textarea>
					<input type="hidden" name="comment_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
					<input type="hidden" name="comment_article_id" value="<?php echo $article['article_id']; ?>">
					<input type="hidden" name="comment_user_id" value="<?php echo $currentUser['user_id']; ?>">
					<input type="hidden" name="comment_token" value="<?php echo uniqid(); ?>">
					<button class="btn_do comment_action_btn jq_post_comment" data-article-id="<?php echo $article['article_id']; ?>">コメント投稿</button>					
				</div>
				<!-- /.comment_action -->
<?php
			/* DB nxs_comment Conect */
			$commentSQL = 'SELECT * FROM `nxs_comment` WHERE `comment_article_id` LIKE ? ORDER BY `comment_id` DESC';		
			$commentData = array($article['article_id']);
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
?>
<?php 
	if(!empty($comments)){
		$commentOn = ' on';
	}else{
		$commentOn = '';		
	}
?>
				<section class="comment_list<?php echo $commentOn; ?> jq_comment_list<?php echo $article['article_id']; ?>">
					<h3 class="comment_list_title"><i class="fa fa-comments">&nbsp;</i>Comments</h3>
					<div class="jq_comment_list_wrapper<?php echo $article['article_id']; ?>">					
<?php			
			foreach($comments as $comment):
				$usersCallID = db_users_call('', $comment['comment_user_id']);
?>
						<ul class="comment_list_content">
							<li><span class="comment_list_content_author"><?php echo $usersCallID['user_name']; ?></span><i class="comment_list_content_date">（<?php echo $comment['comment_date']; ?>）</i></li>
							<li class="comment_list_content_text"><?php echo $comment['comment_content']; ?></li>
						</ul>
<?php endforeach; /* $comments */ ?>
					</div>
				</section>
				<!-- /.comment_list -->				
			</article>
			<!-- /.article -->
<?php endforeach; /* $articles */ ?>
		</div>
		<!-- /.content -->
		<div id="jq_modal" class="modal">
			<i id="jq_modal_close_btn" class="modal_close_btn fa fa-remove"></i>
			<div id="jq_modal_close_area" class="modal_close_area"></div>
			<div class="modal_content">
				<div id="jq_new_post" class="new_post">					
					<p class="new_post_message">記事を新規に作成します。<br>タイトルと本文を入力してください</p>
					<p class="new_post_title"><input type="text" name="article_title" placeholder="タイトルを入力してください"></p>
					<p class="new_post_content"><textarea name="article_content" placeholder="本文を入力してください"></textarea></p>
					<div class="new_post_btn_area">						
						<input id="jq_new_post_btn" class="btn_do new_post_btn" type="submit" value="作 成">
						<input type="hidden" name="article_user" value="<?php echo $currentUser['user_id']; ?>">
						<input type="hidden" name="article_modify" value="<?php echo date('Y-m-d H:i:s'); ?>">
						<input type="hidden" name="article_token" value="<?php echo uniqid(); ?>">
					</div>
				</div>
			</div>
		</div>
		<!-- /.modal -->
<?php	
	endif;
	require_once('footer.php'); 
?>