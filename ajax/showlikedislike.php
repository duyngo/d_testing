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
	if($_POST['cat'] == 'like'){
		$cat = 'Y';
		//$msg = 'liked';
	}else{
		$cat = 'N';
		//$msg = 'disliked';
	}

	$img = '';
	$exi = $User->query("SELECT `TLU`.`createdOn`, `TLU`.`status`, `TU`.`id`, `TU`.`nickname`, `TU`.`profile_img`, `TU`.`groupId` FROM `". $tblname ."` AS `TLU`, `tblUser` AS `TU` WHERE `topicUniqueId` = '". $_POST['topicueid'] ."' AND `status` = '". $cat ."' AND `TLU`.`createdBy` = `TU`.`id` ORDER BY `TLU`.`createdOn` DESC");

	foreach ($exi as $key => $value) {
		if($value['profile_img'] == NULL && $value['groupId'] == 3){
			$img = '<img class="media-object" src="images/user/user8.png" style="width:40px" />';
		}else if($value['profile_img'] == NULL && $value['groupId'] == 2){
			$img = '<img class="media-object" src="images/user/user10.png" style="width:40px" />';
		}else if($value['profile_img'] != NULL && $value['groupId'] == 2){
			$img = '<img class="media-object" src="'.$value['profile_img'].'" style="width:40px" />';
		}else if ($value['groupId'] == 0) {
			$img = '<img class="media-object" src="images/user/'.$value['profile_img'].'" style="width:40px" />';
		}
		$createdDate   	= date_create($value['createdOn']);
		$end 			= date_create(SESSION_START_TIME);
		$diff  			= date_diff( $createdDate, $end );
		if($diff->y > 0){
			$t = $_POST['cat'] . 'd '. $diff->y . ' 년 전';
		}else if($diff->m > 0){
			$t = $_POST['cat'] . 'd '. $diff->m . ' 달 전';
		}else if($diff->d > 0){
			$t = $_POST['cat'] . 'd '. $diff->d . ' 일 전';
		}else if($diff->h > 0){
			$t = $_POST['cat'] . 'd '. $diff->h . ' 시간 전';
		}else if($diff->m > 0){
			$t = $_POST['cat'] . 'd '. $diff->i . ' 분 전';
		}else{
			$t = $_POST['cat'] . 'd '. $diff->s . ' 초 전';
		}
	echo 	'<div class="media">
			  	<div class="media-left">
			    	'.$img.'
			  	</div>
			  	<div class="media-body">
			    	<h5 class="media-heading">'.$value['nickname'].'</h5>
			    	<small>'. $t .'</small>
			  	</div>
			</div>';
	}
}

?>