<footer id="ask-footer1" class="ask-footer1 container">

		<!--Footer Medium-->

			<div class="">

				<div class="">

					<div class="row mobile-footer" style="margin-left: -5px; margin-right: -5px;">

						<div class="col-md-3 col-sm-12 col-xs-12 padding5">

							<div class="ask-footer-content ask-footer-background">

								<h4 class="text-uppercase footer-heading" data-toggle="collapse" data-target="#footer-one"> 스포츠</h4>

								<ul class="custom-nav" id="footer-one">

									<li><a href="online-sports/" >일반 배팅사이트</a></li>
									<li><a href="newest-sports/" >신규 배팅사이트</a></li>
									<li><a href="verified-sports/" >검증된 배팅사이트</a></li>
									<li><a href="bitcoin-sports/" >비트코인 배팅사이트</a></li>
									<li><a href="livebetting-sports/" >라이브 배팅사이트</a></li>
									<!-- <li><a href="mobile-sports/" >라이브 배팅사이트</a></li> -->

								</ul>

							</div>

						</div>

						<div class="col-md-3 col-sm-12 col-xs-12 padding5">

							<div class="ask-footer-content ask-footer-background">

								<h4 class="text-uppercase footer-heading" data-toggle="collapse" data-target="#footer-two">보너스</h4>

								<ul class="custom-nav" id="footer-two">

									<li><a href="welcome-bonus/">신규 첫충 보너스</a></li>

									<li><a href="first-deposit-bonus/">첫충전 보너스</a></li>

									<li><a href="every-time-bonus/">매번 충전 보너스</a></li>

									<li><a href="combo-bonus/">다폴더 보너스</a></li>

									<li><a href="other-bonus/">기타 보너스</a></li>

								</ul>

							</div>

						</div>

						<div class="col-md-3 col-sm-12 col-xs-12 padding5">

							<div class="ask-footer-content ask-footer-background">

								<h4 class="text-uppercase footer-heading" data-toggle="collapse" data-target="#footer-three">사이트 분쟁</h4>

								<ul class="custom-nav" id="footer-three">

									<li><a href="complaint-open/">진행중인 분쟁</a></li>

									<li><a href="complaint-resolve/">해결된 분쟁</a></li>

									<li><a href="complaint-unsolved/">미해결된 분쟁</a></li>

									<li><a href="complaint-payment-issues/">입출금 분쟁</a></li>

									<li><a href="complaint-bonus-issues/">보너스 분쟁</a></li>

								</ul>

							</div>

						</div>

						<div class="col-md-3 col-sm-12 col-xs-12 padding5">

							<div class="ask-footer-content ask-footer-background">

								<h4 class="text-uppercase footer-heading">고객센터</h4>

								<ul class="custom-nav">

									<li><a href="termsandcondition.php">먹튀보상 및 이용규정</a></li>

									<li><a href="news-details/18/이제는-배팅타임할-때입니다.">배팅타임 소개</a></li>

<!-- 									<li><a href="sports-policy.php">배팅타임 소개</a></li> -->

									<li><a href="certificate-of-trust.php">사이트 등록약관</a></li>

									<li><a href="posting-guidlines.php/">포스팅 가이드라인</a></li>

									<li><a href="blog/">블로그</a></li>

								</ul>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div class="ask-copyright">

				<p>copright &copy; 2018 | The Betting time | All Right Reserved</p>

			</div>

		</footer>

		<!--Footer Medium End-->

		<?php //require_once('includes/chatBox.php'); ?>

	</div><!-- main -->

	





	    <?php require_once('includes/signup_modal.php'); ?>

	    <?php require_once('includes/login_modal.php'); ?>

	    <div class="modal fade" id="modalSocial" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog ask-modal-dialog">

        <div class="modal-content ask-modal-content">

        	<div class="ask-modal-content" style="width:95%;margin:10px auto;">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title modalSocialHeader"></h4>

                </div>

                <div class="modal-body modalSocialBody">

                    

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">배팅타임 가입코드 안내</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 10px;opacity: 1;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">

         <h5>가입코드를 다시 한번 확인해주세요.</h5><h3>가입코드 : <span id="modaljoincode">2222</span></h3><br> <h5>"바로가기" 버튼을 누르면 사이트로 이동합니다</h5>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelconfirm" class="btn btn-secondary" data-dismiss="modal">취소</button>
        <button type="button" class="btn btn-primary" id="modalconfirm">바로가기</button>
      </div>
    </div>
  </div>
</div>

	    <!-- Modal -->
