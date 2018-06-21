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

if(isset($_POST)){
$result = $User->query("SELECT `id`, `siteName`, `userId`, `updatedOn` FROM `tblComplaints` WHERE `checkSiteAdmin`='N' AND `siteName` = '" . $_POST['siteName'] . "'");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
				$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
							$username = $val['userId'];
						}
					}

					echo 	'<a href="siteComplaintRespons.php?edit='.$value["id"].'">
								<div class="row content">
									<p class="text-white">'.$username.'</p>
									<p class="text-yellow">Submited complaint against '.$value["siteName"].'</p>
								</div>
							</a>';

				//admin reply complaint
				$complainId = $value['id'];
				$result_1 = $User->query("SELECT * FROM `tblComplaintsResponse` WHERE `checkSiteAdmin`='N' AND `siteName` = 'Admin' AND `complaintId` = $complainId ");
				if(is_array($result_1) && count($result_1) > 0){
					foreach ($result_1 as $key => $val) {
						echo 	'<a href="siteComplaintRespons.php?edit='.$val["complaintId"].'">
								<div class="row content">
									<p class="text-white">Admin</p>
									<p class="text-yellow">replied Submited complaint</p>
								</div>
							</a>';

					}
				}

			}
		}
}
?>