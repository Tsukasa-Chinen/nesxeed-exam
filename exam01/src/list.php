<?php 
	require_once('functions.php');
	session_start();
	if(empty($_SESSION['id'])):
		header('Location: index.php');
	else:
		$title = 'Customer List';
		require_once('header.php');
	
	
		/* User Data */
		$usersCall = db_user_call($_SESSION['user_email']);
	
		/* Customer Data */
		if($usersCall['user_role'] == 'admin'){
			$customerSQL = 'SELECT * FROM `nxs_customer` ORDER BY `customer_id` DESC';		
			$customerData = array();
			$creatUser = '<div class="add_user"><a class="add_user_link" href="user.php"><i class="fa fa-plus-circle">&nbsp;</i>ユーザー追加</a></div>';
		}else {
			$customerSQL = 'SELECT * FROM `nxs_customer` WHERE `customer_staff` LIKE ? ORDER BY `customer_id` DESC';
			$customerData = array($usersCall['user_id']);
			$creatUser = '';
		}
		$customerStmt = $dbDbh->prepare($customerSQL);
		$customerStmt->execute($customerData);	
		$customers = array();	
		while (1) {
			$customerRecord = $customerStmt->fetch(PDO::FETCH_ASSOC);
			if($customerRecord == false){
				break;
			}
			$customers[] = $customerRecord;
		}
		
		echo $creatUser;
	
		/* Customer list */
		foreach((array) $customers as $customer):
			$userSQL = 'SELECT * FROM `nxs_user` WHERE `user_id` LIKE ?';		
			$userData = array($customer['customer_staff']);
			$userStmt = $dbDbh->prepare($userSQL);
			$userStmt->execute($userData);
			$users = array();
			
			/* Loop Start */		
			while (1) {
				$userRecord = $userStmt->fetch(PDO::FETCH_ASSOC);
				if($userRecord == false){
					break;
				}
				$users[] = $userRecord;
			}
			
			foreach($users as $user){
				$userName = $user['user_name'];
			}
?>
		<div class="customer">
			<dl class="customer_list">
				<dt>更新日</dt>
				<dd><?php echo $customer['customer_modify']; ?></dd>
				<dt>氏　名</dt>
				<dd><?php echo $customer['customer_name']; ?></dd>
				<dt>メールアドレス</dt>
				<dd><?php echo $customer['customer_email']; ?></dd>
				<dt>電話番号</dt>
				<dd><?php echo $customer['customer_tel']; ?></dd>
				<dt>希望留学プラン</dt>
<?php
			if($customer['customer_plan'] == 'english'){
				$progress = '英語留学';
			}elseif($customer['customer_plan'] == 'engineer'){
				$progress = 'エンジニア留学';
			}else{
				$progress = '国内留学';			
			}
?>
				<dd><?php echo $progress; ?></dd>
				<dt>その他（質問など）</dt>
				<dd><?php echo nl2br($customer['customer_other']); ?></dd>
				<dt>担当者</dt>
				<dd><?php echo $userName; ?></dd>
<?php
			if($customer['customer_progress'] == 'reply'){
				$progress = 'メール返信済み';
			}elseif($customer['customer_progress'] == 'interview'){
				$progress = '電話面談(営業)済み';
			}elseif($customer['customer_progress'] == 'sect'){
				$progress = '申込書送付済み';
			}elseif($customer['customer_progress'] == 'contract'){
				$progress = '契 約';
			}else{
				$progress = '問合せ受け取り';			
			}
?>		
				<dt>進捗状況</dt>
				<dd><?php echo $progress; ?></dd>				
			</dl>
			<!-- /.customer_list -->
<?php if($customer['customer_progress'] == 'contract'): ?>
			<dl class="customer_list">
				<dt>売　上</dt>
				<dd><span class="customer_sells"><?php echo number_format($customer['customer_sells']); ?>&nbsp;円</span></dd>
				<dt>留学プラン</dt>
				<dd><?php echo $customer['customer_studay']; ?></dd>
				<dt>期　間</dt>
				<dd><?php echo $customer['customer_duration']; ?>&nbsp;週間</dd>
				<dt>開始日</dt>
				<dd><?php echo $customer['customer_start']; ?></dd>
				<dt>特記事項</dt>
				<dd><?php echo nl2br($customer['customer_notice']); ?></dd>
			</dl>
			<!-- /.customer_list -->
<?php endif; ?>
			<div class="btn_area">
				<form action="customer-edit.php" method="post">
					<input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
					<p><input class="btn go" type="submit" value="編　集"></p>
				</form>				
			</div>
		</div>
		<!-- /.customer -->
<?php		
		endforeach; 
		/* DB disconnect */
		$dbDbh = null;
	endif;	
	require_once('footer.php'); 
?>