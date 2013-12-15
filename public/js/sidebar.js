/********************************************************************************
 * File: sidebar.js
 * Author: PK
 * Date: 21/11/13 15:41
 *
 * Description: Respond to click events
 *
 ********************************************************************************/

/********************************************************************************
 *  FUNCTIONS
 *******************************************************************************/


/***********************************************
 *  cache loading images
 ***********************************************/
Image1= new Image();
Image1.src = "/img/ajax-circle.gif";
Image2= new Image();
Image2.src = "/img/ajax-loader.gif";


/***********************************************
 *  Play Video
 ***********************************************/
var nextVideo;
var prevVideo;
var thisVideo;
function playVideo(vid) {

    // cache selectors
    var video = $("#" + vid);
    var playlist = $("#playlist");
    var videoPlayer = jQuery(".video-wrapper");

    // find previous and next videos in playlist
    thisVideo = vid;
    nextVideo = video.parents('li').nextAll('li:first').find('.video').attr("id");
    prevVideo = video.parents('li').prevAll('li:first').find('.video').attr("id");

    if(typeof(nextVideo) === 'undefined') {
        nextVideo = video.parents('ul.concert').nextAll('ul.concert:first').find('.video').attr("id");
        if(typeof(nextVideo) === 'undefined') {
            nextVideo = playlist.find('.video').attr("id");
        }
    }

    if(typeof(prevVideo) === 'undefined') {
        prevVideo = video.parents('ul.concert').prevAll('ul.concert:first').find('.video:last').attr("id");
        if(typeof(prevVideo) === 'undefined') {
            prevVideo = playlist.find('.video').attr("id");
        }
    }

    // highlight video in sidebar & display video owner
    playlist.find('.active').removeClass("active");
    video.addClass("active");
    video.parents('ul.concert').find('.concertlink').addClass("active");
    $("#videoinfo").load("ajax/getvideoinfo.php",{ id: vid, token: token });

    // Play Video
    if(typeof(videoPlayer.tubeplayer("player")) !== 'undefined') {
        videoPlayer.tubeplayer("play", vid);
    }
    else {
        // clear page
        $(".video-wrapper").html("");

        // create video player
        videoPlayer.tubeplayer({
            width: 1280, // the width of the player
            height: 720, // the height of the player
            allowFullScreen: "true", // true by default, allow user to go full screen
            initialVideo: vid + "?vq=hd720&autoplay=1&", // the video that is loaded into the player
            preferredQuality: "hd720",// preferred quality: default, small, medium, large, hd720
            iframed: "true",
            autoPlay: "true",
            modestbranding: "false",
            onPlay: function(id){}, // after the play method is called
            onPause: function(){}, // after the pause method is called
            onPlayerEnded: function(){
                playVideo(nextVideo);
            },
            onStop: function(){}, // after the player is stopped
            onSeek: function(time){}, // after the video has been seeked to a defined point
            onMute: function(){}, // after the player is muted
            onUnMute: function(){} // after the player is unmuted
        });
    }
}


/***********************************************
 *  Set Results Loading Bar
 ***********************************************/
function setResultBar(num,list) {

    $("#loading").html('<div class="row"><div class="col-xs-10 loading"><b>'+num+'</b> Videos Sorted By '+list+'</div><div class="col-xs-2"><span id="sort" list="'+list+'" class="glyphicon glyphicon-retweet"></span></div></div><b>');

}


/***********************************************
 *  Set Song & Concert Lists
 ***********************************************/
var token;
function setLists() {

    $.post( "ajax/setlists.php", {  token: token })
        .done(function( data ) {
            if(data == "1") {
                setConcert(0);
            }
            else {
                $("#loading").html('No Concerts Found In Database');
            }
        });
}


/***********************************************
 *  Set Photos
 ***********************************************/
function setPhoto(url) {
    $(".search-query").css('background', '#fff url("' + url + '") no-repeat 1px 1px')
        .css('background-size', '30px 30px');
}

function getPhoto() {

    $.post( "ajax/setphoto.php", {  token: token })
        .done(function( data ) {
            setPhoto(data);
        });
}


/***********************************************
 *  Set Concert
 ***********************************************/
var videoNum;
function setConcert(row) {

    $.post( "ajax/setconcert.php", {  token: token, row: row })
        .done(function( data ) {
            var html = data.split('|');
            if($.isNumeric(html[1])) {
                videoNum = html[1];
                setResultBar(videoNum,"Date");
            }
            else {
                row++;
                setConcert(row);
                $("#playlist").append(html[1]);
                $("#loading").html('<img src="img/ajax-loader.gif"> &nbsp; Searching For Videos... ('+html[0]+'%)');
            }
        });
}

/***********************************************
 *  Reset Playlist
 ***********************************************/
function resetPlaylist() {

    var playlist = $("#playlist");
    var videoPlayer = jQuery(".video-wrapper");

    playlist.find('.active').removeClass("active");
    $(".search").finish();
    videoPlayer.tubeplayer("destroy");
    $("#videoinfo").html("");

    thisVideo = null;
    nextVideo = null;
    prevVideo = null;

}


/***********************************************
 *  Abort Ajax Requests
 ***********************************************/
