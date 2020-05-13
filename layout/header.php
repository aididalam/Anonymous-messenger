<!DOCTYPE html>
<html lang="en-US">
<head>
<title><?php echo $title ?></title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<meta name="title" content="<?php echo $title ?>">
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $description ?>">
<meta name="image" content="<?php echo $ogimage ?>" >
<meta name="url" content="<?php echo $siteName ?>" >
<meta name="author" content="<?php echo $siteName ?>">





<link rel="icon" type="image/png" href="<?php echo $logo ?>" />


<meta property="og:url"                content="<?php echo $siteurlog ?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo $title?>" />
<meta property="og:description"        content="<?php echo $description?>" />
<meta property="og:image"              content="<?php echo $ogimage ?>" />
<meta property="fb:app_id"             content="<?php echo $app_id ?>" />
<meta property="og:image:width"        content="<?php echo $ogIMGwidth ?>" />
<meta property="og:image:height"       content="<?php echo $ogIMGheight ?>" />
<meta property="og:image:secure_url"   content="<?php echo $ogimage ?>" />




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="style/main.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<?php echo $extraHeader ?>

</head>

<body>


<!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="/">
    <img src="<?php echo $logo ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    <?php echo $siteName ?>
  </a>

  <div class="navbar-nav" align="right">
  <?php
    if (isset($_SESSION['userData'])) {
      echo ' <a class="nav-item nav-link" href="/logout.php">Logout</a>';
    }
?>
    
</nav>

<?php echo $extraBody ?>