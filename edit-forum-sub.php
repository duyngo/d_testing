	
<?php
require_once('config.php');

// Load Classes
C::loadClass('User');
C::loadClass('Forum');

$User = new User();
$Forum = new Forum();


$editValueResponse = array(
	'id' => '',
	'topicParentId' => '',
	'topicResponseUniqueId' => '',
	'topicResponseIndex' => '',
	'topicResponseDescription' => '',
	'topicResponseFiles' => ''
);



//print_r($_POST);
//$prev_anchor = $_SERVER['HTTP_REFERER'];

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && $_POST['__formname__'] == 'POSTTOPICS'){
	// print_r($_POST);
	// print_r($_FILES);DIE();
    if($Forum->updateForumtopicResponse($_POST, $_FILES)){
    	C::redirect(C::link('forum.php', false, true));
    }	
}


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
	padding-top: 50px;
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

<?php

if(isset($_GET) && is_array($_GET) && count($_GET) > 0){
	$tblname = $_GET['table'];


	if($tblname == 'tblForumTopicsResponse'){
		
		//echo "SELECT * FROM `". $tblname. "`  WHERE `id` = '" . $_GET['id'] ."' LIMIT 0, 1";

	$totals = $User->query("SELECT * FROM `". $tblname. "`  WHERE `id` = '" . $_GET['id'] ."' LIMIT 0, 1");
	if($totals && is_array($totals) && count($totals) > 0){ //echo $totals[0]['id'];
		$editValue['id'] = $totals[0]['id'];
		$editValue['topicParentId'] = $totals[0]['topicParentId'];
		$editValue['topicResponseUniqueId'] = $totals[0]['topicResponseUniqueId'];
		$editValue['topicResponseIndex'] = $totals[0]['topicResponseIndex'];
		$editValue['topicResponseDescription'] = $totals[0]['topicResponseDescription'];
		$editValue['topicResponseFiles'] = $totals[0]['topicResponseFiles'];
		//echo $editValue['topicFiles'];
	}
?>
			<div class="text-area-container">
				<a href="javascript: history.go(-1);" title="Cancel edit and go back" class="btn btn-primary btn-xs btn-del-img" id="removeEditorContainerlist"><i class="fa fa-times" aria-hidden="true"></i></a>
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
							<span class="text-white">링크:</span>
							<input data-wysihtml5-dialog-field="href" value="http://" style="height:22px;">
							</label>
							<a data-wysihtml5-dialog-action="save" class="btn btn-danger btn-xs">확인</a>&nbsp;<a data-wysihtml5-dialog-action="cancel" class="btn btn-info btn-xs">취소</a>
						</div>
					</div>
					<input type="hidden" name="id" class="input-title" value="<?php echo $editValue['id'];?>">
					<input type="hidden" name="__formname__" value="POSTTOPICS">
			    	<textarea name="topicDescription" class="forum-editor" id="min-text" rows="15" style="width:100%;" ><?php echo $editValue['topicResponseDescription']; ?></textarea>
			    	<div class="forum-image-container" style="display:bolck;">
			    		<ul>
			    			<?php 
			    			$f = json_decode($editValue['topicResponseFiles']); 

			    			foreach ($f as $imgf) {
			    			?>
			    			<li>
								<a class="fancybox" rel="gallery" href="<?php echo $imgf ;?>"><img src="<?php echo $imgf;?>" class="img-responsive" width="130px" height="90px" alt=""></a>
								<button type="button" class="btn btn-danger btn-xs btn-del-img delImg">
									<i class="fa fa-times-circle" aria-hidden="true"></i>
								</button>
								<input type="hidden" name="prevFile[]" value="<?php echo $imgf;?>" />
							</li>
							<?php
							}
							?>
			    		</ul>
			    	</div>
			    	<!-- <div class="bottom-toolbar-forum">
			    		<ul>
			    			<li class=""><input type="file" name="topicFiles[]" id="topicFiles" style="padding-top: 8px;" multiple ></li>
			    			<li class="pull-right"><button type="submit" class="btn btn-success btn-submit-post">POST</button></li>
			    		</ul>
			    	</div> -->
			    	<div class="bottom-toolbar-forum" style="overflow:hidden;">
			    		<ul class="forum-discussion-image-uploadlist">
			    			<li>
								<label class="fileContainer">
								    <i class="fa fa-picture-o" aria-hidden="true"></i>
								    <input type="file" name="topicFiles[]" id="topicFiles" />
								</label>
			    			</li>
			    			<li class="pull-right"><button type="submit" class="btn btn-success btn-submit-post">작성하기</button></li>
			    			<li class="pull-right" style=" margin-right: 16px;margin-top: 10px;"><button type="button" class="btn btn-default btn-xs btn-forum-remove-image" title="Remove Image">이미지 삭제하기</button></li>
			    			<li class="pull-right" style=" margin-right: 5px;margin-top: 10px;"><button type="button" class="btn btn-default btn-xs btn-forum-add-image" title="Add image">이미지 추가하기</button></li>
			    		</ul>
			    	</div>
				</form>
			</div>

			<!-- <p class="text-danger"> ** Soon you can edit image.</p> -->

<?php
	
	}			
}
?>
		</div><!-- col-lg-9 col-md-9 -->

		<div class="col-lg-3 col-md-3">
			<?php require_once('includes/sportsRecommend.php'); ?>
		</div><!-- col-lg-3 col-md-3 -->
	</div>
</div>
</div>
<?php require_once('includes/doc_footer.php'); ?>