<?php
require_once('../config.php');

// Load Classes
C::loadClass('User');
C::loadClass('Forum');

$User = new User();
$Forum = new Forum();

//$uid = (User::userId($_POST['id']) == '' ? '' : User::userId($_POST['id']));



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){

	$total = $User->query("SELECT COUNT(`id`) AS `cid`, `id`, `isVerified` FROM `tblLevelUp` WHERE `userId` = '" . $_POST['id'] . "' LIMIT 0, 1");

	if($total[0]['cid'] > 0){
		if($total[0]['isVerified'] == 'N'){
			echo '신청해주신 등업 신청이 거절됐습니다. 라이브 채팅으로 문의해주세요.';
		}else{
			echo '이미 신청을 해주셨습니다. 만약 신청이 제대로 되지 않았을 경우, 라이브 채팅으로 문의해주세요.';
		}
	}else{
		$User->query("INSERT INTO `tblLevelUp` (`userId`, `checkUser`, `checkAdmin`, `isVerified`, `msg`, `createdBy`, `updatedBy`, `createdOn`, `updatedOn`) VALUES ('". $_POST['id'] ."', 'Y', 'N', 'P', '". $_POST['msg'] ."', '". $_POST['id'] ."', '". $_POST['id'] ."', '". date('Y-m-d H:i:s') ."', '". date('Y-m-d H:i:s') ."')");

		echo '성공적으로 신청됐습니다. 관리자 승인 후, 등업이 완료됩니다.';
	}
}

?>