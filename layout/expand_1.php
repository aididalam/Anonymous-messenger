<div class="container">        
    <div class="row alert-light">

    <div class="col-sm-12" align="center"><h2> <?php echo $_POST['sender'] ?> Send You a Text Message</h2> <hr></div>
   <div class="col-sm-12" align="center"><cite> <?php echo $_POST['msg'] ?></cite> <hr></div>

   
   <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=692992438123358&autoLogAppEvents=1"></script>


<div class="col-sm-12" align="center">Intersting?Let's Share: 
<div class="fb-share-button" data-href="<?php echo $urlFb ?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlFb?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
</div>
</div>

</div>
</div>