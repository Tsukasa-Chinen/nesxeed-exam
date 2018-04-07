<?php
	require_once('functions.php');
	session_start();

	if(empty($_SESSION['id'])):
		header('Location: index.php');		
	else:
		$title = 'User Created';
		require_once('header.php');
		
		$checkEmail = db_user_email($_POST['user_email']);	
		
		$html = '';
		if(empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['user_password'])){
			$html .= '<dl class="errors">';	
			$html .= '<dt><i class="fa fa-exclamation-circle">&nbsp;</i>ERROR:</dt>';
			if(empty($_POST['user_name'])){
				$html .= '<dd class="error">ユーザー名を入力してください</dd>';
			}
			if(empty($_POST['user_email'])){
				$html .= '<dd class="error">メールアドレスを入力してください</dd>';
			}
			if(empty($_POST['user_password'])){
				$html .= '<dd class="error">パスワードを入力してください</dd>';
			}
			$html .= '</dl>';	
		}else{
			if($checkEmail == 1){
				$html .= '<dl class="errors">';	
				$html .= '<dt><i class="fa fa-exclamation-circle">&nbsp;</i>ERROR:</dt>';
				$html .= '<dd class="error">このメールアドレスは既に登録されています</dd>';				
				$html .= '</dl>';	
			}else{
				db_user_add($_POST['user_name'], $_POST['user_password'], $_POST['user_email'], $_POST['user_role']);
				$html .= '<dl class="success">';
				$html .= '<dt><i class="fa fa-thumbs-o-up">&nbsp;</i>SUCCESS:</dt>';
				$html .= '<dd>下記のユーザーを追加しました。</dd>';
				$html .= '<dd>'.$_POST['user_name'].'&nbsp;('.$_POST['user_email'].')</dd>';
				$html .= '</dl>';
				$html .= '<div class="btn_area">';
				$html .= '<p><a class="btn go" href="list.php">一覧に戻る</a></p>';
				$html .= '</div>';
			}
		}
?>
		<div class="customer">
			<?php echo $html; ?>
		</div>
<?php endif; ?>
