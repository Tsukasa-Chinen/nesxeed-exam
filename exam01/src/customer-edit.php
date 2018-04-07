<?php
	require_once('functions.php');
	session_start();

	if(empty($_POST['customer_id'])):
		header('Location: list.php');
	else:
		$title = 'Customer Edit';
		require_once('header.php');

		$customerSQL = 'SELECT * FROM `nxs_customer` WHERE `customer_id` LIKE ?';
		$customerData = array($_POST['customer_id']);
	
		$customerStmt = $dbDbh->prepare($customerSQL);
		$customerStmt->execute($customerData);
		
		$customers = array();
		
		/* Loop Start */		
		while (1) {
			$customerRecord = $customerStmt->fetch(PDO::FETCH_ASSOC);
			if($customerRecord == false){
				break;
			}
			$customers[] = $customerRecord;
		}
?>
	<form class="form" action="customer-update.php" method="post">
<?php
		foreach((array) $customers as $customer):
			$userSQL = 'SELECT * FROM `nxs_user`';		
			$userData = array();
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
?>		
		<div class="customer">
			<dl class="customer_list">
				<dt>前回更新日</dt>
				<dd><input type="text" name="customer_modify" value="<?php echo $customer['customer_modify']; ?>"></dd>
				<dt>氏　名</dt>
				<dd><input type="text" name="customer_name" value="<?php echo $customer['customer_name']; ?>"></dd>
				<dt>メールアドレス</dt>
				<dd><input type="email" name="customer_email" value="<?php echo $customer['customer_email']; ?>"></dd>
				<dt>電話番号</dt>
				<dd><input type="tel" name="customer_tel" value="<?php echo $customer['customer_tel']; ?>"></dd>
				<dt>希望留学プラン</dt>
				<dd>
<?php
			$planArray = array(
				 'english'  => '英語留学'
				,'engineer' => 'エンジニア留学'
				,'domestic' => '国内留学'
			);
			foreach((array) $planArray as $key => $val):
				if($key == $customer['customer_plan']){
					$selected = ' checked="checked"';
				}else{
					$selected = '';				
				}
?>
					<label class="customer_label"><input type="radio" name="customer_plan" value="<?php echo $key; ?>"<?php echo $selected; ?>>&nbsp;<?php echo $val; ?>&nbsp;&nbsp;</label>
<?php endforeach; //$planArray ?>
				</dd>
				<dt>その他（質問など）</dt>
				<dd><textarea name="customer_other"><?php echo $customer['customer_other']; ?></textarea></dd>
				<dt>担当者</dt>
				<dd>
					<select name="customer_staff">
<?php foreach((array) $users as $user): ?>
						<option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_name']; ?></option>
<?php endforeach; //$users ?>
					</select>
				</dd>
				<dt>希望留学プラン</dt>
				<dd>
					<select name="customer_progress">
<?php
			$progressArray = array(
				 'received'  => '問合せ受け取り'
				,'reply'    => 'メール返信済み'
				,'interview' => '電話面談(営業)済み'
				,'sect'      => '申込書送付済み'
				,'contract'  => '契 約'
			);
			foreach((array) $progressArray as $key => $val):
				if($key == $customer['customer_progress']){
					$selected = ' selected="selected"';
				}else{
					$selected = '';				
				}
?>

						<option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $val; ?></option>
<?php endforeach; //$progressArray ?>
					</select>
				</dd>
			</dl>
			<!-- /.customer_list01 -->
<?php if($customer['customer_progress'] == 'contract'): ?>
			<dl class="customer_list">
				<dt>売　上</dt>
				<dd><input type="text" class="w80" name="customer_sells" value="<?php echo $customer['customer_sells']; ?>">&nbsp;円</span></dd>
				<dt>留学プラン</dt>
				<dd><input type="text" name="customer_studay" value="<?php echo $customer['customer_studay']; ?>"></dd>
				<dt>期　間</dt>
				<dd><input type="number" class="w80" name="customer_duration" value="<?php echo $customer['customer_duration']; ?>">&nbsp;週間</dd>
				<dt>開始日</dt>
				<dd><input type="text" name="customer_start" value="<?php echo $customer['customer_start']; ?>"></dd>
				<dt>特記事項</dt>
				<dd><textarea name="customer_notice"><?php echo $customer['customer_notice']; ?></textarea></dd>
			</dl>
			<!-- /.customer_list -->
			<input type="hidden" name="customer_type" value="contract">
<?php else: ?>
			<input type="hidden" name="customer_type" value="normal">
<?php endif; ?>
			<div class="btn_area">
				<input type="hidden" name="customer_id" value="<?php echo $_POST['customer_id']; ?>">
				<p><input class="btn go" type="submit" value="更　新"></p>
			</div>
		</div>
		<!-- /.customer -->
<?php endforeach; ?>
	</form>
<?php
	/* DB disconnect */
	$dbDbh = null;
	endif;		
	require_once('footer.php'); 
?>