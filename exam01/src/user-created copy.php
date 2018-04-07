<?php
	require_once('functions.php');
	session_start();

	if(empty($_SESSION['id'])):
		header('Location: index.php');		
	else:
		$title = 'User Created';
		require_once('header.php');
		
		$checkEmail = db_users_email($_POST['user_email']);	
?>
		<div class="customer">
<?php if($checkEmail == 1): ?>
			<dl class="errors">
				<dt><i class="fa fa-exclamation-circle">&nbsp;</i>ERROR:</dt>
				<dd class="error">このメールアドレスは既に登録されています</dd>
			</dl>
<?php 
	else:
	db_users_add($_POST['user_name'], $_POST['user_password'], $_POST['user_email'], $_POST['user_role']);		
?>
			<dl class="success">
				<dt><i class="fa fa-thumbs-o-up">&nbsp;</i>SUCCESS:</dt>
				<dd>下記のユーザーを追加しました。</dd>
				<dd><?php echo $_POST['user_name'].'（'.$_POST['user_email'].'）'; ?></dd>
			</dl>
			<div class="btn_area">
				<input type="hidden" name="customer_id" value="<?php echo $_POST['customer_id']; ?>">
				<p><a class="btn go" href="list.php">一覧に戻る</a></p>
			</div>		
<?php endif; ?>
		</div>