<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Forum');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
$Forum = new Forum();
$Common = new Common();

// if(!$User->checkLoginStatus()){
// 	$Common->redirect('index.php');
// }

// print_r($_POST);
// print_r($_FILES);

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && $_POST['__formname__'] == 'POSTTOPICSFORUM'){

	//print_r($_POST);
	//print_r($_FILES);die();
	if($Forum->addForumtopicResponse($_POST, $_FILES)){
		C::redirect(C::link($url, false, true));
    }	
}
$lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
?>

<?php require_once('includes/doc_head.php'); ?>

<style>
.forum-editor{
	width:100%;
	height:350px;
	color:#fff;
	background-color: #012D50;
	border:2px solid #fff;
	padding-top: 40px;
	padding-bottom: 40px;
	border-radius: 10px;
	box-shadow: 0px 0px 30px #000;
		-webkit-box-shadow: 0px 0px 30px #000;
			-moz-box-shadow: 0px 0px 30px #000;
				-o-box-shadow: 0px 0px 30px #000;
}
.forum-editor:focus{
	outline:0px;
}
</style>




<div class="ask-content" id="ask-content">
	<div class="row">
		<div class="col-lg-9 col-md-9">
			<?php 
			if(isset($_GET['id']) && trim($_GET['id']) && isset($_GET['title']) && trim($_GET['title'])){
				$ukI = $_GET['id'];

				$mainTopic = $User->query("SELECT `TFT`.`id`, `TFT`.`topicUniqueId`, `TFT`.`topicTitle`, `TFT`.`topicTags`, `TFT`.`topicDescription`, `TFT`.`topicFiles`, `TFT`.`createdOn`,`TFT`.`isSticky`, `TFT`.`createdBy`, `TU`.`userId`, `TU`.`nickName`, `TU`.`profile_img`, `TU`.`groupId`, `TU`.`createdOn` as `startedOn` FROM `tblForumTopics` as `TFT`, `tblUser` as `TU` WHERE `TFT`.`topicUniqueId` = '". $ukI ."' AND `TFT`.`createdBy` = `TU`.`id` ORDER BY `TFT`.`createdOn` DESC LIMIT 0, 1");
        		$tagswithcolor			= json_decode($mainTopic[0]['topicTags']);
        		$bgHeader 				= $tagswithcolor[0];
        		$bgHeader 				= explode('@@', $tagswithcolor[0]);
        		$countTags 				= 0;
        		$createdDate   			= date_create($mainTopic[0]['createdOn']);
        		$mainTopicLikeDislike 	= $User->query("SELECT 
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsLikeDislike` WHERE `topicUniqueId` = '". $mainTopic[0]['topicUniqueId'] ."' AND `status` = 'Y' ) AS `like`, 
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsLikeDislike` WHERE `topicUniqueId` = '". $mainTopic[0]['topicUniqueId'] ."' AND `status` = 'N' ) AS `dislike`,
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponse` WHERE `topicParentId` = '". $mainTopic[0]['topicUniqueId'] ."' ) AS `commentcount`,
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsSpam` WHERE `topicUniqueId` = '". $mainTopic[0]['topicUniqueId'] ."' ) AS `spamCount`");
			?>

			<header class="Hero betting-forum-details betting-forum-details--colored" style="background-color: <?php echo $bgHeader[0]; ?>;">
			        <ul class="betting-forum-details-items">
			            <li class="item-badges">
			                <ul class="betting-forum-details-badges badges">
			                	<?php if($mainTopic[0]['isSticky'] == 'Y'){ ?>
			                    <li class="item-sticky"><span class="Badge Badge--sticky " title="Sticky" data-original-title="Sticky"><i class="icon fa fa-thumb-tack Badge-icon"></i></span></li>
			                    <?php } ?>
			                </ul>
			            </li>
			            <li class="item-tags">
			            	<span class="TagsLabel">
			            		<?php
								foreach ($tagswithcolor as $topictagscolorkey => $topictagscolorvalue) {
									$tgcolorname = explode('@@', $topictagscolorvalue);
									if($countTags == 0){
								?>
			            		<a class="TagLabel colored" title="" href="javascript:void(0);" style="color: <?php echo $tgcolorname[0]; ?>; background-color: rgb(239, 86, 79);">
			            			<span class="TagLabel-text"><?php echo $tgcolorname[1]; ?></span>
			            		</a>
			            		<?php
			            		}else{
			            		?>
			            		<a class="TagLabel " title="" href="javascript:void(0);" style="color: #fff;background-color: <?php echo $tgcolorname[0]; ?>;">
			            			<span class="TagLabel-text"><?php echo $tgcolorname[1]; ?></span>
			            		</a>
			            		<?php	
			            		}
								$countTags++;
								}
								?>
			            	</span>
			            </li>
			            <li class="item-title">
			                <h3 class="betting-forum-details-title"><?php echo $mainTopic[0]['topicTitle']; ?></h3>
			            </li>
			            <li class="item-goback">
			            	<a class="" title="뒤로가기" href="javascript: history.go(-1);" style="color: <?php echo $tgcolorname[0]; ?>; background-color: #fff;">
		            			<span class="TagLabel-text"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
		            		</a>
		            	</li>
			        </ul>
			</header>

			
			<div class="clearfix"></div>
			<div class="betting-forum-details-list-main">
				<div class="betting-forum-details-bg">
					<div class="PostStream-item" data-index="0" data-time="<?php echo date_format($createdDate, DATE_COOKIE);?>" data-number="<?php echo $mainTopic[0]['id']; ?>" data-id="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-type="comment" style="display: block;">
					    <article class="Post undefined CommentPost">
					        <div>
					            <header class="Post-header">
					                <ul>
					                    <li class="item-user">
					                        <div class="PostUser">
					                            <h3>
					                            	<a href="javascript:void(0);">
					                            		<?php
										        		if($mainTopic[0]['profile_img'] == NULL && $mainTopic[0]['groupId'] == 4){
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/user8.png" />';
										        		}else if($mainTopic[0]['profile_img'] == NULL && $mainTopic[0]['groupId'] == 2){
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/user10.png" />';
										        		}else if($mainTopic[0]['profile_img'] != NULL && $mainTopic[0]['groupId'] == 2){
										        			echo '<img class="Avatar PostUser-avatar" src="'.$mainTopic[0]['profile_img'].'" />';
										        		}else if ($mainTopic[0]['groupId'] == 0) {
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/'.$mainTopic[0]['profile_img'].'" />';
										        		}
										        		?>
					                            		<span class="username"><?php echo $mainTopic[0]['nickName']; ?></span>
					                            	</a>
					                            </h3>
					                            <ul class="PostUser-badges badges">
					                            	<?php if($mainTopic[0]['groupId'] == 0){ ?>
					                                <li class="item-group1"><span class="Badge Badge--group--1 " title="Betting time admin" style="background-color: rgb(183, 42, 42);" data-original-title="Admin"><i class="icon fa fa-user Badge-icon"></i><!-- <i class="icon fa fa-wrench Badge-icon"></i> --></span></li>
					                                <?php } ?>
					                            </ul>
					                        </div>
					                    </li>
					                    <li class="dropdown report-flag">
				                    		<a class="btn dropdown-toggle btn-spam" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
										      	<i class="fa fa-ellipsis-h text-white text-white" aria-hidden="true"></i>
										    </a>
										    <ul class="dropdown-menu dropdown-menu-right">
										      	<li <?php if($lid == $mainTopic[0]['createdBy']) echo 'class="disabled"'; ?>><a href="javascript:void(0);" class="spam-check" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">신고하기 <span class="badge"><?php echo $mainTopicLikeDislike[0]['spamCount']; ?></span></a></li>
										      	<?php
										      	if(((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0) == 1){
										      	?>
										      	<li><a href="<?php echo C::link('edit-forum.php', array('id' => $mainTopic[0]['id'], 'table' => 'tblForumTopics'), true);?>" class="edit-post-forum" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-editid="<?php echo $mainTopic[0]['id']; ?>">수정하기</a></li>
										      	<li><a href="javascript:void(0);" class="delete-post" data-parentid="0" data-id="<?php echo $mainTopic[0]['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">삭제하기</a></li>
										      	<?php if($mainTopic[0]['isSticky'] == 'N'){ ?>
										      	<li><a href="javascript:void(0);" class="stick-post" data-parentid="0" data-id="<?php echo $mainTopic[0]['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">고정하기</a></li>
										      	<?php } else { ?>
									      		<li><a href="javascript:void(0);" class="unstick-post" data-parentid="0" data-id="<?php echo $mainTopic[0]['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">고정취소</a></li>
										      	<?php } ?>
										      	<?php } ?>
										    </ul>
					                    </li>
					                    <li class="item-meta">
					                        <div class="Dropdown PostMeta">
					                            <a class="Dropdown-toggle" data-toggle="dropdown">
					                                <time pubdate="true" title="<?php echo date_format($createdDate, 'F j, Y h:i A');?>" data-humantime="true"><?php echo date_format($createdDate, 'm.d.y');?></time>
					                            </a>
					                            <div class="Dropdown-menu dropdown-menu"><span class="PostMeta-number">Post #1</span> <span class="PostMeta-time"><time pubdate="true" datetime="<?php echo date_format($createdresponseDate, 'F j, Y h:i A');?>"><?php echo date_format($createdresponseDate, 'F j, Y h:i A');?></time></span> <span class="PostMeta-ip"></span>
					                                <input class="FormControl PostMeta-permalink">
					                            </div>
					                        </div>
					                    </li>
					                </ul>
					            </header>
					            <div class="Post-body">
					                <?php 
					                echo $mainTopic[0]['topicDescription']; 
					                if(!$mainTopic['topicFiles'] == '[]' || !$mainTopic['topicFiles'] == ''){ //echo 'beal';
					                //echo '<hr>';
					                echo '<ul class="topicFiles-list">';
					                $topicFiles = json_decode($mainTopic[0]['topicFiles']);
										foreach ($topicFiles as $topicFilesImg) { 
									?>
										<li>
											<a data-fancybox="images" href="<?php echo $topicFilesImg ;?>"><img src="<?php echo $topicFilesImg;?>" class="img-responsive" width="130px" height="90px" alt=""></a>
										</li>
									<?php

										}
									echo '</ul>';
					            	}
					                ?>

					            </div>
					            <aside class="Post-actions">
					                <ul>
					                    <li class="item-reply">
					                        <button class="btn btn-primary btn-xs open-reply-editor" type="button" title="Reply" data-index="1" data-parentid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>"><i class="icon fa fa-reply" style="margin-right: 5px;"></i>댓글달기</button>
					                    </li>
					                    
					                    <li class="item-like">
					                    	<div class="btn-group">
						                        <button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Like" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="1" <?php if($lid == $mainTopic[0]['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-up" style="margin-right: 5px;"></i>좋아요</button>

						                        <button class="btn btn-danger btn-xs like-dislike-count" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="like" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $mainTopicLikeDislike[0]['like']; ?></span></button>
					                    	</div>
					                    </li>
					                    <li class="item-dislike">
					                    	<div class="btn-group">
					                        	<button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Dislike" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="0" <?php if($lid == $mainTopic[0]['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-down" style="margin-right: 5px;"></i>싫어요</button>
					                        	<button class="btn btn-danger btn-xs like-dislike-count" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="dislike" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $mainTopicLikeDislike[0]['dislike']; ?></span></button>
					                        </div>
					                    </li>
					                </ul>
					            </aside>
					            <footer class="Post-footer">
					                <ul>
					                	<!-- like check and display -->
					                    <li class="item-liked">
					                        <div class="Post-likedBy"><i class="icon fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
					                        	<?php if($mainTopicLikeDislike[0]['like'] > 0){

												$likyby = $User->query("SELECT `TU`.`nickname` FROM `tblUser` AS `TU`, `tblForumTopicsLikeDislike` AS `TFTLD` WHERE `TFTLD`.`topicUniqueId` = '". $mainTopic[0]['topicUniqueId'] ."' AND `TU`.`id` = `TFTLD`.`createdBy` ORDER BY `TFTLD`.`createdOn` DESC LIMIT 0, 1");
												?>
					                        	<a href="javascript:void(0);"><span class="username"><?php echo $likyby[0]['nickname']; ?></span></a>

												<?php if(($mainTopicLikeDislike[0]['like'] - 1) > 1){?>
					                        	&nbsp;님과&nbsp; <a href="javascript:void(0);" class="like-dislike-count" data-parentid="0" data-topicueid="<?php echo $mainTopic[0]['topicUniqueId']; ?>" type="button" data-cat="like" data-toggle="modal" data-target="#likeDislikeModal"><?php echo ($mainTopicLikeDislike[0]['like'] - 1); ?> 명이</a>
												<?php } ?>
					                        	 이 글을 좋아합니다.
												<?php } else {
													echo '<span class="when-no-like">해당 글을 처음으로 추천해보세요.</span>';
												}?>
				                        	</div>
					                    </li>
					                    <!-- dislike check and display -->
					                    <li class="item-replies">
					                        <div class="Post-mentionedBy"><span class="Post-mentionedBy-summary"><i class="icon fa fa-reply" style="margin-right: 10px;"></i><a href="javascript:void(0);" data-number="3"><span class="username"></span></a> 님께서 댓글을 남기셨습니다. <a class="javascript:void(0);" type="button" title="View all replies"><i class="icon fa fa-chevron-down" style="margin-right: 5px;"></i>전체 댓글보기 &nbsp;<span class="badge"><?php echo $mainTopicLikeDislike[0]['commentcount']; ?></span></a></span>
					                            <ul class="Dropdown-menu Post-mentionedBy-preview fade"></ul>
					                        </div>
					                    </li>
					                </ul>
					            </footer>
					        </div>
					    </article>
					    <div class="Post-quoteButtonContainer"></div>
					</div>
				</div>
			</div>
			<?php } ?>

			<!-- reply and comment section -->
			<div class="betting-forum-details-list-reply">
				<div class="betting-forum-details-bg">
