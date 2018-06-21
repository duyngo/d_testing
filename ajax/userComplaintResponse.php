

<?php

require_once('../config.php');



// Load Classes

C::loadClass('User');

C::loadClass('Card');

C::loadClass('CMS');

//Init User class

$Base = new Base();

$User = new User();

$Card = new Card();

$Common = new Common();



if(!$User->checkLoginStatus()){

	$Common->redirect('index.php');

}



$ids = array();

if(isset($_POST)){
	$res = $User->query("SELECT `id` FROM `tblComplaints` WHERE `userId` = '" . $_POST['id'] . "'");
	$list_response_id = array();
	if(is_array($res) && count($res) > 0){
		foreach ($res as $idx => $val) {
			$ids = $val['id'];
			$result = $User->query("SELECT `id`, `complaintId`, `siteName` FROM `tblComplaintsResponse` WHERE `checkUser`='N' AND `isVerified`='Y' AND `complaintId` = '" . $ids . "'");
			if(is_array($result) && count($result) > 0){
				foreach ($result as $key => $value) {
					$list_response_id[] = $value["complaintId"];
			echo 	'<a href="complaintsDetail.php?detail='.$value["complaintId"].'">
						<div class="row content">
						<p class="text-white">'.$value["siteName"].'</p>
						<p class="text-yellow">Replied to your complaint </p>
						</div>
					</a>';

				}
			}
		}
	}
	//check nofitfy for user when Admin accepted verify comment
	$list_response_id = implode(",",$list_response_id);

	if($list_response_id){
		$res = $User->query("SELECT * FROM `tblComplaints` WHERE `userId`='" . $_POST['id'] . "' AND `id` NOT IN ($list_response_id) AND `isVerified` = 'Y' AND `checkUser` = 'N'");
	}else{
		$res = $User->query("SELECT * FROM `tblComplaints` WHERE `userId`='" . $_POST['id'] . "' AND `isVerified` = 'Y' AND `checkUser` = 'N'");
	}


	if(is_array($res) && count($res) > 0) {
		foreach ($res as $idx => $val) {
			echo 	'<a href="complaintsDetail.php?detail='.$val["id"].'">
						<div class="row content">
						<p class="text-white">'.$val["complaintTitle"].'</p>
						<p class="text-yellow">Admin Verified your complaint </p>
						</div>
					</a>';

		}
	}

}

?>