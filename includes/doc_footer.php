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

<script type="text/javascript" src="assets/js/wysiwyg.min.js"></script>
<script type="text/javascript" src="assets/js/wysiwyg-editor.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/wysiwyg-editor.css" />

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
		//new editor
		$('#editor1').each( function(index, element)
		{
			$(element).wysiwyg({
				'class': index == 0 ? 'fake-bootstrap' : (index == 1 ? 'fake-uikit' : 'some-more-classes'),
				// 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
				toolbar: index == 0 ? 'top-selection' : (index == 1 ? 'bottom-focus' : 'selection'),
				buttons: {
					// Dummy-HTML-Plugin
					dummybutton1: index != 1 ? false : {
						html: $('<input id="submit" type="button" value="Submit" />').click(function() {
							alert( 'Submit form' );
						}),
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					// Dummy-Button-Plugin
					dummybutton2: index != 1 ? false : {
						title: 'Dummy',
						image: '\uf1e7',
						click: function( $button ) {
							// We simply make 'bold'
							if( $(element).wysiwyg('shell').getSelectedHTML() )
								$(element).wysiwyg('shell').bold();
							else
								alert( 'No text selected' );
						},
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					// Smiley plugin
					smilies: {
						title: 'Smilies',
						image: '\uf118', // <img src="path/to/image.png" width="16" height="16" alt="" />
						popup: function( $popup, $button ) {
							var list_smilies = [
								'<img src="smiley/afraid.png" width="16" height="16" alt="" />',
								'<img src="smiley/amorous.png" width="16" height="16" alt="" />',
								'<img src="smiley/angel.png" width="16" height="16" alt="" />',
								'<img src="smiley/angry.png" width="16" height="16" alt="" />',
								'<img src="smiley/bored.png" width="16" height="16" alt="" />',
								'<img src="smiley/cold.png" width="16" height="16" alt="" />',
								'<img src="smiley/confused.png" width="16" height="16" alt="" />',
								'<img src="smiley/cross.png" width="16" height="16" alt="" />',
								'<img src="smiley/crying.png" width="16" height="16" alt="" />',
								'<img src="smiley/devil.png" width="16" height="16" alt="" />',
								'<img src="smiley/disappointed.png" width="16" height="16" alt="" />',
								'<img src="smiley/dont-know.png" width="16" height="16" alt="" />',
								'<img src="smiley/drool.png" width="16" height="16" alt="" />',
								'<img src="smiley/embarrassed.png" width="16" height="16" alt="" />',
								'<img src="smiley/excited.png" width="16" height="16" alt="" />',
								'<img src="smiley/excruciating.png" width="16" height="16" alt="" />',
								'<img src="smiley/eyeroll.png" width="16" height="16" alt="" />',
								'<img src="smiley/happy.png" width="16" height="16" alt="" />',
								'<img src="smiley/hot.png" width="16" height="16" alt="" />',
								'<img src="smiley/hug-left.png" width="16" height="16" alt="" />',
								'<img src="smiley/hug-right.png" width="16" height="16" alt="" />',
								'<img src="smiley/hungry.png" width="16" height="16" alt="" />',
								'<img src="smiley/invincible.png" width="16" height="16" alt="" />',
								'<img src="smiley/kiss.png" width="16" height="16" alt="" />',
								'<img src="smiley/lying.png" width="16" height="16" alt="" />',
								'<img src="smiley/meeting.png" width="16" height="16" alt="" />',
								'<img src="smiley/nerdy.png" width="16" height="16" alt="" />',
								'<img src="smiley/neutral.png" width="16" height="16" alt="" />',
								'<img src="smiley/party.png" width="16" height="16" alt="" />',
								'<img src="smiley/pirate.png" width="16" height="16" alt="" />',
								'<img src="smiley/pissed-off.png" width="16" height="16" alt="" />',
								'<img src="smiley/question.png" width="16" height="16" alt="" />',
								'<img src="smiley/sad.png" width="16" height="16" alt="" />',
								'<img src="smiley/shame.png" width="16" height="16" alt="" />',
								'<img src="smiley/shocked.png" width="16" height="16" alt="" />',
								'<img src="smiley/shut-mouth.png" width="16" height="16" alt="" />',
								'<img src="smiley/sick.png" width="16" height="16" alt="" />',
								'<img src="smiley/silent.png" width="16" height="16" alt="" />',
								'<img src="smiley/sleeping.png" width="16" height="16" alt="" />',
								'<img src="smiley/sleepy.png" width="16" height="16" alt="" />',
								'<img src="smiley/stressed.png" width="16" height="16" alt="" />',
								'<img src="smiley/thinking.png" width="16" height="16" alt="" />',
								'<img src="smiley/tongue.png" width="16" height="16" alt="" />',
								'<img src="smiley/uhm-yeah.png" width="16" height="16" alt="" />',
								'<img src="smiley/wink.png" width="16" height="16" alt="" />',
								'<img src="smiley/working.png" width="16" height="16" alt="" />',
								'<img src="smiley/bathing.png" width="16" height="16" alt="" />',
								'<img src="smiley/beer.png" width="16" height="16" alt="" />',
								'<img src="smiley/boy.png" width="16" height="16" alt="" />',
								'<img src="smiley/camera.png" width="16" height="16" alt="" />',
								'<img src="smiley/chilli.png" width="16" height="16" alt="" />',
								'<img src="smiley/cigarette.png" width="16" height="16" alt="" />',
								'<img src="smiley/cinema.png" width="16" height="16" alt="" />',
								'<img src="smiley/coffee.png" width="16" height="16" alt="" />',
								'<img src="smiley/girl.png" width="16" height="16" alt="" />',
								'<img src="smiley/console.png" width="16" height="16" alt="" />',
								'<img src="smiley/grumpy.png" width="16" height="16" alt="" />',
								'<img src="smiley/in_love.png" width="16" height="16" alt="" />',
								'<img src="smiley/internet.png" width="16" height="16" alt="" />',
								'<img src="smiley/lamp.png" width="16" height="16" alt="" />',
								'<img src="smiley/mobile.png" width="16" height="16" alt="" />',
								'<img src="smiley/mrgreen.png" width="16" height="16" alt="" />',
								'<img src="smiley/musical-note.png" width="16" height="16" alt="" />',
								'<img src="smiley/music.png" width="16" height="16" alt="" />',
								'<img src="smiley/phone.png" width="16" height="16" alt="" />',
								'<img src="smiley/plate.png" width="16" height="16" alt="" />',
								'<img src="smiley/restroom.png" width="16" height="16" alt="" />',
								'<img src="smiley/rose.png" width="16" height="16" alt="" />',
								'<img src="smiley/search.png" width="16" height="16" alt="" />',
								'<img src="smiley/shopping.png" width="16" height="16" alt="" />',
								'<img src="smiley/star.png" width="16" height="16" alt="" />',
								'<img src="smiley/studying.png" width="16" height="16" alt="" />',
								'<img src="smiley/suit.png" width="16" height="16" alt="" />',
								'<img src="smiley/surfing.png" width="16" height="16" alt="" />',
								'<img src="smiley/thunder.png" width="16" height="16" alt="" />',
								'<img src="smiley/tv.png" width="16" height="16" alt="" />',
								'<img src="smiley/typing.png" width="16" height="16" alt="" />',
								'<img src="smiley/writing.png" width="16" height="16" alt="" />'
							];
							var $smilies = $('<div/>').addClass('wysiwyg-plugin-smilies')
								.attr('unselectable','on');
							$.each( list_smilies, function(index,smiley) {
								if( index != 0 )
									$smilies.append(' ');
								var $image = $(smiley).attr('unselectable','on');
								// Append smiley
								var imagehtml = ' '+$('<div/>').append($image.clone()).html()+' ';
								$image
									.css({ cursor: 'pointer' })
									.click(function(event) {
										$(element).wysiwyg('shell').insertHTML(imagehtml); // .closePopup(); - do not close the popup
									})
									.appendTo( $smilies );
							});
							var $container = $(element).wysiwyg('container');
							$smilies.css({ maxWidth: parseInt($container.width()*0.95)+'px' });
							$popup.append( $smilies );
							// Smilies do not close on click, so force the popup-position to cover the toolbar
							var $toolbar = $button.parents( '.wysiwyg-toolbar' );
							if( ! $toolbar.length ) // selection toolbar?
								return ;
							return { // this prevents applying default position
								left: parseInt( ($toolbar.outerWidth() - $popup.outerWidth()) / 2 ),
								top: $toolbar.hasClass('wysiwyg-toolbar-bottom') ? ($container.outerHeight() - parseInt($button.outerHeight()/4)) : (parseInt($button.outerHeight()/4) - $popup.height())
							};
						},
						//showstatic: true,    // wanted on the toolbar
						showselection: index == 2 ? true : false    // wanted on selection
					},
					insertimage: {
						title: 'Insert image',
						image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: index == 2 ? true : false    // wanted on selection
					},
					insertvideo: {
						title: 'Insert video',
						image: '\uf03d', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: index == 2 ? true : false    // wanted on selection
					},
					insertlink: {
						title: 'Insert link',
						image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
					},
					// Fontname plugin
					fontname: index == 1 ? false : {
						title: 'Font',
						image: '\uf031', // <img src="path/to/image.png" width="16" height="16" alt="" />
						popup: function( $popup, $button ) {
							var list_fontnames = {
								// Name : Font
								'Arial, Helvetica' : 'Arial,Helvetica',
								'Verdana'          : 'Verdana,Geneva',
								'Georgia'          : 'Georgia',
								'Courier New'      : 'Courier New,Courier',
								'Times New Roman'  : 'Times New Roman,Times'
							};
							var $list = $('<div/>').addClass('wysiwyg-plugin-list')
								.attr('unselectable','on');
							$.each( list_fontnames, function( name, font ) {
								var $link = $('<a/>').attr('href','#')
									.css( 'font-family', font )
									.html( name )
									.click(function(event) {
										$(element).wysiwyg('shell').fontName(font).closePopup();
										// prevent link-href-#
										event.stopPropagation();
										event.preventDefault();
										return false;
									});
								$list.append( $link );
							});
							$popup.append( $list );
						},
						//showstatic: true,    // wanted on the toolbar
						showselection: index == 0 ? true : false    // wanted on selection
					},
					// Fontsize plugin
					fontsize: index != 1 ? false : {
						title: 'Size',
						style: 'color:white;background:red',      // you can pass any property - example: "style"
						image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
						popup: function( $popup, $button ) {
							// Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
							var list_fontsizes = [];
							for( var i=8; i <= 11; ++i )
								list_fontsizes.push(i+'px');
							for( var i=12; i <= 28; i+=2 )
								list_fontsizes.push(i+'px');
							list_fontsizes.push('36px');
							list_fontsizes.push('48px');
							list_fontsizes.push('72px');
							var $list = $('<div/>').addClass('wysiwyg-plugin-list')
								.attr('unselectable','on');
							$.each( list_fontsizes, function( index, size ) {
								var $link = $('<a/>').attr('href','#')
									.html( size )
									.click(function(event) {
										$(element).wysiwyg('shell').fontSize(7).closePopup();
										$(element).wysiwyg('container')
											.find('font[size=7]')
											.removeAttr("size")
											.css("font-size", size);
										// prevent link-href-#
										event.stopPropagation();
										event.preventDefault();
										return false;
									});
								$list.append( $link );
							});
							$popup.append( $list );
						}
						//showstatic: true,    // wanted on the toolbar
						//showselection: true    // wanted on selection
					},
					// Header plugin
					header: index != 1 ? false : {
						title: 'Header',
						style: 'color:white;background:blue',      // you can pass any property - example: "style"
						image: '\uf1dc', // <img src="path/to/image.png" width="16" height="16" alt="" />
						popup: function( $popup, $button ) {
							var list_headers = {
								// Name : Font
								'Header 1' : '<h1>',
								'Header 2' : '<h2>',
								'Header 3' : '<h3>',
								'Header 4' : '<h4>',
								'Header 5' : '<h5>',
								'Header 6' : '<h6>',
								'Code'     : '<pre>'
							};
							var $list = $('<div/>').addClass('wysiwyg-plugin-list')
								.attr('unselectable','on');
							$.each( list_headers, function( name, format ) {
								var $link = $('<a/>').attr('href','#')
									.css( 'font-family', format )
									.html( name )
									.click(function(event) {
										$(element).wysiwyg('shell').format(format).closePopup();
										// prevent link-href-#
										event.stopPropagation();
										event.preventDefault();
										return false;
									});
								$list.append( $link );
							});
							$popup.append( $list );
						}
						//showstatic: true,    // wanted on the toolbar
						//showselection: false    // wanted on selection
					},
					bold: {
						title: 'Bold (Ctrl+B)',
						image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
						hotkey: 'b'
					},
					italic: {
						title: 'Italic (Ctrl+I)',
						image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
						hotkey: 'i'
					},
					underline: {
						title: 'Underline (Ctrl+U)',
						image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
						hotkey: 'u'
					},
					strikethrough: {
						title: 'Strikethrough (Ctrl+S)',
						image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
						hotkey: 's'
					},
					forecolor: {
						title: 'Text color',
						image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
					},
					highlight: {
						title: 'Background color',
						image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
					},
					alignleft: index != 0 ? false : {
						title: 'Left',
						image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					aligncenter: index != 0 ? false : {
						title: 'Center',
						image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					alignright: index != 0 ? false : {
						title: 'Right',
						image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					alignjustify: index != 0 ? false : {
						title: 'Justify',
						image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					subscript: index == 1 ? false : {
						title: 'Subscript',
						image: '\uf12c', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: true    // wanted on selection
					},
					superscript: index == 1 ? false : {
						title: 'Superscript',
						image: '\uf12b', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: true    // wanted on selection
					},
					indent: index != 0 ? false : {
						title: 'Indent',
						image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					outdent: index != 0 ? false : {
						title: 'Outdent',
						image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					orderedList: index != 0 ? false : {
						title: 'Ordered list',
						image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					unorderedList: index != 0 ? false : {
						title: 'Unordered list',
						image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
						//showstatic: true,    // wanted on the toolbar
						showselection: false    // wanted on selection
					},
					removeformat: {
						title: 'Remove format',
						image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
					}
				},
				// Submit-Button
				submit: {
					title: 'Submit',
					image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
				},
				// Other properties
				selectImage: 'Click or drop image',
				placeholderUrl: 'www.example.com',
				placeholderEmbed: '<embed/>',
				maxImageSize: [600,200],
				//filterImageType: callback( file ) {},
				onKeyDown: function( key, character, shiftKey, altKey, ctrlKey, metaKey ) {
					// E.g.: submit form on enter-key:
					//if( (key == 10 || key == 13) && !shiftKey && !altKey && !ctrlKey && !metaKey ) {
					//    submit_form();
					//    return false; // swallow enter
					//}
				},
				onKeyPress: function( key, character, shiftKey, altKey, ctrlKey, metaKey ) {
				},
				onKeyUp: function( key, character, shiftKey, altKey, ctrlKey, metaKey ) {
				},
				onAutocomplete: function( typed, key, character, shiftKey, altKey, ctrlKey, metaKey ) {
					if( typed.indexOf('@') == 0 ) // startswith '@'
					{
						var usernames = [
							'Evelyn',
							'Harry',
							'Amelia',
							'Oliver',
							'Isabelle',
							'Eddie',
							'Editha',
							'Jacob',
							'Emily',
							'George',
							'Edison'
						];
						var $list = $('<div/>').addClass('wysiwyg-plugin-list')
							.attr('unselectable','on');
						$.each( usernames, function( index, username ) {
							if( username.toLowerCase().indexOf(typed.substring(1).toLowerCase()) !== 0 ) // don't count first character '@'
								return;
							var $link = $('<a/>').attr('href','#')
								.text( username )
								.click(function(event) {
									var url = 'http://example.com/user/' + username,
										html = '<a href="' + url + '">@' + username + '</a> ';
									var editor = $(element).wysiwyg('shell');
									// Expand selection and set inject HTML
									editor.expandSelection( typed.length, 0 ).insertHTML( html );
									editor.closePopup().getElement().focus();
									// prevent link-href-#
									event.stopPropagation();
									event.preventDefault();
									return false;
								});
							$list.append( $link );
						});
						if( $list.children().length )
						{
							if( key == 13 )
							{
								$list.children(':first').click();
								return false; // swallow enter
							}
							// Show popup
							else if( character || key == 8 )
								return $list;
						}
					}
				},
				onImageUpload: function( insert_image ) {
	// A bit tricky, because we can't easily upload a file via
	// '$.ajax()' on a legacy browser without XMLHttpRequest2.
	// You have to submit the form into an '<iframe/>' element.
	// Call 'insert_image(url)' as soon as the file is online
	// and the URL is available.
	// Example server script (written in PHP):

	// Example client script (without upload-progressbar):
	var iframe_name = 'legacy-uploader-' + Math.random().toString(36).substring(2);
	$('<iframe>').attr('name',iframe_name)
	.load(function() {
		// <iframe> is ready - we will find the URL in the iframe-body
		var iframe = this;
		var iframedoc = iframe.contentDocument ? iframe.contentDocument :
			(iframe.contentWindow ? iframe.contentWindow.document : iframe.document);
		var iframebody = iframedoc.getElementsByTagName('body')[0];
		var image_url = iframebody.innerHTML;
		insert_image( image_url );
		$(iframe).remove();
	})
	.appendTo(document.body);
	var $input = $(this);
	$input.attr('name','upload-filename')
	.parents('form')
	.attr('action','/script.php') // accessing cross domain <iframes> could be difficult
	.attr('method','POST')
	.attr('enctype','multipart/form-data')
	.attr('target',iframe_name)
	.submit();
	},
	forceImageUpload: false,    // upload images even if File-API is present
	videoFromUrl: function( url ) {
		// Contributions are welcome :-)

		// youtube - http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
		var youtube_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:youtu\.be|youtube\.com)\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/)([^\?&\"'>]+)/ );
                if( youtube_match && youtube_match[1].length == 11 )
                    return '<iframe src="//www.youtube.com/embed/' + youtube_match[1] + '" width="640" height="360" frameborder="0" allowfullscreen></iframe>';

                // vimeo - http://embedresponsively.com/
                var vimeo_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?vimeo\.com\/([0-9]+)$/ );
                if( vimeo_match )
					return '<iframe src="//player.vimeo.com/video/' + vimeo_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                // dailymotion - http://embedresponsively.com/
                var dailymotion_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?dailymotion\.com\/video\/([0-9a-z]+)$/ );
                if( dailymotion_match )
					return '<iframe src="//www.dailymotion.com/embed/video/' + dailymotion_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                // undefined -> create '<video/>' tag
            }
	})
	.change(function() {
		if( typeof console != 'undefined' )
                ;//console.log( 'change' );
        })
	.focus(function() {
		if( typeof console != 'undefined' )
                ;//console.log( 'focus' );
        })
	.blur(function() {
		if( typeof console != 'undefined' )
                ;//console.log( 'blur' );
        });
	});
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