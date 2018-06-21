$(document).ready(function(){
	$.ajax({
        url: "ajax/hide-show-level.php", // link of your "whatever" php
        type: "POST",
        data: 'parentid='+1, // all data will be passed here
        success: function(data){ 
        	//alert(data);
        	var _ress = data.split('@@');
        	if(_ress[0] == 4 || _ress[0] == 2){
        		$('.level-up').hide();
        	}
        	//if(_ress[1] > 0){
        		$('.start-discussion a').attr('data-check', _ress[1]);
        		$('.start-discussion a').attr('data-gid', _ress[0]);
        		$('.level-up a').attr('data-check', _ress[1]);
        	//}
        }
    });
});
$(document).ready(function(){

	// forum Details page
	// coment and replies slide up and down
	$('.replies').click(function(){
		var _dI = $(this).data('id'); //data Id
		var _dPI = $(this).data('parentid'); //data parent Id
		var _dCI = $(this).data('child'); //data child 
		if(_dCI == 1){
			$(this).find('i').toggleClass( "fa-chevron-down fa-chevron-up");
			$(this).parents('.Post.undefined.CommentPost').siblings('.post-comment-'+_dPI+'-'+_dI).slideToggle();
			//$('.post-comment-'+_dPI+'-'+_dI).slideToggle();
		}else if (_dCI == 2){
			$(this).find('i').toggleClass( "fa-chevron-down fa-chevron-up");
			$(this).parents('.Post.undefined.ReplyPost').siblings('.post-comment-comment-'+_dPI+'-'+_dI).slideToggle();
			//$('.post-comment-comment-'+_dPI+'-'+_dI).slideToggle();
		}
	});

	// like and dsilike lists
	$('.like-dislike-count').click(function(){
		var _cAt = $(this).data('cat');
		$('#likeDislikeModal').find('.modal-title').text(_cAt);
	});

	//text editor
	$('.text-area-container-parent').width($('.betting-forum-details-list-main').width());
	$('#removeEditorContainer').click(function(){
		$(this).parents('.text-area-container-parent').hide();
	});
	$('.open-reply-editor').click(function(){
		if($(this).data('check') > 0){
			$('#topicResponseIndex').val($(this).data('index'));
			$('#topicParentId').val($(this).data('parentid'));
			$('.text-area-container-parent').show();
		}else{
			alert("로그인 후, 댓글을 남기실 수 있습니다.");
		}
	});




	// list page
	$('.text-area-container-parent-list').width($('.forum-list-container').width());

	//start discussion 
	$('.start-discussion a').click(function(){
		if($(this).data('check') > 0){
			if($(this).data('gid') == 2 || $(this).data('gid') == 4 || $(this).data('gid') == 0){
				$('.text-area-container-parent-list').show();
			}else{
				alert("글을 등록하기 위해선 등업 신청을 해주세요.");
				$('.arrow1').show();
				setTimeout(function(){ $('.arrow1').fadeOut() }, 4000);
			}
		}else{
			alert("로그인 후, 글 작성이 가능합니다.");
		}
	});
	
	$('#removeEditorContainerlist').click(function(){
		$(this).parents('.text-area-container-parent-list').hide();
	});

	//level up
	$('.level-up a').click(function(){
		var _ck = $(this).data('check');
		if(_ck > 0){
			var _retVal = prompt("배팅타임을 통해 가입하신 배팅사이트의 이름과 아이디를 남겨주세요. * 타 유저는 등업이 되지 않습니다. : ", "");
			if(_retVal == null || _retVal == ''){
				alert("아무 것도 입력되지 않았습니다. 다시 확인해주세요.");
	        }else{
	        	$.ajax({
		            url: "ajax/level-up.php", // link of your "whatever" php
		            type: "POST",
		            //async: true,
		            //cache: false,
		            data: 'id='+_ck+'&msg='+_retVal, // all data will be passed here
		            success: function(data){  
		                alert(data);
		                //location.reload();
		            }
		        });
	        }
		}else{
			alert("로그인 후, 등업 신청이 가능합니다.");
		}
	});



	// $('.topicFiles').on('change', function(e){
	// 	var files = e.target.files;
	// 	$.each(files, function(i, file){
	// 		var reader = new FileReader();
	// 		reader.readAsDataURL(file);
	// 		reader.onload = function(e){
	// 			var template = '<li>'+
	// 							'<a href="#">'+
	// 							'<img src="'+e.target.result+'" alt="">'+
	// 							'</a>'+
	// 							'<button type="button" class="btn btn-danger btn-xs btn-del-img delImg">'+
	// 							'<i class="fa fa-times-circle" aria-hidden="true"></i>'+
	// 							'</button>'+
	// 							'</li>';
				
	// 			$('.forum-image-container ul').append(template);
	// 		};
	// 	});
	// 	$('.forum-image-container').show();
	// 	$('.forum-editor').css("padding-top","140px");
	// });


	

    //$('.popover-visible-trigger').popover('show').off('click');

	$('.delImg').click(function(){
		$(this).parents('li').remove();
	});

	$('.btn-forum-add-image').click(function(){
		var _list = '<li>'+
						'<label class="fileContainer">'+
						    '<i class="fa fa-picture-o" aria-hidden="true"></i>'+
						    '<span class="show-image-name"></span>'+
						    '<input type="file" name="topicFiles[]" class="topicFiles" />'+
						'</label>'+
	    			'</li>';
		$('.forum-discussion-image-uploadlist').append(_list);
		if($('.fileContainer').length > 1){
			$('.btn-forum-remove-image').show();
		}
	});

	$('.fileContainer').find('input').change(function(e){ //alert('woking');
        var fileName = e.target.files[0].name;
        //alert('The file "' + fileName +  '" has been selected.');
        $(this).siblings('.show-image-name').show();
        $(this).siblings('.show-image-name').text(fileName);
        

    });

	$('.btn-forum-remove-image').click(function(){
		$('.fileContainer').last().remove();
		if($('.fileContainer').length < 2){
			$('.btn-forum-remove-image').hide();
		}
	});


	$('.btn-details-add-image').click(function(){
		var _list = '<li>'+
						'<label class="fileContainer">'+
						    '<i class="fa fa-picture-o" aria-hidden="true"></i>'+
						    '<input type="file" name="topicResponseFiles[]" id="topicFiles" />'+
						'</label>'+
	    			'</li>';
		$('.forum-details-image-uploadlist').append(_list);
		if($('.fileContainer').length > 1){
			$('.btn-details-remove-image').show();
		}
	});
	$('.btn-details-remove-image').click(function(){
		$('.fileContainer').last().remove();
		if($('.fileContainer').length < 2){
			$('.btn-details-remove-image').hide();
		}
	});


	//like dislike change
	$('.likedislikeclick').click(function(){
		var _tx = $(this).parents('.btn-group').find('.like-dislike-count .badge');
        var _ntx = parseInt($(_tx).text()) + 1;
        var _whenfirstlikedislike = $(this).parents('.Post').find('.when-no-like');

		var _pID = $(this).data('parentid');
		var _tID = $(this).data('topicueid');
		var _rUN = $(this).data('enabled');
		var _sTATE = $(this).data('state');
		if(_rUN == 0 && _sTATE == 1){
			alert('Please login first to like this post');
		}else if(_rUN == 0 && _sTATE == 0){
			alert('Please login first to dislike this post');
		}else{
			//alert('free to like or dislike');
			$.ajax({
	            url: "ajax/commentlikedislike.php", // link of your "whatever" php
	            type: "POST",
	            data: 'parentid='+_pID+'&topicueid='+_tID+'&state='+_sTATE+'&id='+_rUN, // all data will be passed here
	            success: function(data){ 
	                var _res = data.split('@@');
	                alert(_res[0]);
	                if(_res[1] == 1){
	                	$(_tx).text(_ntx);
	                }
	                if(_ntx == 1 && _sTATE == 1){
	                	$(_whenfirstlikedislike).text('좋아요를 누르셨습니다.');
	                }else if(_ntx == 1 && _sTATE == 0){
	                	$(_whenfirstlikedislike).text('싫어요를 누르셨습니다.');
	                }
	            }
	        });
		}
	});

	var _ldbody = '<img src="images/loading.gif" alt="" class="img-responsive" /><img src="images/loading.gif" alt="" class="img-responsive" /> <img src="images/loading.gif" alt="" class="img-responsive" />'
	$('.like-dislike-count').click(function(){
		var _pID = $(this).data('parentid');
		var _tID = $(this).data('topicueid');
		var _cID = $(this).data('cat');
		//alert('free to like or dislike');
		$.ajax({
            url: "ajax/showlikedislike.php", // link of your "whatever" php
            type: "POST",
            data: 'parentid='+_pID+'&topicueid='+_tID+'&cat='+_cID, // all data will be passed here
            success: function(data){ 
            	$(".likeDISLIKEbODY").html(_ldbody);
                setTimeout(function(){ $('.likeDISLIKEbODY').html(data) }, 4000);
                //alert(data);
            }
        });
	});
	// $("#likeDislikeModal").on("hidden.bs.modal", function(){ //alert('working');
	//     $(".likeDISLIKEbODY").html(_ldbody);
	// });


	// spam 

	$('.spam-check').click(function(){
		var _sValue = $(this).find('.badge');
		var _spamV = parseInt($(_sValue).text()) + 1;

		var _psID = $(this).data('parentid');
		var _tsID = $(this).data('topicueid');
		var _rsUN = $(this).data('check');
		if(_rsUN > 0){
			$.ajax({
	            url: "ajax/spam.php", // link of your "whatever" php
	            type: "POST",
	            //async: true,
	            //cache: false,
	            data: 'parentid='+_psID+'&topicueid='+_tsID+'&id='+_rsUN, // all data will be passed here
	            success: function(data){
	                var _resp = data.split('@@');
	                alert(_resp[0]);
	                if(_resp[1] == 1){
	                	$(_sValue).text(_spamV);
	                }
	            }
	        });
		}else{
	        alert('해당 글을 신고하기 위해선 먼저 로그인을 해주세요.');
		}
	});


	//edit

	$('.delete-post').click(function(){ 
		var x = confirm("정말 삭제하길 원하시나요?");
      	if (x){
			var _pdID = $(this).data('parentid');
			var _tdID = $(this).data('topicueid');
			var _rdUN = $(this).data('check');
			var _dID = $(this).data('id');
			if(_rdUN == 1){
				//alert('free to like or dislike');
				$.ajax({
		            url: "ajax/delete-post-forum.php", // link of your "whatever" php
		            type: "POST",
		            //dataType: "json",
		            //async: true,
		            //cache: false,
		            data: 'parentid='+_pdID+'&id='+_dID, // all data will be passed here
		            success: function(data){ 
		            	var _resd = data.split('@@');
		                alert(_resd[0]);
		                if(_resd[1] == 0){
		                	window.location.replace("https://www.thebettingtime.com/forum.php");
		                }else{
		                	location.reload();
		                }
		                
		            }
		        });
			}else{
		        alert('당신은 관리자가 아닙니다.');
			}
		}else{
	        return false;
		//}
	    }
	});

	$('.stick-post').click(function(){ 
		var x = confirm("정말 해당 글을 고정하실건가요?");
      	if (x){
			var _pdID = $(this).data('parentid');
			var _tdID = $(this).data('topicueid');
			var _rdUN = $(this).data('check');
			var _dID = $(this).data('id');
			if(_rdUN == 1){
				//alert('free to like or dislike');
				$.ajax({
		            url: "ajax/stick-post-forum.php", // link of your "whatever" php
		            type: "POST",
		            //dataType: "json",
		            //async: true,
		            //cache: false,
		            data: 'parentid='+_pdID+'&id='+_dID, // all data will be passed here
		            success: function(data){ 
		            	var _resd = data.split('@@');
		                alert(_resd[0]);
		                if(_resd[1] == 0){
		                	location.reload();
		                }else{
		                	location.reload();
		                }
		                
		            }
		        });
			}else{
		        alert('당신은 관리자가 아닙니다.');
			}
		}else{
	        return false;
		//}
	    }
	});

	$('.unstick-post').click(function(){ 
		var x = confirm("정말 해당 글을 고정취소 하실건가요?");
      	if (x){
			var _pdID = $(this).data('parentid');
			var _tdID = $(this).data('topicueid');
			var _rdUN = $(this).data('check');
			var _dID = $(this).data('id');
			if(_rdUN == 1){
				//alert('free to like or dislike');
				$.ajax({
		            url: "ajax/unstick-post-forum.php", // link of your "whatever" php
		            type: "POST",
		            //dataType: "json",
		            //async: true,
		            //cache: false,
		            data: 'parentid='+_pdID+'&id='+_dID, // all data will be passed here
		            success: function(data){ 
		            	var _resd = data.split('@@');
		                alert(_resd[0]);
		                if(_resd[1] == 0){
		                	location.reload();
		                }else{
		                	location.reload();
		                }
		                
		            }
		        });
			}else{
		        alert('당신은 관리자가 아닙니다.');
			}
		}else{
	        return false;
		//}
	    }
	});

	// level-up button hide

	

	// fancybox gallery

	//$('[data-fancybox]').fancybox({
	//  protect: true,
	//  buttons : [
	//    'zoom',
	//    'thumbs',
	//    "share",
     //   //"slideShow",
     //   "fullScreen",
     //   //"download"
	//    'close'
	//  ]
	//});


	//$('[data-fancybox="watermark"]').fancybox({
	//  protect    : true,
	//  slideClass : 'watermark',
	//  toolbar    : false,
	//  smallBtn   : true
	//});

	// Preload watermark image
	// Please, use your own image
	(new Image()).src = "https://fancyapps.com/GJbkSPU.png";

	var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }

    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

});