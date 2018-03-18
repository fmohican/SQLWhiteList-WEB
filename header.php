<?php
require_once('function.php');
debug();
$sec = new security();
if($sec->checktoken(@$_COOKIE['token'], @$_COOKIE['user']) == false)
  $login = false;
else {
  $user = $_COOKIE['user'];
  $login = true;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Sytling Tags -->
    <!-- Meta Proptery -->
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $url; ?>" />
    <meta property="og:description" content="<?php echo $desc; ?>" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- End Meta Proptery -->
    <link rel="stylesheet" href="css/googledep.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <title><?php echo $title; ?></title>
  </head>
  <body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Colonize & Conquest The World ">
          <?php echo $title; ?>
        </a>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="whitelist.php">Whitelisted Players</a>
          </li>
        </ul>
        <ul class="navbar-nav px-3">
        <?php
        if($login == false)
          echo'
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hello Guests! <i class="material-icons align-middle">perm_identity</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" data-toggle="modal" data-target="#signin" >Login</a>
              <!--<a class="dropdown-item" data-toggle="modal" data-target="#register">Register</a>-->
            </div>
          </li>';
          else
            echo'
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello '.$user.'! <i class="material-icons align-middle">perm_identity</i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="admin.php"><i class="material-icons align-middle">settings</i> AdminCP</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="controller.php?action=logout"><i class="material-icons align-middle">exit_to_app</i> Logout</a>
              </div>
            </li>';
          ?>
        </ul>
      </div>
    </nav>
<!-- Modal Signin-->
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action='controller.php' method='POST'>
          <div class="form-group">
            <label class="bmd-label-floating text-login">Username</label>
            <input type="text" name="user" class="form-control">
          </div>
          <div class="form-group">
            <label class="bmd-label-floating text-login">Password</label>
            <input type="password" name="pass" class="form-control" autocomplete="off">
          </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="action" value="login" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>