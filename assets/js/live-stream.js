(function ($) {
        $(document).ready(function () { 
          var selected_channel = null;
          var tmp_el = null;  
          get_videos_list(); 
          function get_videos_list(){
            <?php 
            $uri =  $_SERVER["REQUEST_URI"];
            $uriArray = explode('?', $uri);  
            ?> 
            var request = $.ajax({
              url: "//demo.ikodes.net/tkdrms/demo.php?<?php echo $uriArray[1]; ?>",
              type: "POST",
              cache:true,
              dataType:"json",
            }); 
            request.done(function(msg) { 
               // $(".sport_category_wrap").html(msg.category);  // Get category list 
               $(".sport_channel_wrap").html(msg.chanel_list); 

            });
            request.fail(function(jqXHR, textStatus) {
              //alert( "Request failed: " + textStatus );
            });  
        }

          <?php 
          for ($i=1; $i <=$ch ; $i++) { 
        
          ?> 
                    channel_init("<?php echo $i; ?>");
          <?php 
          }
          ?> 
              
            
            function channel_init(num) {
                $("#player" + num + "_title").prepend('<img id="secure_img_"' + num + ' src="http://221.163.163.178:1935/sjp/live01/image.gif" width="0" height="0">');
                $(".player_title").html("JTBC");

                setTimeout(function () { 
                    var player = jwplayer("player" + num);
                    player.setup({
                        file: "http://www.pickcom.co.kr:1935/sjp/live01/playlist.m3u8?site=btmtv&ch=live01&pm=P",
                        width: "100%",
                                                aspectratio: "16:9",
                        autostart: true                                            }).on("ready", function () {
                        if ($(window.parent.document).find("#player").length !== 0) {
                            $(window.parent.document).find("#player")[0].height = document.body.scrollHeight;
                        }
                    });   
                    $("body").on("click",".ch" + num + "_select",function () {
                        $(".ch" + num + "_select").each(function () {
                            $(this).removeClass("active")
                        });
                        $(this).addClass("active");
                        if (tmp_el) tmp_el.find("img").attr("src", "stream-image/images/" + tmp_el.attr("data-title") + "_on.png");

                        tmp_el = $(this).closest("a");
                        var channel_num = $(this).attr("data-stream");
                        var channel_title = $(this).attr("data-title");
                        selected_channel = channel_title;
                        $(".player_title").html(channel_title);
                        $("#secure_img_1").remove();
                        $("#player" + num + "_title").prepend('<img id="secure_img_"' + num + ' src="http://221.163.163.178:1935/sjp/' + channel_num + '/image.gif" width="0" height="0">');
                        setTimeout(function () {
                            player.load([{
                                file: "http://www.pickcom.co.kr:1935/sjp/" + channel_num + "/playlist.m3u8?site=40tv&ch=" + channel_num + "&pm=P",
                            }]);
                            player.play();
                        }, 0);
                    });  

                }, 0)
            } 
            
            $(".live_channel_list_item").mouseover(function () {
                var $this = $(this).find("a");
                $(this).find("img").attr("src", "stream-image/images/" + $this.attr("data-title").toLowerCase() + ".png")
            }).mouseout(function () {
                var $this = $(this).find("a");
                if (selected_channel !== $this.attr("data-title")) {
                    $(this).find("img").attr("src", "stream-image/images/" + $this.attr("data-title").toLowerCase() + "_on.png")
                }
            })
            
        });
    })(jQuery);