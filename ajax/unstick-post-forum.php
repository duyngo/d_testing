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
		$tblname = 'tblForumTopics';
		$item = 'discussion';
		$do = 0;
	}else{
		$tblname = 'tblForumTopicsResponse';
		$item = 'post';
		$do = 1;
	}
	

	// $img = '';
	$exi = $User->query("UPDATE `". $tblname ."` SET `isSticky`='N' WHERE `id` = '". $_POST['id'] ."'");
	echo $item . " 가 고정취소 됐습니다.@@ " .$do;

	
}

?>