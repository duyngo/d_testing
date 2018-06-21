<?php
require_once('../config.php');

// Load Classes
C::loadClass('User');
C::loadClass('Forum');

$User = new User();
$Forum = new Forum();



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	$tblname = '';
	if($_POST['parentid'] == 0){
		$tblname = 'tblForumTopicsSpam';
	}else{
		$tblname = 'tblForumTopicsResponseSpam';
	}
	// if($_POST['state'] == 1){
	// 	$state = 'Y';
	// 	$msg = 'liked';
	// }else{
	// 	$state = 'N';
	// 	$msg = 'disliked';
	// }

	$exi = $User->query("SELECT COUNT(`id`) AS `id` FROM `". $tblname ."` WHERE `topicUniqueId` = '". $_POST['topicueid'] ."' AND `status` = 'Y' AND `createdBy` = '". $_POST['id'] ."'");

	if($exi[0]['id'] > 0){
		echo '이미 신고하셨습니다.@@0';
	}else{
		$User->query("INSERT INTO `". $tblname ."` (`topicUniqueId`, `status`, `createdBy`, `updatedBy`, `createdOn`, `updatedOn`) VALUES ('". $_POST['topicueid'] ."', 'Y', '". $_POST['id'] ."', '". $_POST['id'] ."', '". date('Y-m-d H:i:s') ."', '". date('Y-m-d H:i:s') ."')");

		echo '정상적으로 신고되었습니다.@@1';
	}
}

?>