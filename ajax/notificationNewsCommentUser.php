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
	$res = $User->query("SELECT `id` FROM `tblNewsComment` WHERE `userId`='" . $_POST['id'] . "'");
	//var_dump($res);
	$list_response_id = array();
	if(is_array($res) && count($res) > 0){
		foreach ($res as $idx => $val) {
			$ids = $val['id'];
			if(isset($ids) && count($ids) > 0){
				$result = $User->query("SELECT * FROM `tblCommentResponse` WHERE `checkUser`='N' AND `isVerified`='Y' AND `category`='4' AND `responseId`='" . $ids . "'");
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
							$res13 = $User->query("SELECT * FROM `tblNewsBlog` WHERE `id` = '" . $value['categoryId'] . "'");
							if(is_array($res13) && count($res13) > 0){
								foreach ($res13 as $key => $val13) {
									$newsName = $val13['title'];
								}

								echo '<a href="news-details/'.$val13["id"].'/'.$newsName.'">
									<div class="row content">
										<p class="text-white">'.$name.'</p>
										<p class="text-yellow">Replied to your Comented posted on '.$newsName.'</p>
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
	//echo $list_response_id;
	if($list_response_id){
		$res = $User->query("SELECT * FROM `tblNewsComment` WHERE `userId`='" . $_POST['id'] . "' AND `id` NOT IN ($list_response_id) AND `isRecommanded` = 'Y' AND `checkUser` = 'N'");
	}else{
		$res = $User->query("SELECT * FROM `tblNewsComment` WHERE `userId`='" . $_POST['id'] . "' AND `isRecommanded` = 'Y' AND `checkUser` = 'N'");
	}


	if(is_array($res) && count($res) > 0) {
		foreach ($res as $idx => $val) {
			//var_dump($res);
			$res13 = $User->query("SELECT * FROM `tblNewsBlog` WHERE `id` = '" . $val['newsId'] . "'");
			if(is_array($res13) && count($res13) > 0){
				//var_dump($res13);
				foreach ($res13 as $key => $val13) {
					$newsName = $val13['title'];
				}

				echo '<a href="news-details/'.$val13["id"].'/'.$newsName.'">
									<div class="row content">
										<p class="text-white">Admin</p>
										<p class="text-yellow">Verified your Comment posted on '.$newsName.'</p>
									</div>
								</a>';

			}

		}
	}

}
?>