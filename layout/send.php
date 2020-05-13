<div class="container">        
    <div class="row alert-light">
        <div class="col-sm-12 col-12" align="center"><img src="<?php echo $picture ?>" class="rounded-circle img-fluid" alt="Cinque Terre" height="120" width="120"></div>
        <div class="col-sm-12 col-12" align="center"><h3><?php echo $name ?></h3><hr></div>
    </div>


    <div class="row alert-light">
        <button type="button" class="col-sm-6 col-6 btn btn-light" data-toggle="collapse" data-target="#demo">Send Text Message <i class="fas fa-comment-alt"></i></button>
        <button type="button" class="col-sm-6 col-6 btn btn-light" data-toggle="collapse" data-target="#ImgMessage">Send Image Message <i class="fas fa-image"></i></button>
        

        <div class="collapse col-sm-12 col-12" id="demo"><hr>


                <form align="center" action="send/sendmsg.php" accept-charset="utf-8" method="post">


                    <?php if(
                        (isset($_SESSION['userData']))){

                    echo '<label for="type">Send as Anonymous:  </label>
                    <div class="btn-group-sm btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-success btn-toggle active ">
                            <input type="radio" name="type" id="1" value="1" autocomplete="off" checked> Yes
                        </label>
                        <label class="btn btn-outline-danger btn-toggle">
                            <input type="radio" name="type" id="0" value="0" autocomplete="off"> No
                        </label>
                    </div>';

                    echo '<input type="hidden" value="'.$_SESSION['userData']['oauth_uid'].'" name="sender_id" />';
                    }else{
                        echo '<input type="hidden" value="0" name="type" />';
                        echo '<input type="hidden" value="0" name="sender_id" />';
                    }
                ?>

                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="user_id" />

                    <div class="form-group">
                        <label for="comment">Message:</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment" minlength="5" maxlength="1000" required></textarea>
                        <small id="emailHelp" class="form-text text-muted">User will never know who send the message if you send it as anonymous</small>
                    </div>
                    <button type="submit" id="sort" name="submit" class="btn btn-primary">Submit</button>
                </form>


        </div>


        <div class="collapse col-sm-12 col-12" id="ImgMessage"><hr>
                <form align="center" action="send/sendmsg.php" accept-charset="utf-8" method="post" enctype="multipart/form-data">

                <?php if((isset($_SESSION['userData']))){

                    echo '<label for="type">Send as Anonymous:  </label>
                    <div class="btn-group-sm btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-success btn-toggle active ">
                            <input type="radio" name="type" id="1" value="1" autocomplete="off" checked> Yes
                        </label>
                        <label class="btn btn-outline-danger btn-toggle">
                            <input type="radio" name="type" id="0" value="0" autocomplete="off"> No
                        </label>
                    </div>';

                    echo '<input type="hidden" value="'.$_SESSION['userData']['oauth_uid'].'" name="sender_id" />';
                }else{
                    echo '<input type="hidden" value="0" name="type" />';
                    echo '<input type="hidden" value="0" name="sender_id" />';
                }
                                    

                ?>

                    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="user_id" />

                    <div class="form-group">
                        <label for="comment">Message:</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment" minlength="5" maxlength="1000" ></textarea>
                        <small id="emailHelp" class="form-text text-muted">User will never know who send the message if you send it as anonymous</small>
                    </div>

                    <div class="form-group">  
                        <div class="col-sm-6 custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="customFile"  accept="image/*" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <img class="img-rounded img-thumbnail" src="/src/img/f/no-image.png" id="output_image" width="300px">
                    </div>

                    <button type="submit" id="sort" name="submitimg" class="btn btn-primary">Submit</button>
                </form>
        </div>


    </div>


</div>


<script>


$('#demo').collapse({
    show: true
})

jQuery('button:not(#sort)').click( function(e) {
    jQuery('.collapse').collapse('hide');
});

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);


  var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);


});








</script>