<!-- push notification -->

		<div class="push-notification"  style="<?php echo (isset($_COOKIE['hide_popup_notify']) && $_COOKIE['hide_popup_notify'] == 1) ? 'display:none':''?>" >
			<a href="javascript:(0);" class="close-push-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
			<div class="media">
			  	<div class="media-left">
			    	<img src="images/user/admin.png" class="media-object" style="width:80px">
			  	</div>
			  	<div class="media-body">
			  		<h6>스포츠 중계는 배팅타임!</h6>
			    	<p>이제 배팅타임에서 스포츠 및 실시간 티비를 '딜레이 없이' 시청하세요! 배팅타임 로그인 후, 이용 가능합니다.</p>
			  	</div>
			</div>
			<div class="clearfix"></div>
			<img src="images/live-stream.png" style="width:100%;height:150px;" alt="">
		</div>

		<div class="push-notification-bell">
			<a href="javascript:void(0);" class="push-notification-bell-open text-success"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></a>
		</div>
<?php include 'liveChat.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/assets/js/liveChat2.js"></script>
<script src="assets/js/function.js"></script>
<script src="assets/js/forum.js"></script>
<script src="assets/js/readmore.js"></script>
<script src="assets/js/index.js"></script>
<script src="assets/js/advanced.js"></script>
<script src="assets/js/wysihtml5-0.3.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<!-- <script src="lib/fancybox/jquery.fancybox.js"></script> -->
<script>
	$('#content-read-more').readmore({speed: 500});
</script>
<script src="assets/js/lightbox-plus-jquery.min.js"></script>
<script src="assets/js/jquery.rateyo.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/jquery.cookie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

<script type="text/javascript">
	
	function redirect_sport(){
		window.location.href = "/sports/";	
	}
	function redirect_bonus(){
		window.location.href = "/bonus/";
	}
	function redirect_complaint(){
		window.location.href = "/complaints/";
	}

	$('#bs-example-navbar-collapse-3 li button.more_span').click(function(){
		//alert("here");
		var temp = $(this).parent('li.dropdown');
		if(temp.hasClass('open')){
			temp.removeClass('open');
			$(this).html('펼쳐보기');
		}
		else
		{
			temp.addClass('open');
			$(this).html('닫기');
			$(this).width('56px');

		}
	});


</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
	$(document).ready(function(){
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5abcbab4d7591465c709089e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
});
</script>
<!--End of Tawk.to Script-->

<script type="text/javascript">
	// $(document).ready(function(){
	// 	$('.fancy').fancybox();
	// 	$(".fancybox-button").fancybox();
	// });
	//modal

	var modalUniqueClass = ".modal";
		$('.modal').on('show.bs.modal', function(e) {
		  var $element = $(this);
		  var $uniques = $(modalUniqueClass + ':visible').not($(this));
		  if ($uniques.length) {
		    $uniques.modal('hide');
		    $uniques.one('hidden.bs.modal', function(e) {
		      $element.modal('show');
		    });
		    return false;
	  	}

	});



		$(document).on('show', '#myModal', function () {
		  $('#forgotpwdModal').modal('hide');
		});

		$(document).on('show', '#forgotpwdModal', function () {
		  $('#myModal').modal('hide');
		})



		$(document).on('click', '.myModalThreeBtn, .myModalTwoBtn, .myModalBtn', function () {
			$(this).parents('.modal').find('.close').click();
		});

</script>
<script>
	$(document).ready(function(){
  var editor = new wysihtml5.Editor("min-text", {
    toolbar:      "toolbar",
    stylesheets:  "../assets/css/editorstyle.css",
    parserRules:  wysihtml5ParserRules
  });
  });
</script>

