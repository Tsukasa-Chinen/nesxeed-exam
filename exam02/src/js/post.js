$(function(){

	$(document).on('click', '#jq_add_post_link', function(){
		$('#jq_modal').fadeIn();
		return false;
	});

	$(document).on('click', '#jq_modal_close_btn, #jq_modal_close_area', function(){
		$('#jq_modal').fadeOut();
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

	/* AJAX Get Current Post */
	function ajaxCurrentPostDB($token){
		$.ajax({
		  type: 'POST',
		  url:  'current-post.php',
		  data: {
			  article_token: $token
			},
		})
		.done(function($response){
			$('#jq_modal').fadeOut();
			$('#jq_modal [name="article_title"]').val('');
			$('#jq_modal [name="article_content"]').val('');
			$('#jq_modal [name="article_modify"]').val(currentTimer());
			$('#jq_modal [name="article_token"]').val(createToken());
			$('#jq_content').prepend($response);
			//console.log($response);
		})
		.fail(function($response){
			alert('エラーが起きました。ページをリロードしてください');
		});		
	}


	$(document).on('click', '#jq_new_post_btn', function(){
		var $articleTitel   = $('#jq_new_post [name="article_title"]').val(),
			$articleContent = $('#jq_new_post [name="article_content"]').val(),
			$articleLike    = 0,
			$articleUser    = $('#jq_new_post [name="article_user"]').val(),
			$articleDate    = $('#jq_new_post [name="article_modify"]').val(),
			$articleToken   = $('#jq_new_post [name="article_token"]').val();
			
		$.ajax({
		  type: 'POST',
		  url:  'post.php',
		  data: {
			  article_titel: $articleTitel,
			  article_content: $articleContent,
			  article_like: $articleLike,
			  article_user: $articleUser,
			  article_date: $articleDate,
			  article_token: $articleToken
			},
		})
		.done(function($response){
			ajaxCurrentPostDB($response);
			//console.log($response);
		})
		.fail(function($response){
			alert('更新に失敗しました');
		});		
		return false;		
	});
});