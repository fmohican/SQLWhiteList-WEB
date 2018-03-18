<?php
require_once('function.php');
$sec = new security();
$site = new account();
$action = $_REQUEST["action"];
if(isset($action) AND !empty($action)) {
  switch($action) {
    case "register":
    $try = $site->betareq($_POST["ign"]);
    if($try == true) {
      echo "<h1 class='text-success text-center'> Your request was submited successfully and now is under review</h1>";
      setcookie("applyed", $_POST["ign"], time()+(86400 * 99), "/");
    }
    else
      echo "<h1 class='text-danger text-center'>We can't recive your application. Please submit again.</h1>";
    break;
    case "login":
      if($site->login($_POST['user'], $_POST['pass']))
      {
        setcookie("user", $_POST['user'], time()+(86400 * 99), "/");
        setcookie("token", $site->getPass($_POST['user']), time()+(86400 * 99), "/");
        exit(header("Location: admin.php"));
      }
      else
        exit(header("Location: index.php?status=500"));
      break;
    case "logout":
        setcookie("user", null, time()-(86400 * 99), "/");
        setcookie("token", null, time()-(86400 * 99), "/");
        exit(header("Location: index.php?status=loggedout"));
        break;
    case "adminchange":
        $id = $_POST["userid"];
        $value = @$_POST["whitelist"];
        switch($value) {
          case "On":
            $sec->setwl($id, 1);
            echo "<div class='adminalert'><div class='alert alert-success alert-dismissible fade show text-center' role='alert'><strong><i class='material-icons align-middle'>check</i></strong> Access Granted for ".$sec->getfromid($id, "user")."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>".'<script>window.setTimeout(function() {$(".adminalert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 4000);</script>';
            break;
          case "Off":
            $sec->setwl($id, 2);
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'><strong><i class='material-icons align-middle'>check</i></strong> Access Revoked for ".$sec->getfromid($id, "user")."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>".'<script>window.setTimeout(function() {$(".adminalert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 4000);</script>';
            break;
          default:
            $sec->setwl($id, 2);
            echo "<div class='adminalert'><div class='alert alert-danger alert-dismissible fade show text-center' role='alert'><strong><i class='material-icons align-middle'>check</i></strong> Access Revoked for ".$sec->getfromid($id, "user")."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div></div>".'<script>window.setTimeout(function() {$(".adminalert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 4000);</script>';
            break;
        }
      break;
    default:
    break;
  }
}