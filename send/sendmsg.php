
<?php
require_once __DIR__.'/../config/db.php';

if (isset($_POST['submitimg'])) {
    $uploadOk = 1;
    $t=time();
    $image = $_FILES['customFile']['name'];
    $target = "images/".$t.basename($image);
    $target= str_replace(' ', '', $target);
    $check = getimagesize($_FILES["customFile"]["tmp_name"]);
    if (move_uploaded_file($_FILES['customFile']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    echo $target;
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
   

    $userID=$_POST['user_id'];
    $sender_id=$_POST['sender_id'];
    $type=$_POST['type'];
    $msg=$_POST['comment'];
    $img=$target;

    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
   // $conn -> set_charset("utf8");

    $sql = "INSERT INTO message (receiver, sender, typemsg, img, imgUrl, messageTxt)
    VALUES ('$userID', '$sender_id', '$type', '1', '$img', '$msg' )";

    if ($conn->query($sql) === TRUE) {
        header("Location: /sent.php?id=$userID");
    } else {
        header("Location: /error.php");
    }
$conn->close();


}else if(isset($_POST['submit'])){

    $userID=$_POST['user_id'];
    $sender_id=$_POST['sender_id'];
    $type=$_POST['type'];
    $msg=$_POST['comment'];
    $img=null;
    
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
   // $conn -> set_charset("utf8");

    $sql = "INSERT INTO message (receiver, sender, typemsg, img, imgUrl, messageTxt)
    VALUES ('$userID', '$sender_id', '$type', '0', '$img', '$msg' )";
    $conn->query($sql);


    $sql = "SELECT first_name,last_name, email FROM users WHERE oauth_uid=$userID";
    $result = $conn->query($sql);
    $row=mysqli_fetch_row($result); 
    $email=$row[2];
    $name=$row[0]." ".$row[1];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $to = $email;
        $subject = "New Anonymous message";
        $message='<h2 style="text-align: center;">Hello '.$name.'</h2>
        <p>Some one send you an Anonymous Message. Explore the feedback about yourself.Visit now: <a href="'.$siteurl.'">'.$siteurl.'</a></p>';

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
        $headers .= 'Reply-To: Anon <'.$mymail.'>\r\n';
        $headers .= 'Return-Path: Anon <'.$mymail.'>\r\n';
        $headers .= 'From: Anon <'.$mymail.'>\r\n';
        
        mail($to,$subject,$message,$headers);
        
    }


$conn->close();

    header("Location: /sent.php?id=$userID");

}else{
    header("Location: /error.php");
}

?>
