

<?php require_once('config.php'); ?>
<?php
$ch = 1; 
if(!isset($_GET["tg"]) && !isset($_GET['ch']) && !isset($_GET['ca']) ){
  header("location:live-stream.php?tg=1ch&ch=live01&ca=0");
  die;
}
if(isset($_GET["tg"])){ 
  $ch = str_replace('ch','',$_GET["tg"]);
} 

?>
<?php require_once('includes/doc_head.php'); ?>
  
<div>
	<div class="header">
        <div class=""><!--.container-->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="player_title">JTBC</div>
                </div>
            </div>
        </div>
    </div>
    <div class=""><!-- .container -->
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 marbotmob">
                <div class="video-chanel-container">
                    <section class="channel_num_select_wrap">
                        <ul class="horizon_block_wrap">
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=0" class="active btn btn-ask-black btn-full"> <!-- <img src="stream-image/images/11.png" alt="멀티 1채널"> -->멀티 1채널</a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=2ch&amp;ch=live01&amp;ca=0" class="btn btn-ask-black btn-full"> <!-- <img src="stream-image/images/22.png" alt="멀티 2채널"> -->멀티 2채널</a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=3ch&amp;ch=live01&amp;ca=0" class="btn btn-ask-black btn-full"> <!-- <img src="stream-image/images/33.png" alt="멀티 3채널"> -->멀티 3채널</a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=4ch&amp;ch=live01&amp;ca=0" class="btn btn-ask-black btn-full"> <!-- <img src="stream-image/images/44.png" alt="멀티 4채널">  -->멀티 4채널</a> </li>
                            <!-- <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=0" class="active"> <img src="stream-image/images/11.png" alt="멀티 1채널"> </a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=2ch&amp;ch=live01&amp;ca=0" class=""> <img src="stream-image/images/22.png" alt="멀티 2채널"> </a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=3ch&amp;ch=live01&amp;ca=0" class=""> <img src="stream-image/images/33.png" alt="멀티 3채널"> </a> </li>
                            <li class="channel_num_select_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=4ch&amp;ch=live01&amp;ca=0" class=""> <img src="stream-image/images/44.png" alt="멀티 4채널"> </a> </li> -->
                        </ul>
                    </section>
                    <section class="media_wrap">          
                        <div class="vidoeparent "> 
                        <?php 
                        for ($i=1; $i <=$ch ; $i++) {    
                          if($ch==2){
                            $class="videos2";
                          }
                          if($ch==3){
                            $class="videos3";
                          }
                          if($ch==4){
                            $class="videos4"; 
                          }
                        ?>
                          <div class="media_<?php echo $i ?>ch_wrap <?php echo $class; ?>">
                            <div id="player<?php echo $i ?>"></div>
                          </div> 
                          <?php 
                        }  
                        ?>
                        </div>          
                    </section>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <section class="live_channel_wrap">
                    <ul class="live_channel_list horizon_block_wrap">
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live01" data-title="JTBC"> <img src="stream-image/images/jtbc_on.png" alt="JTBC"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live03" data-title="super-action"> <img src="stream-image/images/super-action_on.png" alt="super-action"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live05" data-title="OCN"> <img src="stream-image/images/ocn_on.png" alt="OCN"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live04" data-title="CGV"> <img src="stream-image/images/cgv_on.png" alt="CGV"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live06" data-title="TVN"> <img src="stream-image/images/tvn_on.png" alt="TVN"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live07" data-title="MBC"> <img src="stream-image/images/mbc_on.png" alt="MBC"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live14" data-title="SBS"> <img src="stream-image/images/sbs_on.png" alt="SBS"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live15" data-title="KBS1"> <img src="stream-image/images/kbs1_on.png" alt="KBS1"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live13" data-title="KBS2"> <img src="stream-image/images/kbs2_on.png" alt="KBS2"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live10" data-title="Music"> <img src="stream-image/images/music_on.png" alt="Music"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live37" data-title="J_Golf"> <img src="stream-image/images/j_golf_on.png" alt="J_Golf"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live11" data-title="XTM"> <img src="stream-image/images/xtm_on.png" alt="XTM"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live26" data-title="sbs_golf"> <img src="stream-image/images/sbs_golf_on.png" alt="sbs_golf"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live12" data-title="comedy_tv"> <img src="stream-image/images/comedy_tv_on.png" alt="comedy_tv"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live21" data-title="mbc_dramanet"> <img src="stream-image/images/mbc_dramanet_on.png" alt="mbc_dramanet"> </a> </li>
                        <li class="live_channel_list_item horizon_block"> <a class="ch1_select" data-stream="live22" data-title="mbc_every1"> <img src="stream-image/images/mbc_every1_on.png" alt="mbc_every1"> </a> </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    <div class="category">
  
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <section class="sport_category_wrap">
                        <ul class="horizon_block_wrap">
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=0">
                                <div class="sport_category_1"></div>
                                <span class="sport_category_count">1</span> </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=1">
                                <div class="sport_category_2"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=4">
                                <div class="sport_category_3"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=2">
                                <div class="sport_category_4"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=3">
                                <div class="sport_category_5"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=5">
                                <div class="sport_category_6"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=6">
                                <div class="sport_category_7"></div>
                                </a> 
                            </li>
                            <li class="sport_category_item horizon_block"> <a href="live-stream.php?lc=&amp;tg=1ch&amp;ch=live01&amp;ca=8">
                                <div class="sport_category_8"></div>
                                </a> 
                            </li>
                   
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
      	<div class="scrolldiv">
        <section class="sport_channel_wrap">
          <img  src="https://www.pedul.com/images/loading.gif" alt="Please wait...." title="ikodes technology" style="text-align: center;"> 
        </section>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once('includes/doc_footer.php'); ?>