<!-- child index 1 -->
					<?php
					$responseTopicindexOne = $User->query("SELECT `TFTR`.`id`, `TFTR`.`topicParentId`, `TFTR`.`topicResponseUniqueId`, `TFTR`.`topicResponseIndex`, `TFTR`.`topicResponseDescription`, `TFTR`.`topicResponseFiles`, `TFTR`.`createdOn`, `TFTR`.`updatedOn`, `TFTR`.`createdBy`, `TU`.`userId`, `TU`.`nickName`, `TU`.`profile_img`, `TU`.`groupId`, `TU`.`createdOn` as `startedOn` FROM `tblForumTopicsResponse` as `TFTR`, `tblUser` as `TU` WHERE `TFTR`.`topicParentId` = '". $ukI ."' AND `TFTR`.`topicResponseIndex` = '1' AND `TFTR`.`isDispaly` = 'N' AND `TFTR`.`createdBy` = `TU`.`id` ORDER BY `TFTR`.`createdOn`");
					foreach ($responseTopicindexOne as $responseTopicindexOnekey => $responseTopicindexOnevalue) {
	        		$createdresponseDate   			= date_create($responseTopicindexOnevalue['createdOn']);
	        		$createdDateone   				= date_create($responseTopicindexOnevalue['createdOn']);
    				$endone 						= date_create($responseTopicindexOnevalue['updatedOn']);
    				$diffone  						= date_diff( $createdDateone, $endone );

	        		$topicsResponseLikeDislike 	= $User->query("SELECT 
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' AND `status` = 'Y' ) AS `like`, 
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' AND `status` = 'N' ) AS `dislike`,
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponse` WHERE `topicParentId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' ) AS `commentcount`,
					                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseSpam` WHERE `topicUniqueId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' ) AS `spamCount`");
					?>
					<div class="PostStream-item" data-index="<?php echo $responseTopicindexOnevalue['topicResponseIndex']; ?>" data-time="<?php echo date_format($createdresponseDate, DATE_COOKIE);?>" data-number="<?php echo $responseTopicindexOnevalue['id']; ?>" data-id="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-type="comment" style="display: block;">
					    <article class="Post undefined CommentPost">
					        <div>
					            <header class="Post-header">
					                <ul>
					                    <li class="item-user">
					                        <div class="PostUser">
					                            <h3>
					                            	<a href="javascript:void(0);">
					                            		<?php
										        		if($responseTopicindexOnevalue['profile_img'] == NULL && $responseTopicindexOnevalue['groupId'] == 4){
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/user8.png" />';
										        		}else if($responseTopicindexOnevalue['profile_img'] == NULL && $responseTopicindexOnevalue['groupId'] == 2){
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/user10.png" />';
										        		}else if($responseTopicindexOnevalue['profile_img'] != NULL && $responseTopicindexOnevalue['groupId'] == 2){
										        			echo '<img class="Avatar PostUser-avatar" src="'.$responseTopicindexOnevalue['profile_img'].'" />';
										        		}else if ($responseTopicindexOnevalue['groupId'] == 0) {
										        			echo '<img class="Avatar PostUser-avatar" src="images/user/'.$responseTopicindexOnevalue['profile_img'].'" />';
										        		}
										        		?>
					                            		<span class="username"><?php echo $responseTopicindexOnevalue['nickName']; ?></span>
					                            	</a>
					                            </h3>
					                            <ul class="PostUser-badges badges">
					                            	<?php if($responseTopicindexOnevalue['groupId'] == 0){ ?>
					                                <li class="item-group1"><span class="Badge Badge--group--1 " title="Betting time admin" style="background-color: rgb(183, 42, 42);" data-original-title="Admin"><i class="icon fa fa-user Badge-icon"></i><!-- <i class="icon fa fa-wrench Badge-icon"></i> --></span></li>
					                                <?php } ?>
					                            </ul>
					                        </div>
					                    </li>
					                    <li class="dropdown report-flag">
				                    		<a class="btn dropdown-toggle btn-spam" data-toggle="dropdown" href="#">
										      	<i class="fa fa-ellipsis-h text-white" aria-hidden="true"></i>
										    </a>
										    <ul class="dropdown-menu dropdown-menu-right">
										      	<li <?php if($lid == $responseTopicindexOnevalue['createdBy']) echo 'class="disabled"'; ?>><a href="javascript:void(0);" class="spam-check" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">신고하기 <span class="badge"><?php echo $topicsResponseLikeDislike[0]['spamCount']; ?></span></a></li>
										      	<?php
										      	if(((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0) == 1){
										      	?>
										      	<li><a href="<?php echo C::link('edit-forum-sub.php', array('id' => $responseTopicindexOnevalue['id'], 'table' => 'tblForumTopicsResponse'), true);?>" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">수정하기</a></li>
										      	<li><a href="javascript:void(0);" class="delete-post" data-parentid="1" data-id="<?php echo $responseTopicindexOnevalue['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">삭제하기</a></li>
										      	<?php } ?>
										    </ul>
					                    </li>
					                    <li class="item-meta">
					                        <div class="Dropdown PostMeta">
					                            <a class="Dropdown-toggle" data-toggle="dropdown">
					                                <time pubdate="true" title="<?php echo date_format($createdresponseDate, 'm.d.y h:i A');?>" data-humantime="true"><?php echo date_format($createdresponseDate, 'm.d.y');?></time>
					                            </a>
												<?php if($diffone->s > 0) { ?>
					                            <a href="javascript:void(0);" title="Updated on <?php echo date_format($endone, 'm.d.y h:i A');?>"><small>(Edited)</small></a>
												<?php } ?>
					                            <div class="Dropdown-menu dropdown-menu"><span class="PostMeta-number">Post #1</span> <span class="PostMeta-time"><time pubdate="true" datetime="<?php echo date_format($createdresponseDate, 'F j, Y h:i A');?>"><?php echo date_format($createdresponseDate, 'F j, Y h:i A');?></time></span> <span class="PostMeta-ip"></span>
					                                <input class="FormControl PostMeta-permalink">
					                            </div>
					                        </div>
					                    </li>
					                </ul>
					            </header>
					            <div class="Post-body">
					                <?php 
					                echo $responseTopicindexOnevalue['topicResponseDescription']; 
					                if(!$responseTopicindexOnevalue['topicResponseFiles'] == '[]' || !$responseTopicindexOnevalue['topicResponseFiles'] == ''){ //echo 'beal';
					                //echo '<hr>';
					                echo '<ul class="topicFiles-list">';
					                $topicresponseFilesindexone = json_decode($responseTopicindexOnevalue['topicResponseFiles']);
										foreach ($topicresponseFilesindexone as $topicFilesImgindexone) { 
									?>
										<li>
											<a data-fancybox="images" href="<?php echo $topicFilesImgindexone ;?>"><img src="<?php echo $topicFilesImgindexone;?>" class="img-responsive" width="130px" height="90px" alt=""></a>
										</li>
									<?php

										}
									echo '</ul>';
					            	}
					                ?>
					            </div>
					            <aside class="Post-actions">
					                <ul>
					                    <li class="item-reply">
					                        <button class="btn btn-primary btn-xs open-reply-editor" type="button" title="Reply" data-index="2" data-parentid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>"><i class="icon fa fa-reply" style="margin-right: 5px;"></i>댓글달기</button>
					                    </li>
					                    
					                    <li class="item-like">
					                    	<div class="btn-group">
						                        <button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Like" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="1" <?php if($lid == $responseTopicindexOnevalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-up" style="margin-right: 5px;"></i>좋아요</button>

						                        <button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="like" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDislike[0]['like']; ?></span></button>
					                    	</div>
					                    </li>
					                    <li class="item-dislike">
					                    	<div class="btn-group">
					                        	<button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Dislike" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="0" <?php if($lid == $responseTopicindexOnevalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-down" style="margin-right: 5px;"></i>싫어요</button>
					                        	<button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="dislike" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDislike[0]['dislike']; ?></span></button>
					                        </div>
					                    </li>
					                </ul>
					            </aside>
					            <footer class="Post-footer">
					                <ul>
					                    <li class="item-liked">
					                        <div class="Post-likedBy"><i class="icon fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
					                        	<?php if($topicsResponseLikeDislike[0]['like'] > 0){
					                        		
												$likyoneby = $User->query("SELECT `TU`.`nickname` FROM `tblUser` AS `TU`, `tblForumTopicsResponseLikeDislike` AS `TFTLD` WHERE `TFTLD`.`topicUniqueId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' AND `TU`.`id` = `TFTLD`.`createdBy` ORDER BY `TFTLD`.`createdOn` DESC LIMIT 0, 1");
												?>
					                        	<a href="javascript:void(0);"><span class="username"><?php echo $likyoneby[0]['nickname']; ?></span></a>
												<?php if(($topicsResponseLikeDislike[0]['like'] - 1) > 1){?>
					                        	&nbsp;님과&nbsp; <a href="javascript:void(0);" data-parentid="1" data-topicueid="<?php echo $responseTopicindexOnevalue['topicResponseUniqueId']; ?>" data-cat="like"><?php echo ($topicsResponseLikeDislike[0]['like'] - 1); ?> 명이</a>
												<?php } ?>
					                        	 이 글을 좋아합니다.
												<?php } else {
													echo '<span class="when-no-like">해당 글을 처음으로 추천해보세요.</span>';
												}?>
				                        	</div>
					                    </li>
					                    <li class="item-replies">
					                        <div class="Post-mentionedBy"><span class="Post-mentionedBy-summary"><i class="icon fa fa-reply" style="margin-right: 10px;"></i><a href="javascript:void(0);" data-number="3"><span class="username"></span></a> 님께서 댓글을 남기셨습니다. <a class="replies" data-parentid="1" data-id="1" data-child="1" title="View all replies"><i class="icon fa fa-chevron-down" style="margin-right: 5px;"></i>전체 댓글보기 &nbsp;<span class="badge"><?php echo $topicsResponseLikeDislike[0]['commentcount']; ?></span></a></span>
					                            <ul class="Dropdown-menu Post-mentionedBy-preview fade"></ul>
					                        </div>
					                    </li>
					                </ul>
					            </footer>
					        </div>
					    </article>
<!-- child index 2 -->
						<?php
						$responseTopicindexTwo = $User->query("SELECT `TFTR`.`id`, `TFTR`.`topicParentId`, `TFTR`.`topicResponseUniqueId`, `TFTR`.`topicResponseIndex`, `TFTR`.`topicResponseDescription`, `TFTR`.`topicResponseFiles`, `TFTR`.`createdOn`, `TFTR`.`updatedOn`, `TFTR`.`createdBy`, `TU`.`userId`, `TU`.`nickName`, `TU`.`profile_img`, `TU`.`groupId`, `TU`.`createdOn` as `startedOn` FROM `tblForumTopicsResponse` as `TFTR`, `tblUser` as `TU` WHERE `TFTR`.`topicParentId` = '". $responseTopicindexOnevalue['topicResponseUniqueId'] ."' AND `TFTR`.`topicResponseIndex` = '2' AND `TFTR`.`isDispaly` = 'N' AND `TFTR`.`createdBy` = `TU`.`id` ORDER BY `TFTR`.`createdOn`");
						foreach ($responseTopicindexTwo as $responseTopicindexTwokey => $responseTopicindexTwovalue) {
		        		$createdresponsetwoDate   		= date_create($responseTopicindexTwovalue['createdOn']);
    					$endtwo 						= date_create($responseTopicindexOnevalue['updatedOn']);
    					$difftwo  						= date_diff( $createdresponsetwoDate, $endtwo );
		        		$topicsResponseLikeDisliketwo 	= $User->query("SELECT 
							                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' AND `status` = 'Y' ) AS `like`, 
							                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' AND `status` = 'N' ) AS `dislike`,
					                    			( SELECT COUNT( * ) FROM `tblForumTopicsResponse` WHERE `topicParentId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' ) AS `commentcount`,
					                    			( SELECT COUNT( * ) FROM `tblForumTopicsResponseSpam` WHERE `topicUniqueId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' ) AS `spamCount`");
						?>
					    <div class="replies-Container post-comment-1-1">
					    	<div class="" data-index="<?php echo $responseTopicindexTwovalue['topicResponseIndex']; ?>" data-time="<?php echo date_format($createdresponsetwoDate, DATE_COOKIE);?>" data-number="<?php echo $responseTopicindexTwovalue['id']; ?>" data-id="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-type="comment" style="display: block;">
					    		<article class="Post undefined ReplyPost">
							        <div>
							            <header class="Post-header">
							                <ul>
							                    <li class="item-user">
							                        <div class="PostUser">
							                            <h3>
							                            	<a href="javascript:void(0);">
							                            		<?php
												        		if($responseTopicindexTwovalue['profile_img'] == NULL && $responseTopicindexTwovalue['groupId'] == 4){
												        			echo '<img class="Avatar PostUser-avatar" src="images/user/user8.png" />';
												        		}else if($responseTopicindexTwovalue['profile_img'] == NULL && $responseTopicindexTwovalue['groupId'] == 2){
												        			echo '<img class="Avatar PostUser-avatar" src="images/user/user10.png" />';
												        		}else if($responseTopicindexTwovalue['profile_img'] != NULL && $responseTopicindexTwovalue['groupId'] == 2){
												        			echo '<img class="Avatar PostUser-avatar" src="'.$responseTopicindexTwovalue['profile_img'].'" />';
												        		}else if ($responseTopicindexTwovalue['groupId'] == 0) {
												        			echo '<img class="Avatar PostUser-avatar" src="images/user/'.$responseTopicindexTwovalue['profile_img'].'" />';
												        		}
												        		?>
							                            		<span class="username"><?php echo $responseTopicindexTwovalue['nickName']; ?></span>
							                            	</a>
							                            </h3>
							                            <ul class="PostUser-badges badges">
							                            	<?php if($responseTopicindexTwovalue['groupId'] == 0){ ?>
							                                <li class="item-group1"><span class="Badge Badge--group--1 " title="Betting time admin" style="background-color: rgb(183, 42, 42);margin-left: 6px;" data-original-title="Admin"><i class="icon fa fa-user Badge-icon"></i><!-- <i class="icon fa fa-wrench Badge-icon"></i> --></span></li>
							                                <?php } ?>
							                            </ul>
							                        </div>
							                    </li>
							                    <li class="dropdown report-flag">
						                    		<a class="btn dropdown-toggle btn-spam" data-toggle="dropdown" href="#">
												      	<i class="fa fa-ellipsis-h text-white" aria-hidden="true"></i>
												    </a>
												    <ul class="dropdown-menu dropdown-menu-right">
												      	<li <?php if($lid == $responseTopicindexTwovalue['createdBy']) echo 'class="disabled"'; ?>><a href="javascript:void(0);" class="spam-check" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">신고하기 <span class="badge"><?php echo $topicsResponseLikeDisliketwo[0]['spamCount']; ?></span></a></li>
												      	<?php
												      	if(((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0) == 1){
												      	?>
												      	<li><a href="<?php echo C::link('edit-forum-sub.php', array('id' => $responseTopicindexTwovalue['id'], 'table' => 'tblForumTopicsResponse'), true);?>" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">수정하기</a></li>
												      	<li><a href="javascript:void(0);" class="delete-post" data-parentid="1" data-id="<?php echo $responseTopicindexTwovalue['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">삭제하기</a></li>
												      	<?php } ?>
												    </ul>
							                    </li>
							                    <li class="item-meta">
							                        <div class="Dropdown PostMeta">
							                            <a class="Dropdown-toggle" data-toggle="dropdown">
							                                <time pubdate="true" title="<?php echo date_format($createdresponsetwoDate, 'm.d.y h:i A');?>" data-humantime="true"><?php echo date_format($createdresponsetwoDate, 'm.d.y');?></time>
							                            </a>
							                            <?php if($difftwo->s > 0) { ?>
							                            <a href="javascript:void(0);" title="Updated on <?php echo date_format($endtwo, 'm.d.y h:i A');?>"><small>(수정됨)</small></a>
														<?php } ?>
							                            <div class="Dropdown-menu dropdown-menu"><span class="PostMeta-number">Post #1</span> <span class="PostMeta-time"><time pubdate="true" datetime="<?php echo date_format($createdresponsetwoDate, 'm.d.y h:i A');?>"><?php echo date_format($createdresponsetwoDate, 'm.d.y h:i A');?></time></span> <span class="PostMeta-ip"></span>
							                                <input class="FormControl PostMeta-permalink">
							                            </div>
							                        </div>
						                    	</li>
						                	</ul>
						            	</header>
							            <div class="Post-body">
							                <?php 
							                echo $responseTopicindexTwovalue['topicResponseDescription']; 
							                if(!$responseTopicindexTwovalue['topicResponseFiles'] == '[]' || !$responseTopicindexTwovalue['topicResponseFiles'] == ''){ //echo 'beal';
							                //echo '<hr>';
							                echo '<ul class="topicFiles-list">';
							                $topicresponseFilesindextwo = json_decode($responseTopicindexTwovalue['topicResponseFiles']);
												foreach ($topicresponseFilesindextwo as $topicFilesImgindextwo) { 
											?>
												<li>
													<a data-fancybox="images" href="<?php echo $topicFilesImgindextwo ;?>"><img src="<?php echo $topicFilesImgindextwo;?>" class="img-responsive" width="130px" height="90px" alt=""></a>
												</li>
											<?php

												}
											echo '</ul>';
							            	}
							                ?>
							            </div>
							            <aside class="Post-actions">
							                <ul>
							                    <li class="item-reply">
							                        <button class="btn btn-primary btn-xs open-reply-editor" type="button" title="Reply" data-index="3" data-parentid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>"><i class="icon fa fa-reply" style="margin-right: 5px;"></i>댓글달기</button>
							                    </li>
							                    
							                    <li class="item-like">
							                    	<div class="btn-group">
								                        <button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Like" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="1" <?php if($lid == $responseTopicindexTwovalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-up" style="margin-right: 5px;"></i>좋아요</button>

								                        <button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="like" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDisliketwo[0]['like']; ?></span></button>
							                    	</div>
							                    </li>
							                    <li class="item-dislike">
							                    	<div class="btn-group">
							                        	<button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Dislike" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="0" <?php if($lid == $responseTopicindexTwovalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-down" style="margin-right: 5px;"></i>싫어요</button>
							                        	<button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="dislike" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDisliketwo[0]['dislike']; ?></span></button>
							                        </div>
							                    </li>
							                </ul>
							            </aside>
							            <footer class="Post-footer">
							                <ul>
							                    <li class="item-liked">
							                        <div class="Post-likedBy"><i class="icon fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
							                        	<?php if($topicsResponseLikeDisliketwo[0]['like'] > 0){
					                        		
														$likytwoby = $User->query("SELECT `TU`.`nickname` FROM `tblUser` AS `TU`, `tblForumTopicsResponseLikeDislike` AS `TFTLD` WHERE `TFTLD`.`topicUniqueId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' AND `TU`.`id` = `TFTLD`.`createdBy` ORDER BY `TFTLD`.`createdOn` DESC LIMIT 0, 1");
														?>
							                        	<a href="javascript:void(0);"><span class="username"><?php echo $likytwoby[0]['nickname']; ?></span></a>
														<?php if(($topicsResponseLikeDisliketwo[0]['like'] - 1) > 1){?>
							                        	&nbsp;님과&nbsp; <a href="javascript:void(0);" data-parentid="1" data-topicueid="<?php echo $responseTopicindexTwovalue['topicResponseUniqueId']; ?>" data-cat="like"><?php echo ($topicsResponseLikeDisliketwo[0]['like'] - 1); ?> 명이</a>
														<?php } ?>
							                        	 이 글을 좋아합니다.
														<?php } else {
															echo '<span class="when-no-like">해당 글을 처음으로 추천해보세요.</span>';
														}?>
						                        	</div>
							                    </li>
							                    <li class="item-replies">
							                        <div class="Post-mentionedBy"><span class="Post-mentionedBy-summary"><i class="icon fa fa-reply" style="margin-right: 10px;"></i><a href="javascript:void(0);" data-number="3"><span class="username"></span></a> 님께서 댓글을 남겨주셨습니다. <a class="replies" data-parentid="1" data-id="1" data-child="2" title="View all replies"><i class="icon fa fa-chevron-down" style="margin-right: 5px;"></i>전체 댓글보기 &nbsp;<span class="badge"><?php echo $topicsResponseLikeDisliketwo[0]['commentcount']; ?></span></a></span>
							                            <ul class="Dropdown-menu Post-mentionedBy-preview fade"></ul>
							                        </div>
							                    </li>
							                </ul>
							            </footer>
							        </div>
							    </article>
<!-- child index 3 -->
								<?php
								$responseTopicindexThree = $User->query("SELECT `TFTR`.`id`, `TFTR`.`topicParentId`, `TFTR`.`topicResponseUniqueId`, `TFTR`.`topicResponseIndex`, `TFTR`.`topicResponseDescription`, `TFTR`.`topicResponseFiles`, `TFTR`.`createdOn`, `TFTR`.`updatedOn`, `TFTR`.`createdBy`, `TU`.`userId`, `TU`.`nickName`, `TU`.`profile_img`, `TU`.`groupId`, `TU`.`createdOn` as `startedOn` FROM `tblForumTopicsResponse` as `TFTR`, `tblUser` as `TU` WHERE `TFTR`.`topicParentId` = '". $responseTopicindexTwovalue['topicResponseUniqueId'] ."' AND `TFTR`.`topicResponseIndex` = '3' AND `TFTR`.`isDispaly` = 'N' AND `TFTR`.`createdBy` = `TU`.`id` ORDER BY `TFTR`.`createdOn`");
								foreach ($responseTopicindexThree as $responseTopicindexThreekey => $responseTopicindexThreevalue) {
				        		$createdresponsethreeDate   	= date_create($responseTopicindexThreevalue['createdOn']);
				        		$endthree 						= date_create($responseTopicindexOnevalue['updatedOn']);
    							$diffthree  					= date_diff( $createdresponsetwoDate, $endtwo );
				        		$topicsResponseLikeDislikethree = $User->query("SELECT 
									                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexThreevalue['topicResponseUniqueId'] ."' AND `status` = 'Y' ) AS `like`, 
									                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponseLikeDislike` WHERE `topicUniqueId` = '". $responseTopicindexThreevalue['topicResponseUniqueId'] ."' AND `status` = 'N' ) AS `dislike`,
					                    					( SELECT COUNT( * ) FROM `tblForumTopicsResponse` WHERE `topicParentId` = '". $responseTopicindexThreevalue['topicResponseUniqueId'] ."' ) AS `commentcount`,
					                    					( SELECT COUNT( * ) FROM `tblForumTopicsResponseSpam` WHERE `topicUniqueId` = '". $responseTopicindexThreevalue['topicResponseUniqueId'] ."' ) AS `spamCount`");
								?>
							    <div class="replies-replies-Container post-comment-comment-1-1">

							    	<div class="" data-index="<?php echo $responseTopicindexThreevalue['topicResponseIndex']; ?>" data-time="<?php echo date_format($createdresponsethreeDate, DATE_COOKIE);?>" data-number="<?php echo $responseTopicindexThreevalue['id']; ?>" data-id="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-type="comment" style="display: block;">
								    	<article class="Post undefined ReplyReplyPost">
									        <div>
									            <header class="Post-header">
									                <ul>
									                    <li class="item-user">
									                        <div class="PostUser">
									                            <h3>
									                            	<a href="javascript:void(0);">
									                            		<?php
														        		if($responseTopicindexThreevalue['profile_img'] == NULL && $responseTopicindexThreevalue['groupId'] == 4){
														        			echo '<img class="Avatar PostUser-avatar" src="images/user/user8.png" />';
														        		}else if($responseTopicindexThreevalue['profile_img'] == NULL && $responseTopicindexThreevalue['groupId'] == 2){
														        			echo '<img class="Avatar PostUser-avatar" src="images/user/user10.png" />';
														        		}else if($responseTopicindexThreevalue['profile_img'] != NULL && $responseTopicindexThreevalue['groupId'] == 2){
														        			echo '<img class="Avatar PostUser-avatar" src="'.$responseTopicindexThreevalue['profile_img'].'" />';
														        		}else if ($responseTopicindexThreevalue['groupId'] == 0) {
														        			echo '<img class="Avatar PostUser-avatar" src="images/user/'.$responseTopicindexThreevalue['profile_img'].'" />';
														        		}
														        		?>
									                            		<span class="username"><?php echo $responseTopicindexThreevalue['nickName']; ?></span>
									                            	</a>
									                            </h3>
									                            <ul class="PostUser-badges badges">
									                            	<?php if($responseTopicindexThreevalue['groupId'] == 0){ ?>
									                                <li class="item-group1"><span class="Badge Badge--group--1 " title="Betting time admin" style="background-color: rgb(183, 42, 42);margin-left: 6px;" data-original-title="Admin"><i class="icon fa fa-user Badge-icon"></i><!-- <i class="icon fa fa-wrench Badge-icon"></i> --></span></li>
									                                <?php } ?>
									                            </ul>
									                        </div>
									                    </li>
									                    <li class="dropdown report-flag">
								                    		<a class="btn dropdown-toggle btn-spam" data-toggle="dropdown" href="#">
														      	<i class="fa fa-ellipsis-h text-white" aria-hidden="true"></i>
														    </a>
														    <ul class="dropdown-menu dropdown-menu-right">
														      	<li <?php if($lid == $responseTopicindexThreevalue['createdBy']) echo 'class="disabled"'; ?>><a href="javascript:void(0);" class="spam-check" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">신고하기 <span class="badge"><?php echo $topicsResponseLikeDislikethree[0]['spamCount']; ?></span></a></li>
														      	<?php
														      	if(((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0) == 1){
														      	?>
														      	<li><a href="<?php echo C::link('edit-forum-sub.php', array('id' => $responseTopicindexThreevalue['id'], 'table' => 'tblForumTopicsResponse'), true);?>" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">수정하기</a></li>
														      	<li><a href="javascript:void(0);" class="delete-post" data-parentid="1" data-id="<?php echo $responseTopicindexThreevalue['id']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">삭제하기</a></li>
														      	<?php } ?>
														    </ul>
									                    </li>
									                    <li class="item-meta">
									                        <div class="Dropdown PostMeta">
									                            <a class="Dropdown-toggle" data-toggle="dropdown">
									                                <time pubdate="true" title="<?php echo date_format($createdresponsethreeDate, 'm.d.y h:i A');?>" data-humantime="true"><?php echo date_format($createdresponsethreeDate, 'm.d.y');?></time>
									                            </a>
									                            <?php if($diffthree->s > 0) { ?>
									                            <a href="javascript:void(0);" title="Updated on <?php echo date_format($endthree, 'm.d.y h:i A');?>"><small>(수정됨)</small></a>
																<?php } ?>
									                            <div class="Dropdown-menu dropdown-menu"><span class="PostMeta-number">Post #1</span> <span class="PostMeta-time"><time pubdate="true" datetime="<?php echo date_format($createdresponsethreeDate, 'm.d.y h:i A');?>"><?php echo date_format($createdresponsethreeDate, 'm.d.y h:i A');?></time></span> <span class="PostMeta-ip"></span>
									                                <input class="FormControl PostMeta-permalink">
									                            </div>
									                        </div>
								                    	</li>
								                	</ul>
								            	</header>
									            <div class="Post-body">
									                <?php 
									                echo $responseTopicindexThreevalue['topicResponseDescription']; 
									                if(!$responseTopicindexThreevalue['topicResponseFiles'] == '[]' || !$responseTopicindexThreevalue['topicResponseFiles'] == ''){ //echo 'beal';
									                //echo '<hr>';
									                echo '<ul class="topicFiles-list">';
									                $topicresponseFilesindexthree = json_decode($responseTopicindexThreevalue['topicResponseFiles']);
														foreach ($topicresponseFilesindexthree as $topicFilesImgindexthree) { 
													?>
														<li>
															<a data-fancybox="images" href="<?php echo $topicFilesImgindexthree ;?>"><img src="<?php echo $topicFilesImgindexthree;?>" class="img-responsive" width="130px" height="90px" alt=""></a>
														</li>
													<?php

														}
													echo '</ul>';
									            	}
									                ?>
									            </div>
									            <aside class="Post-actions">
									                <ul>
									                    <li class="item-reply">
									                        <button class="btn btn-primary btn-xs open-reply-editor" type="button" title="Reply" data-index="4" data-parentid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>"><i class="icon fa fa-reply" style="margin-right: 5px;"></i>댓글달기</button>
									                    </li>
									                    
									                    <li class="item-like">
									                    	<div class="btn-group">
										                        <button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Like" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="1" <?php if($lid == $responseTopicindexThreevalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-up" style="margin-right: 5px;"></i>좋아요</button>

										                        <button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="like" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDislikethree[0]['like']; ?></span></button>
									                    	</div>
									                    </li>
									                    <li class="item-dislike">
									                    	<div class="btn-group">
									                        	<button class="btn btn-danger btn-xs likedislikeclick" type="button" title="I Dislike" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-enabled="<?php echo $uid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" data-state="0" <?php if($lid == $responseTopicindexThreevalue['createdBy']) echo 'disabled'; ?>><i class="icon fa fa-thumbs-o-down" style="margin-right: 5px;"></i>싫어요</button>
									                        	<button class="btn btn-danger btn-xs like-dislike-count" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-likedislikeid="2" type="button" data-cat="dislike" data-toggle="modal" data-target="#likeDislikeModal"><span class="badge"><?php echo $topicsResponseLikeDislikethree[0]['dislike']; ?></span></button>
									                        </div>
									                    </li>
									                </ul>
									            </aside>
									            <footer class="Post-footer">
									                <ul>
									                    <li class="item-liked">
									                        <div class="Post-likedBy"><i class="icon fa fa-thumbs-o-up" style="margin-right: 10px;"></i>
									                        	<?php if($topicsResponseLikeDislikethree[0]['like'] > 0){
					                        		
																$likythreeby = $User->query("SELECT `TU`.`nickname` FROM `tblUser` AS `TU`, `tblForumTopicsResponseLikeDislike` AS `TFTLD` WHERE `TFTLD`.`topicUniqueId` = '". $responseTopicindexThreevalue['topicResponseUniqueId'] ."' AND `TU`.`id` = `TFTLD`.`createdBy` ORDER BY `TFTLD`.`createdOn` DESC LIMIT 0, 1");
																?>
									                        	<a href="javascript:void(0);"><span class="username"><?php echo $likythreeby[0]['nickname']; ?></span></a>
																<?php if(($topicsResponseLikeDislikethree[0]['like'] - 1) > 1){?>
									                        	&nbsp;님과&nbsp; <a href="javascipt:void(0);" data-parentid="1" data-topicueid="<?php echo $responseTopicindexThreevalue['topicResponseUniqueId']; ?>" data-cat="like"><?php echo ($topicsResponseLikeDislikethree[0]['like'] - 1); ?> 명이</a>
																<?php } ?>
									                        	 이 글을 좋아합니다.
																<?php } else {
																	echo '<span class="when-no-like">해당 글을 처음으로 추천해보세요.</span>';
																}?>
								                        	</div>
									                    </li>
									                    <li class="item-replies">
									                        <div class="Post-mentionedBy"><span class="Post-mentionedBy-summary"><i class="icon fa fa-reply" style="margin-right: 10px;"></i><a href="javascript:void(0);" data-number="3"><span class="username"></span></a> 님께서 댓글을 남겨주셨습니다. <a class="replies" data-parentid="1" data-id="1" data-child="3" title="View all replies"><i class="icon fa fa-chevron-down" style="margin-right: 5px;"></i>전체 댓글보기 &nbsp;<span class="badge"><?php echo $topicsResponseLikeDislikethree[0]['commentcount']; ?></span></a></span>
									                            <ul class="Dropdown-menu Post-mentionedBy-preview fade"></ul>
									                        </div>
									                    </li>
									                </ul>
									            </footer>
									        </div>
									    </article>
								    </div>
							    </div>
							    <?php 
								}
								?>
						    </div>
					    </div>
						<?php 
						}
						?>
					    <div class="Post-quoteButtonContainer"></div>
					</div>
					<?php 
					}
					?>
				</div>
				<!-- textarea starts here -->
				<div class="text-area-container-parent">
					<div class="text-area-container">
						<button type="button" class="btn btn-primary btn-xs btn-del-img" id="removeEditorContainer"><i class="fa fa-times" aria-hidden="true"></i></button>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="top-toolbar-forum" id="toolbar" style="display: none;">
								<ul>
									<li><a data-wysihtml5-command="bold" class="btn btn-xs text-white btn-tools" title="CTRL+B"><i class="fa fa-bold" aria-hidden="true"></i></a></li>
									<li><a data-wysihtml5-command="italic" class="btn btn-xs text-white btn-tools" title="CTRL+I"><i class="fa fa-italic" aria-hidden="true"></i></a></li>
									<li><a data-wysihtml5-command="createLink" class="btn text-white btn-xs btn-tools"><i class="fa fa-link" aria-hidden="true"></i></a></li>
									<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" class="btn btn-xs btn-tools text-white"><b>H1</b></a></li>
									<li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" class="btn btn-xs btn-tools text-white"><b>H2</b></a></li>
									<li><a data-wysihtml5-command="insertUnorderedList" class="btn btn-xs text-white btn-tools"><i class="fa fa-list" aria-hidden="true"></i></a></li>
									<li><a data-wysihtml5-command="insertOrderedList" class="btn btn-xs text-white btn-tools"><i class="fa fa-list-ol" aria-hidden="true"></i></a></li>
								</ul>
								<div data-wysihtml5-dialog="createLink" style="display: none;">
									<label>
									<span class="text-white">링크:</span>
									<input data-wysihtml5-dialog-field="href" value="http://" style="height:22px;">
									</label>
									<a data-wysihtml5-dialog-action="save" class="btn btn-danger btn-xs">확인</a>&nbsp;<a data-wysihtml5-dialog-action="cancel" class="btn btn-info btn-xs">취소</a>
								</div>
							</div>
					    	<textarea name="topicResponseDescription" class="forum-editor" id="min-text" rows="15" style="" required></textarea>
					    	<input type="hidden" name="topicParentId" id="topicParentId" value="" />
					    	<input type="hidden" name="topicResponseIndex" id="topicResponseIndex" value="" />
					    	<input type="hidden" name="__formname__" value="POSTTOPICSFORUM" />
					    	<div class="forum-image-container">
					    		<ul></ul>
					    	</div>
					    	<!-- <div class="bottom-toolbar-forum">
					    		<ul>
					    			<li class=""><input type="file" name="topicResponseFiles[]" id="topicFiles" style="padding-top: 8px;" multiple ></li>
					    			<li class="pull-right"><button type="submit" class="btn btn-success btn-submit-post">POST</button></li>
					    		</ul>
					    	</div> -->
					    	<div class="bottom-toolbar-forum" style="overflow:hidden;">
					    		<ul class="forum-details-image-uploadlist">
					    			<li>
										<label class="fileContainer">
										    <i class="fa fa-picture-o" aria-hidden="true"></i>
										    <input type="file" name="topicResponseFiles[]" id="topicFiles" />
										</label>
					    			</li>
					    			<li class="pull-right"><button type="submit" class="btn btn-success btn-submit-post">작성하기</button></li>
					    			<li class="pull-right" style=" margin-right: 16px;margin-top: 10px;"><button type="button" class="btn btn-default btn-xs btn-details-remove-image" title="Remove Image">이미지 삭제하기</button></li>
					    			<li class="pull-right" style=" margin-right: 5px;margin-top: 10px;"><button type="button" class="btn btn-default btn-xs btn-details-add-image" title="Add image">이미지 추가하기</button></li>
					    		</ul>
					    	</div>
				    	</form>
				    </div>
				</div>
				<!-- textarea ends here -->	
			</div>
			
		</div><!-- col-lg-9 col-md-9 -->

		<div class="col-lg-3 col-md-3">
			<?php require_once('includes/sportsRecommend.php'); ?>
		</div><!-- col-lg-3 col-md-3 -->
	</div>
</div>
</div>

<div class="modal fade" id="likeDislikeModal" role="dialog">
    <div class="modal-dialog modal-sm">
      	<div class="modal-content">
	        <div class="modal-header">
	          	<button type="button" class="close clear-ldbody" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title"></h4>
	        </div>
	        <div class="modal-body likeDISLIKEbODY" style="height:380px;overflow-y:scroll;">
	          	<img src="images/loading.gif" alt="" class="img-responsive">
	          	<img src="images/loading.gif" alt="" class="img-responsive">
	          	<img src="images/loading.gif" alt="" class="img-responsive">
	        </div>
	        <div class="modal-footer">
	          	<button type="button" class="btn btn-default clear-ldbody" data-dismiss="modal">닫기</button>
	        </div>
      	</div>
    </div>
</div>


<?php require_once('includes/doc_footer.php'); ?>