<?php
require_once('config.php');

class security {
  public function whitelist() {
    global $sql;
    $data = $sql->query("select * from users ORDER BY `id` DESC");
    $text="";
    while($row = $data->fetch_object()) {
      $text .= "<tr class='text-light'><td>".$row->user."</td><td><form class='initial' action='' method='post'><div class='switch'><label class='text-light'><input type='checkbox' value='On' name='whitelist' ".($row->whitelist == 1 ? "checked" : "").">WhiteListed</label></div><input type='hidden' name='action' value='adminchange'><input type='hidden' name='userid' value='".$row->id."'></form></div></td></tr>";
    }
    return $text;
  }
  public function checktoken($token, $user) {
    global $sql;
    $acc = new account();
    $ltoken = $acc->getPass($user);
    if($ltoken === $token)
      return true;
    else
      return false;
  }
  public function getfromid($uid, $what) {
    global $sql;
    $data = $sql->query("select * from users where `id`='$uid'");
    if($data->num_rows == 1) {
      $row = $data->fetch_object();
      return $row->$what;
    }
  }
  public function setwl($uid, $val) {
    global $sql;
    $sql->query("update users set `whitelist`='$val' where `id`='$uid'");
  }
  public function escape($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'utf-8');
  }
}

class account {
  public function getPass($user) {
    global $sql;
    $data = $sql->query("select * from `users` where `user`='$user'");
    if($data->num_rows == 1) {
      $row = $data->fetch_object();
      return hash("md5", $row->password);
    }
    else
      return false;
  }
  
  public function checkpass($user, $pass) {
    global $sql;
    $data = $sql->query("select * from `users` where `user`='$user'");
    if($data->num_rows == 1) {
      $row = $data->fetch_object();
      if(password_verify($pass, $row->password)) {
        $data1 = $sql->query("select * from users where `user`='$user'");
        if($data1->num_rows == 1) {
          $row1 = $data1->fetch_object();
          if($row1->isadmin == 1)
            return true;
        }
        else
          return false;
      }
      else
        return false;
    }
    else
      return false;
  }
  
  public function login($user, $pass) {
    if($this->checkpass($user,$pass))
      return true;
    else
      return false;
  }
  
  public function checkbeta($ign) {
    global $sql;
    $data = $sql->query("select * from users where `user`='$ign'");
    if($data->num_rows > 0) {
      $row = $data->fetch_object();
      if($row->whitelist == 0)
        return "<h1 class='text-center text-sunny'>Hello $ign, Your application is awaiting approval.</h1>";
      if($row->whitelist == 1)
        return "<h1 class='text-center text-success'>Hello $ign, Your application has approved</h1>";
      if($row->whitelist > 1)
        return "<h1 class='text-center text-danger'>Hello $ign, Your application was rejected please contact us on discord</h1>";
    }
      
  }
  public function betareq($ign) {
    global $sql;
    $sec = new security();
    $ign = $sec->escape($ign);
    $reqdate = time();
    $sql->query("INSERT INTO users (`user`) VALUES ('$ign')");
    return true;
  }
  
}

function debug()
{
    static $start;

    if (is_null($start))
    {
        $start = microtime(true);
    }
    else
    {
        $diff = round((microtime(true) - $start), 4);
        $start = null;
        return $diff;
    }
}

?>