$.xhrPool = [];
$.xhrPool.abortAll = function() {
    $(this).each(function(idx, jqXHR) {
        jqXHR.abort();
    });
    $.xhrPool.length = 0
};

$.ajaxSetup({
    beforeSend: function(jqXHR) {
        $.xhrPool.push(jqXHR);
    },
    complete: function(jqXHR) {
        var index = $.xhrPool.indexOf(jqXHR);
        if (index > -1) {
            $.xhrPool.splice(index, 1);
        }
    }
});


/********************************************************************************
 *  CLICK EVENTS
 *******************************************************************************/

$(document).ready(function() {

    /***********************************************
     *  Collapse/Expand Sidebar
     ***********************************************/
    var $in = false;
    $(".sidebar-toggle").click(function() {
        if($in)
        {
            $in = false;
            $(".sidebar-toggle").animate({left: "+=280"}, 500);
            $(".logo").addClass("rotate").css("top","0px");
            $(".container").removeClass("container-full");
        }
        else
        {
            $in = true;
            $( ".sidebar-toggle" ).animate({left: "-=280"}, 500);
            $(".logo").removeClass("rotate").css("top","-7px");
            $(".container").addClass("container-full");
        }
        $( ".sidebar-wrapper" ).toggle( "slide" );
    });


    /***********************************************
     *  Search for Artist
     ***********************************************/
    token = $("#message").attr("token");
    $("#search").submit(function(event) {
        event.preventDefault();
        var input = $('input[name="artist"]');

        if($.trim(input.val()) != '') {
            $.xhrPool.abortAll();
            resetPlaylist();
            setPhoto("img/user.png");
            $("#playlist").html("");
            $("#loading").html('<img src="img/ajax-loader.gif"> &nbsp; Searching For Artist...');

            $.post("ajax/setartist.php", {  artist: input.val(), token: token })
                .done(function( data ) {
                    getPhoto();
                    if(data > 0) {
                        $("#loading").html('<img src="img/ajax-loader.gif"> &nbsp; Searching For Concerts...');
                        setLists();
                    }
                    else {
                        $("#loading").html('No Artist Found, Please Check Spelling');
                    }
                });
        }

    });

    // stop animations
    $(document).on("click", "#searchText", function() {
        $(".search").finish();
    });

    $("#searchText").change(function() {
        $(".search").finish();
    });


    /***********************************************
     *  Login/Register forms
     ***********************************************/
     $(document).on('submit','.userform',function(event) {

         event.preventDefault();
         var button = $('button[name="form"]');

         button.prop("disabled",true);
         $.post("ajax/auth.php",{ email: $('input[name="email"]').val(), password: $('input[name="password"]').val(), form: button.attr("value")})
             .done(function(data) {
                 if(data == "1") {
                     window.location.replace("/");
                 }
                 else
                 {
                     $("#message").html(data)
                 }
             });
         setTimeout(function() { button.prop("disabled",false); }, 1000);

     });


    /***********************************************
     *  Sort Playlist
     ***********************************************/
    $(document).on("click", "#sort", function(){

        var list = "Date";

        if($("#sort").attr("list") == "Date") { list = "Song";}

        $("#playlist").html('<div class="loading-circle center"><img src="img/ajax-circle.gif"></div>')
                      .load("ajax/sortconcerts.php",{ token: token,  list: list}, function() {
                        if(thisVideo != null) {
                            playVideo(thisVideo);
                        }
                        setResultBar(videoNum,list);
                      });
    });

    /***********************************************
     *  Add/Remove Favorites
     ***********************************************/
    $(document).on("click", ".fav", function() {
        $(this).html('<img src="img/ajax-circle.gif" width="25px">');
        $(this).load("ajax/setfavorite.php",{ token: token, vid: $(this).attr("vid") });
    });


    /***********************************************
     *  Next/Previous Video
     ***********************************************/
    $(document).on("click", ".prev", function() {
        playVideo(prevVideo);
    });

    $(document).on("click", ".next", function() {
        playVideo(nextVideo);
    });

    $(document).on("click", ".video", function() {
        playVideo($(this).attr("id"));
        $(".search").finish();
    });

    /***********************************************
     *  Get Page
     ***********************************************/
    $(document).on("click", ".menu", function() {

        // stop animation & end player
        resetPlaylist();

        $(".video-wrapper").load("ajax/getpage.php",{ page: $(this).text() },function() {
             $("#page").fadeIn(250);
        });
    });

    /***********************************************
     *  Get Favorites
     ***********************************************/
    $("#playlist").load("ajax/getfavorites.php", { token : token });

    $(document).on("click", ".glyphicon-refresh", function() {
        if(thisVideo != null) {
            playVideo(thisVideo);
        }

        $("#playlist").load("ajax/getfavorites.php", { token : token });
    });


});


/********************************************************************************
 *  Load Animations
 *******************************************************************************/
$(window).load(function() {
        $( "#box1" ).delay(0).fadeIn( 2000);
        $( "#box2" ).delay(1500).fadeIn( 2000);
        $( "#box3" ).delay(3000).fadeIn( 2000);
        $( ".search" ).delay(4000).animate({backgroundColor: "rgb(255, 0, 0, 0.75)"},1000)
                      .delay(0).animate({backgroundColor: "rgb(102, 102, 102)"},1000);
});