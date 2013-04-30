<?php
 
    /*require_once("facebook.php");
    
    $config = array();
    $config['appId'] = '134240710093824';
    $config['secret'] = '2098ddbb1f0029aba8fcd4cbbe09b44c';
    $config['cookie'] = true;
    $config['fileUpload'] = false; // optional

    $facebook = new Facebook($config);
    $signed_request = $facebook->getSignedRequest();
    $access_token = $facebook->getAccessToken();
    
    $page_id = '505165066';
    $fanpage_id = '261622440537988';
    $fb_user_id = $facebook->getUser();

    if(is_null($facebook-getUser())) {
        $params = array(
            'req_perms' => 'user_status, publish_stream, user_photos'
        );
        header("Location:{$facebook-getLoginURL($params)}");
        exit;
    }
    */
    # $feed_array = array(
    #     'message' => "Hello world!"
    # );
    # $page_post = $facebook->api("/$fanpage_id/feed","post",$feed_array);
   #error_reporting(E_ALL);
?>

<!-- Facebook SDK -->
	<div id="fb-root"></div>
	<script src="//connect.facebook.net/en_US/all.js"></script>

	<script>
(function ($){
    var page_id = '505165066'; //505165066
    var fanpage_id = '261622440537988';
    var app_id = '134240710093824';
    var app_secret = '2098ddbb1f0029aba8fcd4cbbe09b44c';
    var uid, accessTokenVar;
    // Additional JS functions here

    window.fbLoginStatus = function () {
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                $('.fbLogin').hide();
                $('.fbLogout').show();
                uid = response.authResponse.userID;
                accessTokenVar = response.authResponse.accessToken;

                $('#accessToken').val(accessTokenVar);
                console.log('user id: ' + uid);
                console.log('access token : ' + accessTokenVar);

                testAPI();
                console.log("connected");
            } else if (response.status === 'not_authorized') {
                //$('.fbLogin').show();
                //$('.fbLogout').hide();

                //testAPI();
                console.log("not_authorized");
            } else {
                $('.fbLogin').show();
                $('.fbLogout').hide();

                //testAPI();
                console.log("not_logged_in");
            }
        });
    };

    window.fbAsyncInit = function () {
        FB.init({
            appId: '134240710093824', // App ID
            channelUrl: '//bg-brits2013-priceless-remakes.appspot.com/channel.html', // Channel File
            frictionlessRequests: true,
            init: true,
            level: 'debug',
            signedRequest: null,
            status: true, // check login status
            trace: false,
            viewMode: 'website',
            autoRun: true,
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });

        // Additional init code here
        /*FB.Event.subscribe('auth.login', function(response){
            window.location.reload();
        });*/
        //testAPI();
        fbLoginStatus();
        
    };

    window.fbDoLogin = function () {
        FB.login(function (response) {
            if (response.authResponse) {
                //accessTokenVar = response.authResponse.accessToken;
                // console.log("connected");
                //testAPI();
                $('#facebook-friends-temp').hide();
            } else {
               // console.log("cancelled");
            }
        }, { scope: "manage_pages, publish_stream, publish_actions, offline_access, read_stream, status_update, photo_upload, share_item, create_note, video_upload, read_requests" });
        
        setTimeout(function(){ fbLoginStatus(); }, 5000);
    };
    //publish_stream, publish_actions, email

    window.fbDoLogout = function() {
        FB.logout(function(response) {
            if(response.authReponse) {
                //var accessTokenVar = response.authResponse.accessToken;
            } else {

            }
            // user is now logged out
            //var accessTokenVar = response.authResponse.accessToken;
            //console.log(response);
        });

         setTimeout(function(){ fbLoginStatus(); }, 2000);
    };

    var include = function (arr, obj) {
        //for(var i=0; i<arr.length; i++) {
            if (arr == obj) {
                console.log('true');
                return true;
            } else {
                console.log('false');
                return false;
            }
        //}
    };

    window.addAsFriend = function () {
        FB.api('/me/friends', function(response){
            var oftb;
            var page_id = '505165066';
            $.each(response.data, function(index, value) {
                oftb = include(value.id, page_id);
                console.log('oftb: ' + oftb);
                // console.log(value.id);
            }); 
                if(oftb) {
                    // request friendship
                    alert('You are already friends');
                    return false;
                } else {
                    // you are already friends
                   
                    FB.ui({ method: 'friends.add', id: page_id });
                   
                }
        });
        FB.api('/' + page_id + '/?fields=friendrequests', function(response){

        });
    };

    window.checkDoesLike = function () {
        FB.api({ method: 'pages.isFan', page_id: page_id}, function(resp) {
            if(resp) {
                console.log('you like the application');
            } else {
                console.log('you don\'t like the application');
            }
        });
    };

    window.loadFriends = function () {
        FB.api('/' + page_id + '/friends?fields=name,link', function (response) {
            $("#loadingFriends, #facebook-friends-temp").hide();
            var divContainer = $('#facebook-friends-perm');

            var startCount = (response.data.length - 24) ? response.data.length - 24 : 0; 
            var inCount = response.data.length;

            for (i = startCount; i < inCount; i++) { 
                $("<div class=\"friendWrap\"><a class=\"friend\" href=\"#\"><img /></a><div class=\"friend-detail-wrap\"><a href=\"#\" class=\"friend-detail\">" + response.data[i].name +"</a></div></div>")
	  	    .find(".friend")
            .attr({
	  	        id: response.data[i].id,
	  	        href: response.data[i].link
	  	    })
            .end()
	  	    .find(".friend img")
	          .attr({
	              src: 'https://graph.facebook.com/' + response.data[i].id + '/picture?width=64&height=64',
	              alt: response.data[i].name,
	              title: response.data[i].name
	              //onClick: 'alert("You selected "+this.title); return false;'
	          })
	        .end()
	        .appendTo(divContainer);
            }
        });
    };

    window.postToWallUsingFBApi = function (thisPostID) {
        function onPostToWallCompleted(response) {
            if (response) {
                if (response.error) {
                    document.getElementById("txtEcho").innerHTML=response.error.message;
                    alert('response error: ' + response.error.message);
                } 
                else {
                    if (response.id) {
                        document.getElementById("txtEcho").innerHTML="Posted as post_id "+response.id;
                        alert('posted as post_id: ' + response.id);
                    } 
                    else if (response.post_id) {
                        document.getElementById("txtEcho").innerHTML="Posted as post_id "+response.post_id;
                        alert('Posted as post_id: ' + response.post_id);
                    } 
                    else {
                        document.getElementById("txtEcho").innerHTML="Unknown Error";
                        alert('Unknown Error');
                    }
                }
            }
        }

        var msgVal = $('.textareaFB').val();

        var data = {
            //caption: 'This is my wall post example',
            message: msgVal//'Post another message through fbapi'
        }

        var dataUser = {
            message: msgVal//'Message from user'
            //access_token: accessTokenVar
            //from: uid
        }

        console.log('user id on click: ' + uid);
        console.log('access token on click: ' + accessTokenVar);

        //var thispostid = '261622440537988_574925632540999';
        //var thispostidtwo = '261622440537988_576487609051468';
        
        //FB.api('/'+ fanpage_id +'/feed', 'post', data, onPostToWallCompleted);
        FB.api('/' + thisPostID + '/comments?access_token=' + accessTokenVar + '', 'POST', dataUser, onPostToWallCompleted);

        //http://www.fbrell.com/xfbml/fb:share-button
        //https://developers.facebook.com/bugs/409281805774218/
        //http://stackoverflow.com/questions/14792062/posting-to-friends-wall-with-graph-api-via-feed-connection-failing-since-feb
        //http://stackoverflow.com/questions/13829086/oauthexception-when-trying-to-post-to-friends-wall
        //https://developers.facebook.com/roadmap/#february-2013
        //http://stackoverflow.com/questions/14056046/feed-story-publishing-to-other-users-is-disabled-for-this-application


    };

    window.loadPosts = function () {
    	FB.api('/'+fanpage_id+'/posts', function(response) {
            $('#loadingComments').hide();
            $('#loading-posts').show();
    		var divContainer = $('#loading-posts');

            // Posts & Comments
            $.each(response.data, function(index, value) {
                // console.log('from id: ' + value.from.id);
                // console.log('privacy description: ' + value.privacy.description);
                // console.log('story: ' + value.story);
                    
                // $.each(value.actions, function(index, valueA){
                    // console.log('action name: ' + valueA.name + ' action link: ' + valueA.link);
                //});
                var x = $.inArray("message", value);
                //console.log(x);

                if(value.message && value.picture) {
                    var pcWrap = $('.pcWrap'); //onclick='javascript:postToWallUsingFBApi(thisPostID);'
                    var thisPostID = value.id; //<form><textarea class='textareaFB' data-id='" + thisPostID + "'></textarea><br><input class='postToWall' type='submit' id='" + thisPostID + "' value='comment' name='comment' id="+ value.object_id +"/></form>
                    $("<div class='pcWrap'><div class='postWrapper'><a class='posts' href='#'><img class='post-img'/></a><p>" + value.message + "</p></div><div class='commentsWrapper'></div></div>")
                        .attr({
                            id: value.id,
                            name: value.from.name
                        })
                        .find("img.post-img")
                        .attr({
                            src: value.picture+'?width=64&height=64',
                            alt: value.from.name
                        })
                        .end()
                        .appendTo(divContainer);
                    
                    console.log('value id is: ' + thisPostID);   

                    if(typeof value.comments !=='undefined') {

                        $.each(value.comments.data, function(index, valueB){
                            var date = new Date(valueB.created_time);
                            var day = date.getDate();
                            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
                            var month = date.getMonth();
                            var hours = date.getUTCHours();
                            var minutes = date.getUTCMinutes();

                           $("<div><a class='comments' href='#'><img class='comment-img'/></a><p>" + valueB.message + "</p><span class='time'>" + day + " " + monthNames[month] + " at " + hours + ":" + minutes + "</span><span class='like'></span></div>")
                            .attr({
                                id: valueB.id,//from.id,
                                name: valueB.from.name
                            })
                            .find("img.comment-img")
                            .attr({
                                src: 'https://graph.facebook.com/' + valueB.from.id + '/picture?width=64&height=64',
                                alt: valueB.from.name
                            })
                            .end()
                            .appendTo($('.commentsWrapper'));
                        });
                    }
                   
                    //$('.pcWrap').prepend(postW);
                    //div.appendChild(postW);
                    //div.appendChild(commentsW);
                    //div.appendTo(divContainer);

                }
                       
            }); // End loop
    	}); // End FB.api - posts

        /*function containsAll(needles, haystack){ 
          for(var i = 0 , len = needles.length; i < len; i++){
             if($.inArray(needles[i], haystack) == -1) return false;
          }
          return true;
        }

        function checkComments () {
            for(var i = 0, len=needles.length; i < len; i+=1) {}
        }*/
    }; // end window.load.post.function

    window.testAPI = function () {
        //addAsFriend();
        /*FB.api('/' + page_id, function (response) {
            if (response) {
                $("#name").val(response.first_name + " " + response.last_name);
                $("#email").val(response.email);
            }
        });*/

        loadFriends();
        loadPosts();
    };

    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    } (document));
}(jQuery));
</script>	
