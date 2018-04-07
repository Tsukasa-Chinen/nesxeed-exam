$(function(){
	$('[class *= "jq_comment_action"]').slideUp();
	$(document).on('click', '[class *= "jq_comment"]', function(){
		var $articleID = $(this).attr('data-article-id');
		
		if(!$(this).hasClass('on')){
			$(this).addClass('on');
			$('.jq_comment_action' + $articleID).slideDown();					
		}else{
			$(this).removeClass('on');
			$('.jq_comment_action' + $articleID).slideUp();					
		}
		return false;
	});

	/* Timer */
	function timerDouble($num){
		$num += "";
		if($num.length === 1){
			$num = '0' + $num;
		}
		return $num;     
	};

	function currentTimer(){
		var $date = new Date(),
			$yyyy = $date.getFullYear(),
			$mm   = timerDouble($date.getMonth() + 1),
			$dd   = timerDouble($date.getDate()),
			$hh   = timerDouble($date.getHours()),
			$mi   = timerDouble($date.getMinutes()),
			$se   = timerDouble($date.getSeconds());
		
		var $format = $yyyy + '-' + $mm + '-' + $dd+ ' ' + $hh + ':' + $mi+ ':' + $se;
		return $format;
	}
	
	/* Token */
	function createToken(){		
		var $l = 16,
			$c = 'abcdefghijklmnopqrstuvwxyz0123456789',
			$cl = $c.length,
			$r = '';
			
		for(var $i = 0; $i < $l; $i++){
			$r += $c[Math.floor(Math.random()*$cl)];
		}
		
		return $r;
	}
    
	/* AJAX Get Current Comment */
	function ajaxCurrentCommentDB($token, $articleID){
		$.ajax({
		  type: 'POST',
		  url:  'current-comment.php',
		  data: {
			  comment_token: $token
			},
		})
		.done(function($response){
			$('.jq_comment_list' + $articleID).addClass('on');			
			$('.jq_comment_list_wrapper' + $articleID).prepend($response);			
			$('.jq_comment_action' + $articleID + ' textarea').val('');
			$('.jq_comment_action' + $articleID + ' textarea').val('');
			$('.jq_comment_action' + $articleID).slideUp();
			$('.jq_comment' + $articleID).removeClass('on');
			$('.jq_comment_action' + $articleID + ' [name="comment_token"]').val(createToken());
			$('.jq_comment_action' + $articleID + ' [name="comment_date"]').val(currentTimer());
		})
		.fail(function($response){
			alert('エラーが起きました。ページをリロードしてください');
		});		
	}
	
	/* AJAX Comment Save DB */
	$(document).on('click', '.jq_post_comment', function(){
		var $commentID        = $(this).attr('data-article-id'),
			$commentGroup     = $('.jq_comment_action' + $commentID),
			$commentContent   = $commentGroup.children('textarea[name="comment_content"]').val(),
			$commentDate      = $commentGroup.children('input[name="comment_date"]').val(),
			$commentArticleID = $commentGroup.children('input[name="comment_article_id"]').val(),
			$commentUserID    = $commentGroup.children('input[name="comment_user_id"]').val(),
			$commentToken     = $commentGroup.children('input[name="comment_token"]').val();

			$.ajax({
			  type: 'POST',
			  url:  'comment.php',
			  data: {
				  comment_content: $commentContent,
				  comment_date: $commentDate, 
				  comment_article_id: $commentArticleID, 
				  comment_user_id: $commentUserID,
				  comment_token: $commentToken
				},
			})
			.done(function($response){
				ajaxCurrentCommentDB($response, $commentID);
			})
			.fail(function($response){
				alert('コメントの投稿に失敗しました');
			});		
			
		return false;
  	});
});