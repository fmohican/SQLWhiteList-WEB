<?php
include('config.php');
function encpass($pass) {
  $options = [
    'cost' => 10
];
  return password_hash($pass, PASSWORD_BCRYPT, $options);
}
$action = @$_REQUEST["action"];
if(isset($action) AND !empty($action)) {
  if($action == "register") {
    $pass = encpass($_POST['pass']);
    $sql->query("SET FOREIGN_KEY_CHECKS=0;");
    $sql->query("DROP TABLE IF EXISTS `users`;");
    $sql->query("CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `whitelist` int(1) DEFAULT 0,
  `isadmin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    $sql->query("INSERT INTO `users` (`user`, `password`, `whitelist`, `isadmin`) VALUES ('".$_POST['user']."','".$pass."','1','1')");
    if(rename("admin_setup.php", md5($pass))){
      echo "<p style='color:green'>This file was renamed due security reason, please deleteit new name is ".md5($pass)."</p>";
      if(unlink(md5($pass)))
        echo "<p style='color:green'>The file was remove success fully! You are safe.</p>";
      else
        echo "<p style='color:red'>I can't remove this file, Please delete it manualiy the name is: ".md5($pass)."</p>";
    }
    else
      echo "<p style='color:red'>Please remove admin_setup.php YOU RISK TO LOSE ALL DATA and get hacked by someone. PLEASE REMOVE THE FUCKING FILE !</p>";
  }
}
?>
<html>
  <head>
    <title>Admin setup</title>
  </head>
  <body>
    <form action="admin_setup.php" method="post">
      In Game Name: <input type="text" name="user"> <br/><br/>
      Password: <input type="password" name="pass"> <br/><br/>
      <input type="hidden" name="action" value="register">
      <button type="submit">Add me as Admin</button>
      <p>This file will be delete after 1st register due security reason</p>
      <p>Please do not use same password as game</p>
    </form>
  </body>
</html>