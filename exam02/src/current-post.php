<?php 
	require_once('functions.php');
	$articleSQL = 'SELECT * FROM `nxs_article` WHERE `article_token` LIKE ?';		
	$articleData = array($_POST['article_token']);
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
	foreach($articles as $article):
?>
		<article class="article<?php echo $article['article_id']; ?> current">
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
		</article>
		<!-- /.article -->
<?php endforeach; ?>
