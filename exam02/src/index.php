<?php
	
	$title = 'Skill Exam for Engineer | Nexseed';
	
	if(!empty($_POST)){
		require_once('functions.php');
		$loginEmail = $_POST['login_email'];
		$checkEmail = db_users_email($loginEmail);

		$loginPassword = $_POST['login_password'];
		$checkPassword = db_users_password($loginPassword);

		$errors = '';
		if($checkEmail == 1 && $checkPassword == 1){
			session_start();
			session_regenerate_id();
			$_SESSION['id'] = session_id();
			$_SESSION['user_email'] = $loginEmail;
			header('Location: list.php');
			$errors = '';
			exit;
		}else{
			$errors .= '<dl class="errors">';		
			$errors .= '<dt><i class="fa fa-exclamation-circle">&nbsp;</i>ERROR:</dt>';		
			/* Email Check */
			if(empty($loginEmail)){
				$errors .= '<dd>・メールアドレスを入力してください</dd>';									
			}else{
				if($checkEmail != 1){
					$errors .= '<dd>・このメールアドレスは登録されていません</dd>';					
				}				
			}

			/* Password Check */
			if(empty($loginPassword)){
				$errors .= '<dd>・パスワードを入力してください</dd>';									
			}else{
				if($checkPassword != 1){
					$errors .= '<dd>・パスワードが正しくありません</dd>';					
				}				
			}
			$errors .= '</dl>';		
		}			
		echo $errors;	
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="./css/common.css">
</head>
<body>
	<form class="form login" action="" method="post">
		<h1 class="exam_logo">THE EXAM 02</h1>
		<ul class="login__list">
			<li><label><i class="fa fa-envelope-o"></i>メールアドレス</label><input type="email" name="login_email" value=""></li>
			<li><label><i class="fa fa-key"></i>パスワード<input type="password" name="login_password"></label></li>
		</ul>
		<div class="btn_area">
			<p><input class="btn btn_do" type="submit" value="ログイン"></p>
		</div>
	</form>
</body>
</html>