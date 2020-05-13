<?php
$imgCount=0;
$msgCount=0;

$mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
                if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
                }

$sql = "SELECT img,seen FROM message WHERE receiver=$qid ORDER BY id DESC";

if ($result = $mysqli -> query($sql)) {
    while ($row = $result -> fetch_row()) {
        if($row[0]==1 && $row[1]==0){
            $imgCount++;
        }else if($row[0]==0 && $row[1]==0){
            $msgCount++;
        }
    }
    $result -> free_result();
}
$mysqli -> close();
?>




<div class="container">        
    <div class="row alert-light">
        <div class="col-sm-12 col-12" align="center"><img src="<?php echo $picture ?>" class="rounded-circle img-fluid" alt="Cinque Terre" height="120" width="120"></div>
        <div class="col-sm-12 col-12" align="center"><h3><?php echo $name ?></h3><hr></div>

        <div class="col-sm-12 col-12" align="center">
            <b><span id="link"><?php echo $siteurl."/profile.php?id=".$qid ?></span></b>

            <button type="button" onclick="copyToClipboard('#link')" class="btn btn-default btn-sm"><i class="fas fa-paste"></i></button><hr>

        </div>

        <div class="col-sm-3 col-12 offset-sm-3 " align="center"><h4>Share your profile:</h4></div>

        <div class="col-sm-3 col-12" align="center">
        
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $siteurl."/profile.php?id=".$qid ?>" > <i class="fab fa-facebook-square fa-2x"></i></a>
            <a href="fb-messenger://share/?link=<?php echo $siteurl."/profile.php?id=".$qid ?>" style="padding-left:10px"> <i class="fab fa-facebook-messenger fa-2x"></i></a>
            <a href="https://wa.me/?text=Send me an Anonymous message: <?php echo $siteurl."/profile.php?id=".$qid ?>" style="padding-left:10px"> <i class="fab fa-whatsapp fa-2x"></i></a>
        </div>

    </div>

    <div class="row alert-light">
        <button type="button" class="col-sm-4 col-4 btn btn-light" data-toggle="collapse" data-target="#demo">Message <span class="badge badge-dark">New <?php echo $msgCount ?></span></button>
        <button type="button" class="col-sm-4 col-4 btn btn-light" data-toggle="collapse" data-target="#ImgMessage">Image <span class="badge badge-dark">New <?php echo $imgCount ?></button>
        <button type="button" class="col-sm-4 col-4 btn btn-light" data-toggle="collapse" data-target="#sent">Sent <i class="fas fa-paper-plane"></i></button>
        

        <div class="collapse col-sm-12 col-12" id="demo"><hr>          
            <?php
                $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
                if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
                }
                $sql = "SELECT id,sender,img,messageTxt,seen,typemsg FROM message WHERE receiver=$qid AND img=0 ORDER BY id DESC";
                if ($result = $mysqli -> query($sql)) {



                if($result->num_rows > 0)  {

                  
                while ($row = $result -> fetch_row()) {
                   // printf ("%s (%s)\n", $row[0], $row[1]);
                  if(!empty($row[1])){
                        $sql = "SELECT first_name,last_name FROM users WHERE oauth_uid=$row[1]";
                        $resultData = $mysqli->query($sql);
                        $senderData=mysqli_fetch_row($resultData); 
                        $sendeName=$senderData[0]." ".$senderData[1];
                        $sendeName='<a href="/profile.php?id='.$row[1].'">'.$sendeName.'</a>';
                        if($resultData->num_rows == 0){
                            $sendeName="Anynomous";
                        }

                        if($row[5]==0){
                            $sendeName="Anynomous";
                        }

                   }else{
                       $sendeName="Anynomous";
                   }

                   $srtmsg=$row[3];
                   $srtmsg=substr($srtmsg,0,40);

                   if($row[4]==0){
                       $lable='<h6>Example heading <span class="badge badge-success">NEW</span></h6>';
                   }else{
                    $lable='<h6>Example heading <span class="badge badge-secondary">OLD</span></h6>';
                   }
                   
                   echo '
                        <blockquote class="blockquote">'.$lable.'
                            <p class="mb-0">'.$srtmsg.' .........</p>
                            <footer class="blockquote-footer">from <cite>'.$sendeName.'
                            
                            
                            <div class="row">
                                <div class="col-sm-2 col-7">
                            
                            <form action="/expand.php" method="post">
                                <input type="hidden" value="'.$row[3].'" name="msg" />
                                <input type="hidden" value="'.$name.'" name="name" />
                                <input type="hidden" value="'.$sendeName.'" name="sender" />
                                <input type="hidden" value="'.$row[0].'" name="msgID" />
                                <button type="submit" id="sort" name="submitMsg" class="btn btn-primary btn-sm"><b>Read Full Message</b> <i class="fas fa-share"></i></button>
                            </form></div>
                            
                            <div class="col-sm-2 col-5">
                            <form action="/delete.php" method="post">
                            <input type="hidden" value="'.$row[0].'" name="id" />
                            <button type="submit" id="sort" name="delete" class="btn btn-danger btn-sm"><b>Delete</b> <i class="fas fa-trash"></i></button>
                            </form>
                            
                            </div>
                            </div></cite>
                            
                            
                            
                            </footer>
                        </blockquote><hr>';
                }

            }else{
                echo '<div class="col-sm-12" align="center">You have no message</div>';
            }
                $result -> free_result();
                }

                $mysqli -> close();
            ?>
        </div>
        <div class="collapse col-sm-12 col-12" id="ImgMessage"><hr>


        <?php
                $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
                if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
                }
                $sql = "SELECT id,sender,img,messageTxt,imgUrl,seen,typemsg FROM message WHERE receiver=$qid AND img=1 ORDER BY id DESC";
                if ($result = $mysqli -> query($sql)) {

                    if($result->num_rows > 0)  {
                while ($row = $result -> fetch_row()) {
                   // printf ("%s (%s)\n", $row[0], $row[1]);
                  if(!empty($row[1])){
                        $sql = "SELECT first_name,last_name FROM users WHERE oauth_uid=$row[1]";
                        $resultData = $mysqli->query($sql);
                        $senderData=mysqli_fetch_row($resultData); 
                        $sendeName=$senderData[0]." ".$senderData[1];
                        $sendeName='<a href="/profile.php?id='.$row[1].'">'.$sendeName.'</a>';
                        if($resultData->num_rows == 0){
                            $sendeName="Anynomous";
                        }

                        if($row[6]==0){
                            $sendeName="Anynomous";
                        }
                   }else{
                       $sendeName="Anynomous";
                   }

                   $imgURL="send/".$row[4];

                   $srtmsg=$row[3];
                   $srtmsg=substr($srtmsg,0,40);

                   if($row[5]==0){
                       $lable='<h6>Example heading <span class="badge badge-success">NEW</span></h6>';
                   }else{
                    $lable='<h6>Example heading <span class="badge badge-secondary">OLD</span></h6>';
                   }
                   
                   echo '
                        <blockquote class="blockquote">'.$lable.'
                        <img src="/'.$imgURL.'" class="img-thumbnail" width="150px" alt="Cinque Terre">
                            <p class="mb-0">'.$srtmsg.'</p>
                            <footer class="blockquote-footer">from <cite>'.$sendeName.'
                            
                            <div class="row">
                                <div class="col-sm-2 col-7">
                                
                            <form action="/expand.php" method="post">
                                <input type="hidden" value="'.$row[3].'" name="msg" />
                                <input type="hidden" value="'.$name.'" name="name" />
                                <input type="hidden" value="'.$imgURL.'" name="img" />
                                <input type="hidden" value="'.$sendeName.'" name="sender" />
                                <input type="hidden" value="'.$row[0].'" name="msgID" />
                                <button type="submit" id="sort" name="submitImg" class="btn btn-primary btn-sm"><b>Read Full Message</b> <i class="fas fa-share"></i></button>
                            </form></div>
                            
                            <div class="col-sm-2 col-5">
                            <form action="/delete.php" method="post">
                            <input type="hidden" value="'.$row[0].'" name="id" />
                            <button type="submit" id="sort" name="delete" class="btn btn-danger btn-sm"><b>Delete</b> <i class="fas fa-trash"></i></button>
                            </form>
                            
                            </div>
                            </div></cite></footer>
                        </blockquote><hr>';
                }
            }else{
                echo '<div class="col-sm-12" align="center">You have no message</div>';
            }
                $result -> free_result();
                }

                $mysqli -> close();
            ?>

        </div>

        <div class="collapse col-sm-12 col-12" id="sent"><hr>
           <?php
                $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
                if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
                }
                $sql = "SELECT id,receiver,img,messageTxt,imgUrl FROM message WHERE sender=$qid ORDER BY id DESC";
                if ($result = $mysqli -> query($sql)) {

                    if($result->num_rows > 0)  {
                while ($row = $result -> fetch_row()) {
                   // printf ("%s (%s)\n", $row[0], $row[1]);
                  if(!empty($row[1])){
                        $sql = "SELECT first_name,last_name FROM users WHERE oauth_uid=$row[1]";
                        $resultData = $mysqli->query($sql);
                        $senderData=mysqli_fetch_row($resultData); 
                        $sendeName=$senderData[0]." ".$senderData[1];
                        $sendeName='<a href="/profile.php?id='.$row[1].'">'.$sendeName.'</a>';
                        if($resultData->num_rows == 0){
                            $sendeName="Anynomous";
                        }
                   }else{
                       $sendeName="Anynomous";
                   }

                   

                   if($row[2]==1){
                    $imgURL="/send/".$row[4];
                    echo '
                        <blockquote class="blockquote">
                        <img src="'.$imgURL.'" class="img-thumbnail" width="200px" alt="Cinque Terre">
                            <p class="mb-0"></p>'.$row[3].'
                            <footer class="blockquote-footer">to <cite>'.$sendeName.'</cite></footer>
                        </blockquote><hr>';
                   }else{
                    echo '
                    <blockquote class="blockquote">
                    
                        <p class="mb-0"></p>'.$row[3].'
                        <footer class="blockquote-footer">to <cite>'.$sendeName.'</cite></footer>
                    </blockquote><hr>';
                   }
                   

                   
                }
            }else{
                echo '<div class="col-sm-12" align="center">You never sent a message from your account</div>';
            }
                $result -> free_result();
                }

                $mysqli -> close();
            ?>
        </div>

    </div>

</div>        


<script>

$('#demo').collapse({
    show: true
})


function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  alert("Copied successfully");
  $temp.remove();
}

jQuery('button').click( function(e) {
    jQuery('.collapse').collapse('hide');
});
</script>