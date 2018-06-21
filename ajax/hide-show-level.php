<?php
require_once('../config.php');

// Load Classes
C::loadClass('User');
C::loadClass('Forum');

$User = new User();
$Forum = new Forum();
$lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$gid = ((int)User::groupId($lid) > 0 ? User::groupId($lid) : 0);



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	echo $gid.'@@'.$lid;
}

?>