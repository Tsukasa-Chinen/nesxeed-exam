<?php
	require_once('functions.php');
	session_start();
	if(empty($_SESSION['id'])):
		header('Location: index.php');		
	else:
		$title = 'User';
		require_once('header.php');
?>
	<form class="form" action="user-created.php" method="post">
		<div class="customer">
			<p class="user_message">下記の情報を入力して新しいユーザーを作成してください。</p>
			<dl class="customer_list">
				<dt>権　限</dt>
				<dd>
					<label><input type="radio" name="user_role" value="admin">&nbsp;管理者&nbsp;&nbsp;</label>
					<label><input type="radio" name="user_role" value="sells" checked="checked">&nbsp;営業用</label></p>
				</dd>
				<dt>ユーザー名</dt>
				<dd><input type="text" name="user_name"></dd>
				<dt>メールアドレス</dt>
				<dd><input type="email" name="user_email"></dd>
				<dt>パスワード</dt>
				<dd><input type="password" name="user_password"></dd>
			</dl>
			<div class="btn_area">
				<p><input class="btn go" type="submit" value="作　成"></p>
			</div>
	</form>
<?php endif; ?>