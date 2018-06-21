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
					<h5>Forum User</h5>
					<h6>Forum Current members</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content user-table-show">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
						<thead>
							<tr>
								<th class="avatar">Nick Name</th>
								<!-- <th>Email</th> -->
								<th>User Id</th>
								<th>User Role</th>
								<th>Notes</th>
								<th>Status</th>
								<th>Admin Checking</th>
								<th>Requested On</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
							<tbody>
								<?php
								$result = $Base->query("SELECT `TLP`.`id` AS `TLPI`, `TLP`.`isVerified`, `TLP`.`createdOn`, `TLP`.`msg`, `TLP`.`checkAdmin`, `TLU`.`id` AS `TLUI`, `TLU`.`userId`, `TLU`.`nickName`, `TLU`.`groupId` FROM `tblLevelUp` AS `TLP`, `tblUser` AS `TLU` WHERE `TLP`.`userId` = `TLU`.`id` ORDER BY `TLP`.`createdOn` DESC, `TLP`.`isVerified` ASC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {	
									if($value['groupId'] == '0'){

									} else {			
								?>
								<tr>
									<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> <?php echo $value['nickName']; ?></td>
									<td> <?php echo $value['userId']; ?></td>
									<td> 
										<?php
											if ($value['groupId'] == 0) {
												echo "Admin";
											} else if ($value['groupId'] == 2){
												echo "Site Admin";
											} else if ($value['groupId'] == 3){
												echo "User";
											} else if ($value['groupId'] == 4){
												echo "Forum User";
											}
										?>
									</td>
									<td> <?php echo $value['msg']; ?></td>
									<td> 
										<select name="" class="changeLevelupRequest" data-user="<?php echo $value['TLUI']; ?>" data-levelupid="<?php echo $value['TLPI']; ?>">
											<option <?php if(($value['isVerified']) == 'P') echo 'selected'; ?> value="P">Pending</option>
											<option <?php if(($value['isVerified']) == 'Y') echo 'selected'; ?> value="Y">Verified</option>
											<option <?php if(($value['isVerified']) == 'N') echo 'selected'; ?> value="N">Rejected</option>
										</select>
									</td>
									<td> 
										<select name="" id="checkadminstatus" data-user="<?php echo $value['TLUI']; ?>" data-levelupid="<?php echo $value['TLPI']; ?>">
											<option <?php if(($value['checkAdmin']) == 'Y') echo 'selected'; ?> value="Y">Yes</option>
											<option <?php if(($value['checkAdmin']) == 'N') echo 'selected'; ?> value="N">No</option>
										</select>
									</td>
									<td> <?php echo $value['createdOn']; ?></td>
									<!-- <td>
										<a href="<?php echo C::link('userEdit.php', array('edit' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white"><i class="fa fa-edit"></i></a>
										<a href="<?php echo C::link('users.php', array('delete' => $value['id']), true);?>" class="btn btn-warning btn-xs text-white" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
									</td> -->
								</tr>
								<?php
								} }
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