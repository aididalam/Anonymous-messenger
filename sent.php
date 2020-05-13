<?php

require_once 'config/db.php';
require_once 'layout/header.php';

if (isset($_GET['id'])) {


    $qid= $_GET['id'];
    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT first_name,last_name,picture FROM users WHERE oauth_uid=$qid";
    $result = $conn->query($sql);
    $row=mysqli_fetch_row($result); 
    if ($result->num_rows > 0) {
    }else{
        header("Location: /"); 
    }
    
    $picture=$row[2];
    $name=$row[0]." ".$row[1];
    $conn->close();

?>
    <div class="container">        
        <div class="row alert-light">
            <div class="col-sm-12 col-12" align="center"><img src="<?php echo $picture ?>" class="rounded-circle img-fluid" alt="Cinque Terre" height="120" width="120"></div>
            <div class="col-sm-12 col-12" align="center"><h3><?php echo $name ?></h3><hr></div>
            <div class="col-sm-12 col-12" align="center">
                <h3>Message sent successfully!</h3>

                Send another message to <a href="/profile.php?id=<?php echo $qid ?>"><?php echo $name ?></a> or start getting <a href="/">Anynomous messages.</a>
            </div>
        </div>
    </div>
<?php

}else{
    header("Location: /"); 
}

require_once 'layout/footer.php';
?>