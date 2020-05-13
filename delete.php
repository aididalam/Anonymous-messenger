<?php
    require_once 'config/db.php';
if (isset($_POST['delete'])) {

    

        $userid=$_SESSION['userData']['oauth_uid'];
        $msgid=$_POST['id'];

        $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

        if ($conn->connect_error) {
            header("Location: /");
        }
        
        // sql to delete a record
        $sql = "DELETE FROM message WHERE id=$msgid AND receiver=$userid";
        
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: /");
        } else {
            $conn->close();
            header("Location: /error.php");
        }
        


}else{
    header("Location: /");
}

?>