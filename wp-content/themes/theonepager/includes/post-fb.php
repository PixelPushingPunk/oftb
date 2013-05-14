<?php
 
   require_once("facebook.php");
    
    $config = array();
    $config['appId'] = '134240710093824';
    $config['secret'] = '2098ddbb1f0029aba8fcd4cbbe09b44c';
    $config['cookie'] = true;
    $config['fileUpload'] = false; // optional

    $facebook = new Facebook($config);
    $signed_request = $facebook->getSignedRequest();
    $access_token = $facebook->getAccessToken();
    #$fb_user_id = $facebook->getUser();
    $posts = $facebook->api('/261622440537988/posts','GET'); 

    $jsonEncodePosts = json_encode($posts);
    $page_id = '505165066';
    $fanpage_id = '261622440537988';
    

    echo "$jsonEncodePosts";
?>