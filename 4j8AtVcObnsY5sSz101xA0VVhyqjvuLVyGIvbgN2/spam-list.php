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
$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
if ( $groupId[0]['groupId'] != 0) {
	$Common->redirect('index.php');
}




if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($User->userDel($_GET['delete'])){
		C::redirect(C::link('users.php', false, true));
	}
}
$activeNavigation = "userslevel";
?>
<?php require_once('includes/doc_head.php'); ?>
<style>
	.user-table-show #myTable_wrapper{
		clear:none;
	}
	table#myTable tr:hover select{
		color:#000;
	}
</style>
<section class="alert">
	<div class="green" style="display:none;">	
		<p></p>
		<span class="close">&#10006;</span>
	</div>
	<div class="red" style="display:none;">	
		<p></p>
		<span class="close">&#10006;</span>
	</div>
</section>

<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128100;</span>
				<hgroup>
					<h5>Spam</h5>
					<h6>Forum Discussion spam report</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content user-table-show">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
						<thead>
							<tr>
								<th>Topic Title</th>
								<th>Created ON</th>
								<th>Created By</th>
								<th>Spam Count</th>
								<th>Hide</th>
							</tr>
						</thead>
							<tbody>
								<?php
								$result = $Base->query("SELECT DISTINCT `TFT`.`id`, `TFT`.`topicTitle`, `TFT`.`topicUniqueId`, `TFT`.`createdOn`, `TFT`.`isDispaly`, `TU`.`nickname` FROM `tblForumTopicsSpam` AS `TFS`, `tblForumTopics` AS `TFT`, `tblUser` AS `TU` WHERE `TFS`.`topicUniqueId` = `TFT`.`topicUniqueId` AND `TFT`.`createdBy` = `TU`.`id` ORDER BY `TFT`.`createdOn` ASC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
								<tr>
									<td> <?php echo $value['topicTitle']; ?></td>
									<td> 
										<?php echo $value['createdOn']; ?>
									</td>
									<td> <?php echo $value['nickname']; ?></td>
									<td> 
										<?php
										$countt = $Base->query("SELECT COUNT( * ) AS `CLT` FROM `tblForumTopicsSpam` WHERE `topicUniqueId` = '". $value['topicUniqueId'] ."'");
										echo $countt[0]['CLT']; 
										?>
									</td>
									<td> 
										<select name="" class="showHideTopic" data-topic="<?php echo $value['id']; ?>">
											<option <?php if(($value['isDispaly']) == 'N') echo 'selected'; ?> value="N">No</option>
											<option <?php if(($value['isDispaly']) == 'Y') echo 'selected'; ?> value="Y">Yes</option>
										</select>
									</td>
								</tr>
								<?php
								}
							}
							?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</section>
</section>


<?php require_once('includes/doc_footer.php'); ?>