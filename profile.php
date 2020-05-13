<?php
 header('Content-Type: text/html; charset=utf-8');
    require_once 'config/db.php';
    //include 'layout/header.php';

$picture="";
$name="";
$userValid="";

    if (isset($_GET['id'])) {
        $qid= $_GET['id'];
        $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT first_name,last_name,picture,ogimg FROM users WHERE oauth_uid=$qid";
        $result = $conn->query($sql);
        $row=mysqli_fetch_row($result); 
        if ($result->num_rows > 0) {
            $userValid=1;
        }else{
            $userValid=0;
            header("Location: /error.php");
        }
        
        $picture=$row[2];
        $name=$row[0]." ".$row[1];
        $nogimg=$row[3];
        $conn->close();

        //I am visiting my profile
        $siteurlog=$siteurl."/profile.php?id=".$qid;

        $title=$name."-".$title;
        $description="Send ".$name." an Anynomous picture/message || ".$description;
        
        

        if (isset($_SESSION['userData'])) {
            $qid=$_SESSION['userData']['oauth_uid'];
            if($_GET['id']==$qid){

                

                if(isset($_GET['cdvcog'])){

                    $ogIMGwidth="1200px";
                    $ogIMGheight="650px";
                    $ogimage=$siteurl.$nogimg;


                    

                    $siteurlog=$siteurl."/profile.php?id=".$qid."&cdvcog=".generateRandomString(10);
                    
                    $description="Send ".$name." an Anynomous picture/message";
                }

                include 'layout/header.php';
                include 'layout/profile.php';
            }else{
                
                include 'layout/header.php';
                include 'layout/send.php';  
            }
        }else{
            if($userValid==1){
                



                if(isset($_GET['cdvcog'])){
                
                    $ogIMGwidth="1200px";
                    $ogIMGheight="650px";
                    $ogimage=$siteurl.$nogimg;

                    $siteurlog=$siteurl."/profile.php?id=".$qid."&cdvcog=".generateRandomString(10);
                    
                    $description="Send ".$name." an Anynomous picture/message";
                }

                include 'layout/header.php';
                include 'layout/send.php';
            }else{
                header("Location: /error.php"); 
            }
            
        }

    }else{
        if (isset($_SESSION['userData'])) {

            $qid= $_SESSION['userData']['oauth_uid'];
            $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT first_name,last_name,picture,ogimg FROM users WHERE oauth_uid=$qid";
            $result = $conn->query($sql);
            $row=mysqli_fetch_row($result); 
            if ($result->num_rows > 0) {
                $userValid=1;
            }else{
                $userValid=0;
            }
            
            $picture=$row[2];
            $name=$row[0]." ".$row[1];
           // $nogimg=$row[3];
            $conn->close();


           // 
            


            include 'layout/header.php';
            include 'layout/profile.php';
        }else{
            header("Location: /");
        }
    }


    

     require_once 'layout/footer.php';
?>