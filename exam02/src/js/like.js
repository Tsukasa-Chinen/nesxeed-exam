$(function(){
	$(document).on('click', '.jq_like', function(){
		var $articleID = $(this).attr('data-article-id');

			$.ajax({
			  type: 'POST',
			  url:  'like.php',
			  data: {
				  articleID: $articleID
				},
			})
			.done(function($response){
				$('.article_info_like' + $articleID).html('<i class="fa fa-heart">&nbsp;</i>' + $response);
				$('.article_info_like' + $articleID).addClass('current');
				setTimeout(function(){
					$('.article_info_like' + $articleID).removeClass('current');
				}, 1500);
			})
			.fail(function($response){
				alert('更新に失敗しました');
			});		
		return false;
	});
});