<?php

require_once 'config/linebreaks4imagettftext.php';
require_once 'config/db.php';



if(isset($_POST['submitMsg'])){


    $t=time();
    $img = imagecreatefromjpeg('src/img/f/blue-grey.jpg');

    $text = $_POST['msg'];    
    $name = $_POST['name'];    
    $id= $_SESSION['userData']['oauth_uid'];

    //$text=substr($text,0,199); 
    
    $char_count=strlen ($text);
    //echo $char_count;

    if($char_count>800){
        $fontSize=14.5;
    }else if($char_count<=800 && $char_count>600){
        $fontSize=16;
    }else if($char_count<=600 && $char_count>400){
        $fontSize=19;
    }else if($char_count<=400 && $char_count>200){
        $fontSize=22;
    }else if($char_count<=200 && $char_count>100){
        $fontSize=26;
    }else if($char_count<=100 && $char_count>50){
        $fontSize=28;
    }else if($char_count<=50){
        $fontSize=30;
    }


    $white = imagecolorallocate($img, 255, 255, 170);
    $font = dirname(__FILE__) . '/src/font/unicode.ttf'; 
    
    
    // THE IMAGE SIZE
    $width = imagesx($img)-140;
    $height = imagesy($img);
    
    $text = \andrewgjohnson\linebreaks4imagettftext($fontSize, 0, $font, $text, $width);
    
    $hgt=1+substr_count( $text, "\n" );;
    
    // THE TEXT SIZE
    $text_size = imagettfbbox($fontSize, 0, $font, $text);
    $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
    $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);
    
    // CENTERING THE TEXT BLOCK
    $centerX = CEIL(($width - $text_width) / 2);
    $centerX = $centerX<0 ? 0 : $centerX;
    $centerY = CEIL(($height - $text_height) / 2);
    //$centerY = $centerY<0 ? 0 : $centerY;

    $centerY=$height/2;
    imagefttext($img, $fontSize, 0, $centerX+70, $centerY-($fontSize/2)*$hgt, $white, $font, $text);
    
    
    // OUTPUT IMAGE
    imagejpeg($img,'src/img/'.$id.$t.'ogshare.jpg',100);
    imagedestroy($img);

    $title=$name;
    $ogimage=$siteurl.'/src/img/'.$id.$t.'ogshare.jpg';
    $rand=generateRandomString(10);

    require_once 'layout/header.php';
    require_once 'layout/footer.php';
    
    $toupdate='/src/img/'.$id.$t.'ogshare.jpg';
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $sql = "UPDATE users SET ogimg='$toupdate' WHERE oauth_uid=$id";
    $conn->query($sql);
    $conn->close();
    
    $urlToShare="https://www.facebook.com/dialog/share?app_id=692992438123358&display=popup&href=";
    
    $urlToShare=$urlToShare.$siteurl."/profile.php?id=".$id."&cdvcog=".$rand."&redirect_uri=".$siteurl;
    //header("Location: $urlToShare");   

    $urlFb=$siteurl."/profile.php?id=".$id."&cdvcog=".$rand;
    
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE message SET seen='1' WHERE id=$_POST[msgID]";
    
    if ($conn->query($sql) === TRUE) {
       // echo "Record updated successfully";
    } else {
       // echo "Error updating record: " . $conn->error;
    }
    $conn->close();


    require_once 'layout/expand_1.php';


}else if(isset($_POST['submitImg'])){
    $t=time();

    $text = $_POST['msg'];    
    $name = $_POST['name'];    
    $id= $_SESSION['userData']['oauth_uid'];

    $img = imagecreatefromjpeg('src/img/f/blue-grey.jpg'); 

    //$text=substr($text,0,999); 
    
    $char_count=strlen ($text);
   // echo $char_count;

    if($char_count>800){
        $fontSize=14.5;
    }else if($char_count<=800 && $char_count>600){
        $fontSize=16;
    }else if($char_count<=600 && $char_count>400){
        $fontSize=19;
    }else if($char_count<=400 && $char_count>200){
        $fontSize=22;
    }else if($char_count<=200 && $char_count>100){
        $fontSize=26;
    }else if($char_count<=100 && $char_count>50){
        $fontSize=28;
    }else if($char_count<=50){
        $fontSize=30;
    }




    $img_info = getimagesize($_POST['img']);

    switch ($img_info[2]) {
        case IMAGETYPE_GIF  : $image = imagecreatefromgif($_POST['img']);  break;
        case IMAGETYPE_JPEG : $image = imagecreatefromjpeg($_POST['img']); break;
        case IMAGETYPE_PNG  : $image = imagecreatefrompng($_POST['img']);  break;
        default : die("Unknown filetype");
      }


      $image=imagescale( $image, 250, $new_height = -1, $mode = IMG_BILINEAR_FIXED );


    $sx = imagesx($img);
    $sy = imagesy($img);

    $white = imagecolorallocate($img, 255, 255, 170);
    $font = dirname(__FILE__) . '/src/font/calsonos.otf'; 
    imagecopy($img, $image, $sx/2-125, 50, 0, 0, imagesx($image), imagesy($image));

    // THE IMAGE SIZE
    $width = imagesx($img)-140;
    $height = imagesy($img);
    

    
    $text = \andrewgjohnson\linebreaks4imagettftext($fontSize, 0, $font, $text, $width);
    
    $hgt=1+substr_count( $text, "\n" );;
    
    // THE TEXT SIZE
    $text_size = imagettfbbox($fontSize, 0, $font, $text);
    $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
    $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

    
    // CENTERING THE TEXT BLOCK
    $centerX = CEIL(($width - $text_width) / 2);
    $centerX = $centerX<0 ? 0 : $centerX;
    $centerY = CEIL(($height - $text_height) / 2);
   // $centerY = $centerY<0 ? 0 : $centerY;

    $centerY=$height/2;
    imagefttext($img, $fontSize, 0, $centerX+80, 70+$centerY, $white, $font, $text);
    
    
    // OUTPUT IMAGE
    imagejpeg($img,'src/img/'.$id.$t.'ogshare.jpg',100);
    imagedestroy($img);


    $title=$name;
    $ogimage=$siteurl.'/src/img/'.$id.$t.'ogshare.jpg';
    $rand=generateRandomString(10);
    require_once 'layout/header.php';
    require_once 'layout/footer.php';



    $toupdate='/src/img/'.$id.$t.'ogshare.jpg';
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    $sql = "UPDATE users SET ogimg='$toupdate' WHERE oauth_uid=$id";
    $conn->query($sql);
    $conn->close();
    $urlToShare="https://www.facebook.com/dialog/share?
    app_id=692992438123358
    &display=popup
    &href=".$siteurl."/profile.php?id=".$id."&cdvcog=".$rand;
    //header("Location: $urlToShare"); 


    $msgID=$_POST['msgID'];

    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE message SET seen='1' WHERE id=$msgID";
    
    if ($conn->query($sql) === TRUE) {
       // echo "Record updated successfully";
    } else {
       // echo "Error updating record: " . $conn->error;
    }
    $conn->close();



    $urlFb=$siteurl."/profile.php?id=".$id."&cdvcog=".$rand;
    
    require_once 'layout/expand_2.php';
    
}else{
    header("Location: /"); 
}


?>
