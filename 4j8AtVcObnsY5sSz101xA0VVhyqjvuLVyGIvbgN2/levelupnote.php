<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
//Init User class
$Base = new Base();
$User = new User();
$Card = new Card();
$Common = new Common();

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}

$result = $User->query("SELECT `TLU`.`id` AS `TLUID`, `TLU`.`userId`, `TLU`.`isVerified`, `TLU`.`msg`, `TLU`.`createdOn`, `TU`.`userId`, `TU`.`nickName`, `TU`.`id` AS `TUID` FROM `tblLevelUp` AS `TLU`, `tblUser` AS `TU` WHERE `checkAdmin`='N' AND `TLU`.`createdBy` = `TU`.`id`");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {

			echo '<li>
					<a href="userEdit.php?edit='.$value["TUID"].'"><hgroup>
						<h1>'.$value["nickName"].'</h1>
						<h2>Request for a level up</h2>  
					</hgroup>
					</a>
				</li>';

		}
	}
?>