<script type="text/javascript">

	$(document).ready(function(){
		$(document).on('change', '#nickName', function(){//alert('hi');
			jQuery.ajax({
				url: "check_availability.php",
				data:'nickName='+$("#nickName").val(),
				type: "POST",
				success:function(data){
					$("#user-availability-status").html('*' + data);
				},
				error:function (){}
			});
		});



		$(document).on('click', '.commentsFilter', function(){
			var t = $(this).data('filter');
			$('.commentsContainer > table.commentFilterTbl').addClass('commentFilterTblTmp');
			var x = [1, 2, 3, 4, 5];
			switch(t){
				case 'ALL':
				default:
					$('.commentsContainer > table.commentFilterTblTmp').each(function(){
						var p = $(this).data('rate');
						var i = $(this).data('idx');
						var c = $(this).clone();
						var cls = 'commentFilterTbl_' + p;
						$(c).addClass(cls).removeClass('commentFilterTblTmp');
						if($('.commentsContainer > table.commentFilterTblTmp:eq(' + i + ')').size() > 0){
							$(c).insertAfter('.commentsContainer > table.commentFilterTblTmp:eq(' + i + ')');
						} else {
							$(c).appendTo('.commentsContainer');

						}

					});

				break;

				case 'GOOD':

					$.each(x, function(i, v){

						var cls = 'commentFilterTbl_' + v;

						$('<span class="' + cls + ' tmpCommentFilterTbl"></span>').insertAfter('.commentsContainer > div.commentsFilterArea');

					});

					$('.commentsContainer > table.commentFilterTblTmp').each(function(){

						var p = $(this).data('rate');

						var c = $(this).clone();

						var cls = 'commentFilterTbl_' + p;

						$(c).addClass(cls).removeClass('commentFilterTblTmp');

						$(c).insertAfter('.commentsContainer > .' + cls + ':first');

					});

				break;

				case 'BAD':

					$.each(x, function(i, v){

						var cls = 'commentFilterTbl_' + v;

						$('<span class="' + cls + ' tmpCommentFilterTbl"></span>').appendTo('.commentsContainer');

					});

					$('.commentsContainer > table.commentFilterTblTmp').each(function(){

						var p = $(this).data('rate');

						var c = $(this).clone();

						var cls = 'commentFilterTbl_' + p;

						$(c).addClass(cls).removeClass('commentFilterTblTmp');

						//alert($('.commentsContainer > .' + cls + ':last-child').size());

						$(c).insertAfter('.commentsContainer > .' + cls + ':last');

					});

				break;

			}

			$('.commentsContainer > table.commentFilterTblTmp').remove();

			$('.commentsContainer > span.tmpCommentFilterTbl').remove();

			return false;

		});

		$(document).ready(function(){
			$(document).on('click','#deleteComplain',function(){//alert('hi');
			   	var _tblName = $(this).data('tabelname');
			   	var _rowId = $(this).data('attrid');
			   	$.ajax({
		            url: "../ajax/deleteComplaint.php", // link of your "whatever" php
		            type: "POST",
		            //async: true,
		            //cache: false,
		            data: 'tabelName='+_tblName+'&row='+_rowId, // all data will be passed here
		            success: function(data){  
		                location.reload();
		            }
		        });
			});
		});

		

		

		

		







		<?php if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && !$User->checkLoginStatus()){ ?>

			// $('#signIn').bind( "click", function() {

			// 	alert("hi");

			// });

			// $('#signIn').click();

			// $(window).on('load', function(){

			// 	$('.myModalBtn').click();

			// });

		<?php } ?>

	});

</script>

<script type="text/javascript">

	function validate() {

	    var uploadImg = document.getElementById('uploadImg');

	    //uploadImg.files: FileList

	    for (var i = 0; i < uploadImg.files.length; i++) {

	       var f = uploadImg.files[i];

	       if (!endsWith(f.name, 'jpg') && !endsWith(f.name,'png')) {

	           alert(f.name + " is not a valid file!");

	           return false;

	       } else {

	           return true;



	       }

	    }

	}



	function endsWith(str, suffix) {

	   return str.indexOf(suffix, str.length - suffix.length) !== -1;

	}

</script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$(".cardLogo").find('img').each(function(){
		   if($(this).is(':visible')){
		     //alert("This image is visible");
		    }
		});
	});
</script>
<script type="text/javascript">
	$('.column img').click(function(){
		var _sr = $(this).attr('src');
		$('#expandedImg').attr('src', _sr);
		$('#expandedImg').parent('.container1').css('display', 'block');
	});
	$('.closebtn').click(function(){
		$('#expandedImg').attr('src','');
		$('#expandedImg').parent('.container1').css('display', 'none');
	});
	// function myFunction1(imgs) {
	//     var expandImg = document.getElementById("expandedImg");
	//     var imgText = document.getElementById("imgtext");
	//     expandImg.src = imgs.src;
	//     imgText.innerHTML = imgs.alt;
	//     expandImg.parentElement.style.display = "block";
	// }

</script>

<?php 

if(isset($siteAdminLogin)){

echo '<script src="assets/js/siteAdminLogin.js"></script>';

} else if(isset($siteUserLogin)){

echo '<script src="assets/js/siteUserLogin.js"></script>';

}else{

	echo '';

}

?>

</body>

</html>