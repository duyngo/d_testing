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

$ids = array();
if(isset($_POST)){
	$res = $User->query("SELECT `id` FROM `tblSportsComment` WHERE `userId`='" . $_POST['id'] . "'");
	$list_response_id = array();
	if(is_array($res) && count($res) > 0){
		foreach ($res as $idx => $val) {
			$ids = $val['id'];
			if(isset($ids) && count($ids) > 0){
				$result = $User->query("SELECT * FROM `tblCommentResponse` WHERE `checkUser`='N' AND `isVerified`='Y' AND `category`='1' AND `responseId`='" . $ids . "'");
					if(is_array($result) && count($result) > 0){
						foreach ($result as $key => $value) {
							//echo $value['id'];
							$list_response_id[] = $value['responseId'];
							$res12 = $User->query("SELECT `id`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res12) && count($res12) > 0){
							foreach ($res12 as $key => $val12) {
								if($val12['groupId'] == 0){
									$name = 'Admin';
								}else if($val12['groupId'] == 2){
									$name = $val12['siteName'];
								}
							}
							$res13 = $User->query("SELECT * FROM `tblWebCards` WHERE `id` = '" . $value['categoryId'] . "'");
							if(is_array($res13) && count($res13) > 0){
								foreach ($res13 as $key => $val13) {
									$sportsName = $val13['sportsName'];
								}

								echo '<a href="sports-details/'.$val13["id"].'/'.$sportsName.'">
										<div class="row content">
											<p class="text-white">'.$name.'</p>
											<p class="text-yellow">Replied to your Comment posted on '.$sportsName.'</p>
										</div>
									</a>';

							}
						}
					}
				}
			}
		}
	}
	//check nofitfy for user when Admin accepted verify comment
	$list_response_id = implode(",",$list_response_id);

	if($list_response_id){
		$res = $User->query("SELECT * FROM `tblSportsComment` WHERE `userId`='" . $_POST['id'] . "' AND `id` NOT IN ($list_response_id) AND `isRecommanded` = 'Y' AND `checkUser` = 'N'");
	}else{
		$res = $User->query("SELECT * FROM `tblSportsComment` WHERE `userId`='" . $_POST['id'] . "' AND `isRecommanded` = 'Y' AND `checkUser` = 'N'");
	}


	if(is_array($res) && count($res) > 0) {
		foreach ($res as $idx => $val) {
			$res13 = $User->query("SELECT * FROM `tblWebCards` WHERE `id` = '" . $val['sportsId'] . "'");
			if(is_array($res13) && count($res13) > 0){
				foreach ($res13 as $key => $val13) {
					$sportsName = $val13['sportsName'];
				}

				echo '<a href="sports-details/'.$val13["id"].'/'.$sportsName.'">
										<div class="row content">
											<p class="text-white">Admin</p>
											<p class="text-yellow">Verified your Comment posted on '.$sportsName.'</p>
										</div>
									</a>';

			}

		}
	}

}
?>