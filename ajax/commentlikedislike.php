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
		$tblname = 'tblForumTopicsLikeDislike';
	}else{
		$tblname = 'tblForumTopicsResponseLikeDislike';
	}
	if($_POST['state'] == 1){
		$state = 'Y';
		$msg = '좋아요를';
	}else{
		$state = 'N';
		$msg = '싫어요를';
	}

	$exi = $User->query("SELECT COUNT(`id`) AS `id` FROM `". $tblname ."` WHERE `topicUniqueId` = '". $_POST['topicueid'] ."' AND `status` = '". $state ."' AND `createdBy` = '". $_POST['id'] ."'");

	if($exi[0]['id'] > 0 && $state == 'Y'){
		echo '이미 좋아요를 누르셨습니다.@@0';
	}else if($exi[0]['id'] > 0 && $state == 'N'){
		echo '이미 싫어요를 누르셨습니다.@@0';  //update function required for to update like and dislike
	}else{
		$User->query("INSERT INTO `". $tblname ."` (`topicUniqueId`, `status`, `createdBy`, `updatedBy`, `createdOn`, `updatedOn`) VALUES ('". $_POST['topicueid'] ."', '". $state ."', '". $_POST['id'] ."', '". $_POST['id'] ."', '". date('Y-m-d H:i:s') ."', '". date('Y-m-d H:i:s') ."')");

		echo '방금 '. $msg .' 누르셨습니다..@@1';
	}
}

?>