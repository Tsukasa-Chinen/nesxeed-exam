<?php
	require_once('functions.php');
	session_start();

	if(empty($_POST['customer_id'])):
		header('Location: list.php');
	else:
		$title = 'Customer Updated';
		require_once('header.php');

		/* Update */
		if($_POST['customer_type'] == 'contract'){	
			$updateSQL = 'UPDATE `nxs_customer` SET `customer_modify`=?, `customer_name`=?, `customer_email`=?, `customer_tel`=?, `customer_plan`=? ,`customer_other`=? ,`customer_staff`=? ,`customer_progress`=? ,`customer_sells`=? ,`customer_studay`=? ,`customer_duration`=? ,`customer_start`=? ,`customer_notice`=? WHERE `customer_id` LIKE ?';											
			$updateData = array(
				 date('Y-m-d H:i:s')
				,$_POST['customer_name']
				,$_POST['customer_email']
				,$_POST['customer_tel']
				,$_POST['customer_plan']
				,$_POST['customer_other']
				,$_POST['customer_staff']
				,$_POST['customer_progress']
				,$_POST['customer_sells']
				,$_POST['customer_studay']
				,$_POST['customer_duration']
				,$_POST['customer_start']
				,$_POST['customer_notice']
				,$_POST['customer_id']
			);			
		}elseif($_POST['customer_type'] == 'normal'){		
			$updateSQL = 'UPDATE `nxs_customer` SET `customer_modify`=?, `customer_name`=?, `customer_email`=? ,`customer_tel`=? ,`customer_plan`=? ,`customer_other`=? ,`customer_staff`=? ,`customer_progress`=? WHERE `customer_id` LIKE ?';
			$updateData = array(
				 date('Y-m-d H:i:s')
				,$_POST['customer_name']
				,$_POST['customer_email']
				,$_POST['customer_tel']
				,$_POST['customer_plan']
				,$_POST['customer_other']
				,$_POST['customer_staff']
				,$_POST['customer_progress']
				,$_POST['customer_id']
			);						
		}		
		$updateStmt = $dbDbh->prepare($updateSQL);
		$updateStmt->execute($updateData);
	
		/* DB disconnect */
		$dbDbh = null;	
	endif;
?>
	<div class="updated">
		<p><?php echo $_POST['customer_name']; ?>様のデータの更新が完了しました。</p>
		<div class="btn_area">
			<input type="hidden" name="customer_id" value="<?php echo $_POST['customer_id']; ?>">
			<p><a class="btn go" href="list.php">一覧に戻る</a></p>
		</div>		
	</div>
	<!-- /.updated -->
<?php require_once('footer.php'); ?>