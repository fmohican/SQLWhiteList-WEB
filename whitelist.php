<?php
include('header.php');
?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="text-center">
        <img class="rounded" width="200" height="200" src="img/logo.png" />
      </div>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">User</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
          <tbody class='text-light'>
          <?php
          $data =  $sql->query("select * from `users`");
          while($row = $data->fetch_object() ) {
            if($row->whitelist == 0) {
              $status = "Waiting for review";
              $color = "";
              }
            if($row->whitelist == 1) {
              $status = "Accepted";
              $color = "class='text-success'";
              }
            if($row->whitelist > 1) {
              $status = "Reject";
              $color = "class='text-danger'";
            }
            echo "<tr ".$color."><td>".$row->user."</td><td>".$status."</td></tr>";
          }
            
          ?>
        </tbody>
      </table>
    </div>
  </div>
<div>
<?php
include("footer.php");
?>