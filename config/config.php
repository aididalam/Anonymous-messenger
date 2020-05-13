<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
require_once 'db.php';
define('DB_HOST', $DB_HOST);
define('DB_USERNAME', $DB_USERNAME);
define('DB_PASSWORD', $DB_PASSWORD);
define('DB_NAME', $DB_NAME);
define('DB_USER_TBL', 'users');
// Facebook API configuration
define('FB_APP_ID', $app_id);
define('FB_APP_SECRET', $app_secret);
define('FB_REDIRECT_URL', $siteurl);

// Start session
if(!session_id()){
    session_start();
}

// Include the autoloader provided in the SDK
require_once __DIR__ . '/Facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Call Facebook API
$fb = new Facebook(array(
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v3.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
          $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}