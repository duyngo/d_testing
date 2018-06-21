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


if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && $_POST['__formname__'] == 'POSTTOPICS'){
	//print_r($_POST);
    if($Forum->addForumtopic($_POST, $_FILES)){
    	C::redirect(C::link('forum.php', false, true));
    }	
}
$lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$gid = ((int)User::groupId($lid) > 0 ? User::groupId($lid) : 0);

?>

<?php 
require_once('includes/doc_head.php');
?>
<style>
.forum-editor{
	width:100%;
	height:400px;
	color:#fff;
	background-color: #012D50;
	border:2px solid #fff;
	padding-top: 100px;
	padding-bottom: 140px;
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
		<div class="col-lg-9 col-md-9 forum-list-container">
			<div class="cat-container">
				<div class="all-cat discussion">
				    <a href="forum.php" class="btn" data-category="discussion">전체보기</a>
				</div>
				<div class="all-cat best-post">
				    <a href="best-post.php" class="btn" data-category="best-post">베스트</a>
				</div>
				<div class="all-cat collect-news">
				    <a href="collect-news.php" class="btn" data-category="collect-news">먹튀사이트 취재</a>
				</div>
				<?php 
				if($lid > 0 && $gid == 2 || $gid == 4){
				}else{
				?>
				<div class="all-cat level-up">
				    <a href="javascript:void(0);" class="btn" data-category="level-up" data-check="<?php echo $lid; ?>">등업 신청</a>
				</div>
				<?php
				}
				?>
				<div class="all-cat start-discussion">
				    <a href="javascript:void(0);" class="btn" data-category="start-discussion" data-check="<?php echo $lid; ?>" data-gid="<?php echo $gid; ?>"><i class="fa fa-long-arrow-left fa-3x arrow1" aria-hidden="true"></i>작성하기</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="owl-carousel-tags tag-container">
				<div class="item">
					<a href="forum.php" class="btn" data-category=""><i class="fa fa-square" style="color:#fff;"></i> All </a>
				</div>
				<?php 
				$result = $User->query("SELECT `id`, `tagTitle`, `tagColor`, `tagDescription`, `createdOn` FROM `tblTags`");
				foreach ($result as $tagKey => $tagValue) {
				?>
				<div class="item">
				    <a href="<?php echo C::link('forum.php', array('tag' => $tagValue['tagTitle']), true);?>" class="btn" data-category=""><i class="fa fa-square" style="color:<?php echo $tagValue['tagColor'];?>;"></i> <?php echo $tagValue['tagTitle'];?></a>
				</div>
				<?php
				}
				?>
			</div>
			<div class="clearfix"></div>
			<div class="betting-forum-list">
				<div class="forum-lists">
					<ul>
						<?php
						//tag filter
						$filtertag = (isset($_GET['tag']) ? "AND `TFT`.`topicTags` LIKE '%". $_GET['tag'] ."%'" : " "); 
						//pagination
						$pagination = '';
						$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
						$limit = 10;
						$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
						$counter= 0;
						# [Pagination] instantiate; Set current page; set number of records
						

						$resultopic = $User->query("SELECT SQL_CALC_FOUND_ROWS `TFT`.`id`, `TFT`.`topicUniqueId`, `TFT`.`topicTitle`, `TFT`.`topicTags`, `TFT`.`createdOn`, `TFT`.`isSticky`, `TU`.`userId`, `TU`.`nickName`, `TU`.`profile_img`, `TU`.`groupId`, `TU`.`createdOn` as `startedOn` FROM `tblForumTopics` as `TFT`, `tblUser` as `TU` WHERE `TFT`.`createdBy` = '1' AND `TFT`.`isDispaly` = 'N' AND `TFT`.`isVerified` = 'N' ". $filtertag . " AND `TFT`.`createdBy` = `TU`.`id` ORDER BY `TFT`.`isSticky` ASC,  `TFT`.`createdOn` DESC" . $pullSQL);

						
						if(is_array($resultopic) && count($resultopic) > 0){

						foreach ($resultopic as $topicKey => $topicValue) {
            				$startedDate   	= date_create($topicValue['startedOn']);
            				$createdDate   	= date_create($topicValue['createdOn']);
            				$end 			= date_create(SESSION_START_TIME);
            				$diff  			= date_diff( $createdDate, $end );

				            // count
				            $topicValueLikeDislike = $User->query("SELECT 
			                    	( SELECT COUNT( * ) FROM `tblForumTopicsLikeDislike` WHERE `topicUniqueId` = '". $topicValue['topicUniqueId'] ."' AND `status` = 'Y' ) AS `like`, 
			                    	( SELECT COUNT( * ) FROM `tblForumTopicsLikeDislike` WHERE `topicUniqueId` = '". $topicValue['topicUniqueId'] ."' AND `status` = 'N' ) AS `dislike`,
			                    	( SELECT COUNT( * ) FROM `tblForumTopicsResponse` WHERE `topicParentId` = '". $topicValue['topicUniqueId'] ."' ) AS `commentcount`");
						?>
						<li data-id="<?php echo $topicValue['topicUniqueId'];?>">
						    <div class="DiscussionListItem Slidable">
						        <div class="DiscussionListItem-content Slidable-content">
						        	<a href="javascript:void(0);" class="DiscussionListItem-author" title="" data-original-title="Toby started <?php echo $topicValue['startedOn']; ?>">
						        		<?php
						        		if($topicValue['profile_img'] == NULL && $topicValue['groupId'] == 4 || $topicValue['groupId'] == 3){
						        			echo '<img class="Avatar " src="images/user/user8.png" />';
						        		}else if($topicValue['profile_img'] == NULL && $topicValue['groupId'] == 2){
						        			echo '<img class="Avatar " src="images/user/user10.png" />';
						        		}else if($topicValue['profile_img'] != NULL && $topicValue['groupId'] == 2){
						        			echo '<img class="Avatar " src="'.$topicValue['profile_img'].'" />';
						        		}else if ($topicValue['groupId'] == 0) {
						        			echo '<img class="Avatar " src="images/user/'.$topicValue['profile_img'].'" />';
						        		}
						        		?>
						        	</a>
						            <ul class="DiscussionListItem-badges badges">
						                <li class="item-sticky">
						                	<?php if($topicValue['groupId'] == 0){ ?>
						                	<span class="Badge Badge--sticky " title="" data-original-title="Sticky">
						                		<i class="icon fa fa-user Badge-icon" title="Betting time admin"></i>
						                	</span>
						                	<?php } ?>
						                </li>
						                <li class="item-sticky">
						                	<?php if($topicValue['isSticky'] == 'Y'){ ?>
						                	<span class="Badge Badge--sticky " title="" data-original-title="Sticky">
						                		<i class="icon fa fa-thumb-tack Badge-icon" title="This discussion sticked in board"></i>
						                	</span>
						                	<?php } ?>
						                </li>
						            </ul>
						            <a href="<?php echo C::link('details-forum.php', array('id' => $topicValue['topicUniqueId'], 'title' => htmlspecialchars($topicValue['topicTitle'])), true);?>" class="DiscussionListItem-main">
						            	<h3 class="DiscussionListItem-title"
										<?php if ($topicValueLikeDislike[0]['like'] > 50)
										echo 'style="color:#f5f406;"';
										?>
						            	>
						            		<?php echo $topicValue['topicTitle']; ?>
						            	</h3><!-- style="color:#f5f406;"-->
						            	<ul class="DiscussionListItem-info">
							            	<li class="item-terminalPost">
							            		<span>
							            			<i class="icon fa fa-reply "></i> 
							            			<span class="username"><?php echo $topicValue['nickName']; ?></span> |  
						            				<time pubdate="true" datetime="<?php echo $topicValue['createdOn']; ?>" title="<?php echo date_format($createdDate, DATE_COOKIE);?>" data-humantime="true">
														<?php
														if($diff->y > 0){
															echo 'posted '. $diff->y. ' years ago';
														}else if($diff->m > 0){
															echo 'posted '. $diff->m. ' months ago';
														}else if($diff->d > 0){
						            						echo 'posted '. $diff->d. ' days ago';
														}else if($diff->h > 0){
						            						echo 'posted '. $diff->h. ' hours ago';
														}else if($diff->i > 0){
						            						echo 'posted '. $diff->i. ' minutes ago';
														}else{
															echo 'posted '. $diff->s. ' seconds ago';
														}
														?>
						            				</time>
						            			</span>
						            		</li>
						            		<li class="item-tags"><span class="TagsLabel ">
												<?php 
												$tagswithcolor	= json_decode($topicValue['topicTags']);
												foreach ($tagswithcolor as $topictagscolorkey => $topictagscolorvalue) {
													$tgcolorname = explode('@@', $topictagscolorvalue);
												?>
						            			<span class="TagLabel colored" style="color:#fff; background-color:<?php echo $tgcolorname[0]; ?>;">
						            				<span class="TagLabel-text"><?php echo $tgcolorname[1]; ?></span>
						            			</span>
												<?php
												}
												?>
							            	</li>
						            		<!-- <li class="item-excerpt">현재 문제가 되고 있는 부분들을 수정하고 있습니다. 일부 기능은 개선이 필요하여 새롭게 제작하고 있으며, 유저 분들이 활동할 수 있는 영역을 우선으로 진행하고 있습니다. 배팅사이트를 추천해달라는 문의가 많아서 말씀드립니다...
						            		</li> -->
						            	</ul>
						            </a>
						            <ul class="forum-comment-rate">
						            	<li><i class="fa fa-comment-o" aria-hidden="true"> <?php echo $topicValueLikeDislike[0]['commentcount'];?></i></li>
						            	<li><i class="fa fa-thumbs-o-up" aria-hidden="true"> <?php echo $topicValueLikeDislike[0]['like'];?></i></li>
						            	<li><i class="fa fa-thumbs-o-down" aria-hidden="true"> <?php echo $topicValueLikeDislike[0]['dislike'];?></i></li>
						        	</ul>
						        </div>
						    </div>
						</li>
						<?php
						$counter++;
							}
						}
						if(is_array($resultopic) && count($resultopic) > 0){
							echo '';
						}else {
						?>
						<li>
							<div class="DiscussionListItem Slidable">
								<p style="padding:10px;">Nothing has been posted yet!!</p>
							</div>
						</li>
						<?php
						}
						?>

					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="" style="margin:10px 0px;">
				
				<?php
				$sql = $User->query("SELECT COUNT( * ) AS CNT FROM `tblforumtopics`");
				$total_records = $sql[0]['CNT'];
				$total_pages = ceil($total_records / $limit);
				if(!isset($_GET['search'])){
					if (!isset($_GET['tag'])) {
						if(count($resultopic) >= $limit){
					?>
					<ul class="clearfix pagination pagination ask-pagination pull-left" style="margin-top: 0px;">
					    <li class=""><a href="collect-news.php?__pGI=1">« First</a></li>
						<?php 
						for ($i=1; $i<=$total_pages; $i++) {
					    echo '<li class="number '.$ac = (($page == $i) ? 'active disabled' : '') .'"><a data-pagenumber="'.$i.'" href="forum.php?__pGI='.$i.'">'.$i.'</a></li>';
						} ?>
					    <li class="copy next"><a href="collect-news.php?__pGI=<?php echo $total_pages; ?>">Last »</a></li>
					</ul>
				<?php 
						}
					} 
				}
				?>
				<form class="navbar-form navbar-left" method="GET" action="" style="margin-top: 0px;">
			      	<div class="form-group">
			        	<input type="text" class="form-control" name="search" placeholder="Search">
		      		</div>
			      	<button type="submit" class="btn btn-topic-search">Search</button>
			    </form>
				<div class="all-cat start-discussion" style="float:right;">
				    <a href="javascript:void(0);" class="btn" data-category="start-discussion" data-check="<?php echo $lid = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>">작성하기</a>
				</div>
			</div>



			<!-- textarea starts here -->
				<div class="text-area-container-parent-list">
					<div class="text-area-container">
						<button type="button" class="btn btn-primary btn-xs btn-del-img" id="removeEditorContainerlist"><i class="fa fa-times" aria-hidden="true"></i></button>
						<form action="" method="POST" id="postTopic" enctype="multipart/form-data">
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
									<span class="text-white">Link:</span>
									<input data-wysihtml5-dialog-field="href" value="http://" style="height:22px;">
									</label>
									<a data-wysihtml5-dialog-action="save" class="btn btn-danger btn-xs">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel" class="btn btn-info btn-xs">CANCEL</a>
								</div>
							</div>
							<div class="other-informations">
								<select name="topicTags[]" id="" class="select-tag" required >
									<option value="">Choose Tag</option>
									<?php 
									$result = $User->query("SELECT `tagTitle`, `tagColor` FROM `tblTags`");
									foreach ($result as $tagKey => $tagValue) {
									?>
									<option value="<?php echo $tagValue['tagColor']. '@@' .$tagValue['tagTitle'];?>"><?php echo $tagValue['tagTitle'];?></option>
									<?php
									}
									?>
								</select>
								<input type="text" name="topicTitle" class="input-title" placeholder="Discussion Title">
								<input type="hidden" name="__formname__" value="POSTTOPICS">
							</div>
					    	<textarea name="topicDescription" class="forum-editor" id="min-text" rows="15" style="" required ></textarea>
					    	<div class="forum-image-container">
					    		<ul></ul>
					    	</div>
					    	<div class="bottom-toolbar-forum">
					    		<ul>
					    			<li class=""><input type="file" name="topicFiles[]" id="topicFiles" style="padding-top: 8px;" multiple ></li>
					    			<li class="pull-right"><button type="submit" class="btn btn-success btn-submit-post">POST</button></li>
					    		</ul>
					    	</div>
			    		</form>
				    </div>
				</div>
				<!-- textarea ends here -->	
			
		</div><!-- col-lg-9 col-md-9 -->

		<div class="col-lg-3 col-md-3">
			<div class="information">
				<p>Please login and request for level up to participate in forum discussion.</p>
			</div>
			<?php require_once('includes/sportsRecommend.php'); ?>
		</div><!-- col-lg-3 col-md-3 -->
	</div>
</div>
</div>
<?php require_once('includes/doc_footer.php'); ?>